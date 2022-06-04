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
     * @return mixed|null
     */
    public function handleUpload($file)
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
        $path = __DIR__ . "/../../public/img/";
        $filename = md5(date('Y-m-d H:i:s:u')) . $file["name"];
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
                return null;
            }
        } else {
            return null;
        }
    }
}
