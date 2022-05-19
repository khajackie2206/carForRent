<?php

namespace Khanguyennfq\CarForRent\database;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class DatabaseConnect
{
    private static $conn;
    private static $loadEnv;

    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if (!self::$conn) {
            self::$loadEnv = Dotenv::createImmutable(__DIR__ . '/../');
            self::$loadEnv->load();
            $host = $_ENV['DATABASE_HOST'];
            $username = $_ENV['DATABASE_USER'];
            $password = $_ENV['DATABASE_PASSWORD'];
            $database = $_ENV['DATABASE_NAME'];
            try {
                self::$conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$conn;
    }
}
