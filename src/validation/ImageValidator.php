<?php

namespace Khanguyennfq\CarForRent\validation;

class ImageValidator
{


     public function validateImage($image)
     {
         if (!isset($image) || $image["error"] != 0) {
             return ['error' => 'File upload does not exist!'];
         }
         $allowed = array(
             "jpg" => "image/jpg",
             "jpeg" => "image/jpeg",
             "gif" => "image/gif",
             "png" => "image/png"
         );
         $ext = pathinfo($image["name"], PATHINFO_EXTENSION);
         if (!array_key_exists($ext, $allowed) || !in_array($image['type'], $allowed)) {
             return ['error' => "Please select a valid file format!"];
         }
         $maxsize = 10 * 1024 * 1024;
         if ($image["size"] > $maxsize) {
             return ['error' => 'File size is larger than the allowed limit!'];
         }
         return '';
     }
}