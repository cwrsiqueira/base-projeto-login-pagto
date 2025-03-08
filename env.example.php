<?php
define("APP_NAME", "Projeto Base");

define("ENVIRONMENT", "development"); // Altere para "production" quando for fazer deploy

if (ENVIRONMENT == 'development') {
    define("BASE_URL", "http://localhost/base-projeto-login-pagto/");
} else {
    define("BASE_URL", "https://meusite.com.br/");
}

define("DB_DRIVER", "mysql"); // mysql | sqlite

// MySql
define("DB_NAME", "base_projeto");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");

// SQLite
define("DB_SQLITE_PATH", __DIR__ . "/database.sqlite");

$mercado_pago_teste = true;

if ($mercado_pago_teste) {
    // MERCADO PAGO CREDENCIAIS DE TESTE
    define("MERCADO_PAGO_PUBLIC_KEY", "public_key_teste");
    define("MERCADO_PAGO_ACCESS_TOKEN", "access_token_teste");
} else {
    // MERCADO PAGO CREDENCIAIS DE PRODUÇÃO
    define("MERCADO_PAGO_PUBLIC_KEY", "public_key_producao");
    define("MERCADO_PAGO_ACCESS_TOKEN", "access_token_producao");
}
