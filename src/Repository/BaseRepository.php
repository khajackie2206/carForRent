<?php

namespace Khanguyennfq\CarForRent\Repository;

use Khanguyennfq\CarForRent\Database\DatabaseConnect;
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
