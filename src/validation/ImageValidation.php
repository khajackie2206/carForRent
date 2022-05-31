<?php

namespace Khanguyennfq\CarForRent\validation;

class ImageValidation extends  AbstractFileValidation
{

    public function checkFileFormat(string $targetPath): string
    {
        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
        if ($fileType != "jpg" && $fileType != "jpeg" && $fileType != "png")
        {
        return "File must be in jpg, png, jpeg";
        }
        return "";
    }
    public function checkRealImage(): string
    {
        if (getimagesize($this->file["tmp_name"]) === false) {
            return "This is not an image!";
        }
        return "";
    }
}
