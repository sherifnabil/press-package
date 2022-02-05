<?php

namespace Sherif\Press;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Mail\Markdown;
use Sherif\Press\Facades\Press;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class PressFileParser
{
    protected $filename;
    protected $data;
    protected $rawData;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->splitFile();
        $this->explodeData();
        $this->processFields();
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getRawData(): array
    {
        return $this->rawData;
    }

    protected function splitFile(): void
    {
        preg_match(
            pattern: '/^\-{3}(.*?)\-{3}(.*)/s',
            subject: File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            matches: $this->rawData
        );
    }

    protected function processFields(): void
    {
        foreach ($this->data as $field => $value) {
            $class = $this->getField(Str::title($field));
            if (is_null($class) || !class_exists($class) && !method_exists($class, 'process')) {
                $class = 'Sherif\\Press\\Fields\\Extra';
            }
            $this->data = array_merge($this->data, $class::process($field, $value, $this->data));
        }
    }

    protected function explodeData(): void
    {
        foreach (explode("\n", trim($this->rawData[1])) as $fieldString) {
            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);
            $this->data[$fieldArray[1]] = $fieldArray[2];
        }
        $this->data['body'] = trim($this->rawData[2]);
    }

    private function getField($field)
    {
        foreach (Press::availableFields() as $availableField) {
            $class = new ReflectionClass($availableField);
            if ($class->getShortName() == $field) {
                return $class->getName();
            }
        }
    }
}
