<?php

namespace config {

    use PDO;

    class database
    {
        static public function getConnection(): PDO
        {
            $host = "localhost";
            $port = 3306;
            $database = "praktikum_5";
            $username = "root";
            $password = "    ";

            return new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
        }
    }
}
