<?php

namespace Khanguyennfq\CarForRent\validation;
use Khanguyennfq\CarForRent\validation\ImageValidation;
class FileValidator
{
   private array $file;
   private string $targetPath;
   private string $typeFile;
   private int $expectedSize;

   public function Validate(array $file, string $targetPath, string $typeFile, int $expectedSize)
   {
       $this->setFile($file);
       $this->setTargetPath($targetPath);
       $this->setTypeFile($typeFile);
       $this->setExpectedSize($expectedSize);
       if($this->getTypeFile() === "image")
       {
          $imgValidate = new ImageValidation($this->getFile());
          if($error = $this->validateFile($imgValidate))
          {
             return $error;
          }
          if ($error = $imgValidate->checkRealImage()){
              return $error;
          }
      }
       return "";
   }
    private function validateFile(AbstractFileValidation $validate)
    {
        if ($error = $validate->checkFileFormat($this->getTargetPath())) {
            return $error;
        }

        if ($error = $validate->checkFileSize($this->getExpectedSize())) {
            return $error;
        }
        return "";
    }
    /**
     * @return array
     */
    public function getFile(): array
    {
        return $this->file;
    }

    /**
     * @param array $file
     */
    public function setFile(array $file): void
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getTargetPath(): string
    {
        return $this->targetPath;
    }

    /**
     * @param string $targetPath
     */
    public function setTargetPath(string $targetPath): void
    {
        $this->targetPath = $targetPath;
    }

    /**
     * @return string
     */
    public function getTypeFile(): string
    {
        return $this->typeFile;
    }

    /**
     * @param string $typeFile
     */
    public function setTypeFile(string $typeFile): void
    {
        $this->typeFile = $typeFile;
    }

    /**
     * @return int
     */
    public function getExpectedSize(): int
    {
        return $this->expectedSize;
    }

    /**
     * @param int $expectedSize
     */
    public function setExpectedSize(int $expectedSize): void
    {
        $this->expectedSize = $expectedSize;
    }


}
