<?php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct($dsn, $username = null, $password = null)
    {
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
    }

    public static function getInstance($dsn, $username = null, $password = null)
    {
        if (!self::$instance) {
            self::$instance = new Database($dsn, $username, $password);
        }
        return self::$instance->pdo;
    }

    public static function getConnection()
    {
        return self::$instance->pdo;
    }
}

// Inicializando a conexão com base no driver
require_once __DIR__ . '/config.php';
if (DB_DRIVER === 'sqlite') {
    Database::getInstance("sqlite:" . __DIR__ . "/database.sqlite");
} else {
    Database::getInstance("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
}
