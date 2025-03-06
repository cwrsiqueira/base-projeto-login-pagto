<?php
require "config.php";

$config['dbname'] = DB_NAME;
$config['host'] = DB_HOST;
$config['dbuser'] = DB_USER;
$config['dbpass'] = DB_PASS;

try {
    // Conectar ao MySQL
    $pdo = new PDO("mysql:host=" . $config['host'], $config['dbuser'], $config['dbpass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar o banco de dados se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . $config['dbname'] . "` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    $pdo->exec("USE `" . $config['dbname'] . "`;");

    // Criar tabelas
    $sql = ""
        . "CREATE TABLE IF NOT EXISTS tenants ("
        . " id INT AUTO_INCREMENT PRIMARY KEY,"
        . " name VARCHAR(255) NOT NULL,"
        . " email VARCHAR(255) NOT NULL UNIQUE,"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        . ");"

        . "CREATE TABLE IF NOT EXISTS users ("
        . " id INT AUTO_INCREMENT PRIMARY KEY,"
        . " tenant_id INT NOT NULL,"
        . " name VARCHAR(255) NOT NULL,"
        . " email VARCHAR(255) NOT NULL UNIQUE,"
        . " password VARCHAR(255) NOT NULL,"
        . " role ENUM('admin', 'user') NOT NULL DEFAULT 'user',"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,"
        . " FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE"
        . ");"

        . "CREATE TABLE IF NOT EXISTS subscriptions ("
        . " id INT AUTO_INCREMENT PRIMARY KEY,"
        . " tenant_id INT NOT NULL,"
        . " plan VARCHAR(255) NOT NULL,"
        . " price DECIMAL(10,2) NOT NULL,"
        . " currency VARCHAR(10) NOT NULL DEFAULT 'BRL',"
        . " status ENUM('active', 'canceled', 'expired') NOT NULL DEFAULT 'active',"
        . " renew_at TIMESTAMP NOT NULL,"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE"
        . ");"

        . "CREATE TABLE IF NOT EXISTS payments ("
        . " id INT AUTO_INCREMENT PRIMARY KEY,"
        . " tenant_id INT NOT NULL,"
        . " subscription_id INT NOT NULL,"
        . " amount DECIMAL(10,2) NOT NULL,"
        . " currency VARCHAR(10) NOT NULL DEFAULT 'BRL',"
        . " status ENUM('pending', 'paid', 'failed') NOT NULL DEFAULT 'pending',"
        . " payment_method VARCHAR(50) NOT NULL,"
        . " transaction_id VARCHAR(255) UNIQUE NOT NULL,"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE,"
        . " FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON DELETE CASCADE"
        . ");"

        . "CREATE TABLE IF NOT EXISTS payment_methods ("
        . " id INT AUTO_INCREMENT PRIMARY KEY,"
        . " tenant_id INT NOT NULL,"
        . " type ENUM('card', 'pix', 'boleto') NOT NULL,"
        . " details VARCHAR(255) NOT NULL,"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE"
        . ");";

    // Executar script SQL
    $pdo->exec($sql);

    echo "Banco de dados MySQL criado com sucesso!\n";
} catch (PDOException $e) {
    die("Erro ao criar o banco de dados MySQL: " . $e->getMessage());
}
