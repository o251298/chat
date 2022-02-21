<?php


namespace App\Services\DB;


class dbConnect
{
    public static function getConnection()
    {
        $dsn = "mysql:host=".env('DB_HOST') .";dbname=" . env('DB_DATABASE') . ";charset=UTF8";
        $db = new \PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'));
        return $db;
    }
}
