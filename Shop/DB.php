<?php

namespace Framework;

use PDO;
use PDOException;

class DB {

    public static function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "shop";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}