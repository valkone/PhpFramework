<?php

namespace Framework;

use PDO;
use PDOException;

class DB {

    private static $connection = null;

    public static function connect() {
        if(self::$connection == null) {
            $servername = "127.0.0.1";
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
        } else {
            return self::$connection;
        }
    }
}