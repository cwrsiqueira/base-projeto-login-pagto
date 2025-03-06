<?php
define("ENVIRONMENT", "development"); // Altere para "production" quando for fazer deploy

if (ENVIRONMENT == 'development') {
    define("BASE_URL", "http://localhost/");
} else {
    define("BASE_URL", "http://meusite.com.br/");
}

define("DB_DRIVER", "sqlite"); // Altere para "mysql" se quiser usar MySQL

// MySql
define("DB_NAME", "base_projeto");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");

// SQLite
define("DB_SQLITE_PATH", __DIR__ . "/database.sqlite");
