<?php

class Database
{
    public static function connect()
    {   
        return new PDO(
            "mysql:host=localhost;dbname=sample_aplication;charset=utf8mb4",
            "sample1_db",
            "sample1_db",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}
?>