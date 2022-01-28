<?php

namespace SherifNabil\Press;

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
    }

    public function getData(): array
    {
        return $this->data;
    }

    protected function splitFile(): void
    {
        preg_match(
            pattern: '/^\-{3}(.*?)\-{3}(.*)/s',
            subject: File::get($this->filename),
            matches: $this->data
        );
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
