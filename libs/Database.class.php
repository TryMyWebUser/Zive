<?php

class Database
{
    public static $conn = null;

    public static function getConnect()
    {
        if (Database::$conn == null)
        {
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "zive";
            // $server = "localhost";
            // $username = "trymywebsites_zive";
            // $password = "zive@2025";
            // $dbname = "trymywebsites_zivedb";

            // create connection
            $connection = new mysqli($server, $username, $password, $dbname);

            // Checking connection
            if ($connection->connect_error)
            {
                die("Connection Failed: " . $connection->connect_error);
            } else {
                Database::$conn = $connection;
                return Database::$conn;
            }
        } else {
            return Database::$conn;
        }
    }

}

?>