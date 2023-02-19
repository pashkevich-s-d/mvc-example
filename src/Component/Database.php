<?php

namespace PashkevichSD\MvcExample\Component;

use PDO;

class Database
{
    private static ?PDO $connection;

    public static function initConnection(): void
    {
        $host = $_ENV['DATABASE_HOST'];
        $database = $_ENV['DATABASE_NAME'];
        $user = $_ENV['DATABASE_USER'];
        $password = $_ENV['DATABASE_PASSWORD'];
        $port = $_ENV['DATABASE_PORT'];

        $dsn = "mysql:host=$host;port=$port;dbname=$database";

        self::$connection = new PDO($dsn, $user, $password);
    }

    public static function getConnection(): ?PDO
    {
        return self::$connection;
    }
}
