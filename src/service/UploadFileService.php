<?php

namespace Khanguyennfq\CarForRent\service;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;

class UploadFileService
{
    private static $loadEnv;
    private $bucketName;
    private $bucketRegion;
    private $accessKey;
    private $secretKey;

    public function __construct()
    {
        self::$loadEnv = Dotenv::createImmutable(__DIR__ . '/../../');
        self::$loadEnv->load();
        $this->bucketName = $_ENV['S3_BUCKET_NAME'];
        $this->bucketRegion = $_ENV['S3_BUCKET_REGION'];
        $this->accessKey = $_ENV['S3_ACCESS_KEY_ID'];
        $this->secretKey = $_ENV['S3_SECRET_ACCESS_KEY'];
    }

    /**
     * @param $file
     * @return \Aws\Result
     */
    public function setS3Client($file)
    {
        $key = basename($this->getFilePath($file['name']));
        $result = new S3Client([
            'version' => 'latest',
            'region' => $this->bucketRegion,
            'credentials' => ['key' => $this->accessKey, 'secret' => $this->secretKey]
        ]);
        $result = $result->putObject([
            'Bucket' => $this->bucketName,
            'Key' => $key,
            'SourceFile' => $this->getFilePath($file['name']),
        ]);
        unlink($this->getFilePath($file['name']));
        return $result;
    }

    /**
     * @param $fileName
     * @return string
     */
    public function getFilePath($fileName)
    {
        $path = __DIR__ . "/../../public/img/";
        $filename = md5(date('Y-m-d H:i:s:u')) . $fileName;
        return $path . $filename;
    }

    /**
     * @param $file
     * @return mixed|null
     */
    public function handleUpload($file)
    {
        if (!move_uploaded_file($file["tmp_name"], $this->getFilePath($file['name']))) {
            return null;
        }
        try {
            $result = $this->setS3Client($file);
            return $result->get('ObjectURL');
        } catch (S3Exception $e) {
            return null;
        }
    }
}
