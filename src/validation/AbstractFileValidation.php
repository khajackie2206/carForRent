<?php

namespace Khanguyennfq\CarForRent\validation;

abstract class AbstractFileValidation
{
    protected $file;

    /**
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param int $expectSize
     * @return string
     */
    public function checkFileSize(int $expectSize)
    {
        if ($this->file['size'] > $expectSize) {
            return "Sorry, your file is too large!";
        }
        return "";
    }

    abstract public function checkFileFormat(string $targetPath);
}
