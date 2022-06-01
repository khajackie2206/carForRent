<?php

namespace Khanguyennfq\CarForRent\service;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;
class UploadFileService
{
    private static $loadEnv;


    /**
     * @param $file
     * @return string|array
     */
    public function handleUpload($file): string | array
    {
        self::$loadEnv = Dotenv::createImmutable(__DIR__ . '/../../');
        self::$loadEnv->load();
        $bucketName = $_ENV['S3_BUCKET_NAME'];
        $bucketRegion = $_ENV['S3_BUCKET_REGION'];
        $accessKey = $_ENV['S3_ACCESS_KEY_ID'];
        $secretKey = $_ENV['S3_SECRET_ACCESS_KEY'];
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => $bucketRegion,
            'credentials' => ['key' => $accessKey, 'secret' => $secretKey]
        ]);
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            return ['error' => 'Invalid request method'];
        }
        if (!isset($file) || $file["error"] != 0) {
            return ['error' => 'File upload does not exist'];
        }
        $allowed = array(
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png"
        );
        $path = __DIR__ . "/../../public/img/";
        $filename = md5(date('Y-m-d H:i:s:u')) . $file["name"];
        $filetype = $file["type"];
        $filesize = $file["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            return ['error' => 'Please select a valid file format'];
        }
        $maxsize = 10 * 1024 * 1024;

        if ($filesize > $maxsize) {
            return ['error' => 'File size is larger than the allowed limit'];
        }
        if (!in_array($filetype, $allowed)) {
            return ['error' => 'Please select a valid file format'];
        }
        if (move_uploaded_file($file["tmp_name"], $path . $filename)) {
            $file_Path = $path . $filename;
            $key = basename($file_Path);
            try {
                $result = $s3Client->putObject([
                    'Bucket' => $bucketName,
                    'Key' => $key,
                    'SourceFile' => $file_Path,
                ]);
                unlink($path . $filename);
                return $result->get('ObjectURL');
            } catch (S3Exception $e) {
                return ['error' => 'Error when upload image to S3!!!'];
            }
        } else {
            return ['error' => 'There was an error!!'];
        }
    }
}
