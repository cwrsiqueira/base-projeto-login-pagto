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
}

// Escolher banco de dados com base na configuração
require_once __DIR__ . '/config.php';
if (DB_DRIVER === 'sqlite') {
    $db = Database::getInstance("sqlite:" . __DIR__ . "/database.sqlite");
} else {
    $db = Database::getInstance("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
}
