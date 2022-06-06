<?php

namespace Khanguyennfq\CarForRent\repository;

use Khanguyennfq\CarForRent\database\DatabaseConnect;
use PDO;

abstract class BaseRepository
{
    protected PDO $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnect::getConnection();
    }

    /**
     * @return PDO
     */
    public function getConn(): PDO
    {
        return $this->conn;
    }
}
