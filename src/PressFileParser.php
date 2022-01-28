<?php

namespace SherifNabil\Press;

use Carbon\Carbon;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\File;

class PressFileParser
{
    protected $filename;
    protected $data;

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

    protected function splitFile(): void
    {
        preg_match(
            pattern: '/^\-{3}(.*?)\-{3}(.*)/s',
            subject: File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            matches: $this->data
        );
    }

    protected function processFields(): void
    {
        foreach ($this->data as $field => $value) {
            $class = 'SherifNabil\\Press\\Fields\\' . ucfirst($field);
            if (class_exists($class) && method_exists($class, 'process')) {
                $this->data = array_merge($this->data, $class::process($field, $value));
            }
        }
    }

    protected function explodeData(): void
    {
        foreach (explode("\n", trim($this->data[1])) as $fieldString) {
            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);
            $this->data[$fieldArray[1]] = $fieldArray[2];
        }
        $this->data['body'] = trim($this->data[2]);
    }
}
