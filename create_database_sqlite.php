<?php
require "config.php";

// Caminho do banco de dados SQLite
$dbFile = DB_SQLITE_PATH;

try {
    // Conectar ao SQLite (cria o arquivo se não existir)
    $pdo = new PDO("sqlite:" . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar tabelas caso não existam
    $sql = "CREATE TABLE IF NOT EXISTS tenants ("
        . " id INTEGER PRIMARY KEY AUTOINCREMENT,"
        . " name TEXT NOT NULL,"
        . " email TEXT NOT NULL UNIQUE,"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        . ");"

        . "CREATE TABLE IF NOT EXISTS users ("
        . " id INTEGER PRIMARY KEY AUTOINCREMENT,"
        . " tenant_id INTEGER NOT NULL,"
        . " name TEXT NOT NULL,"
        . " email TEXT NOT NULL UNIQUE,"
        . " password TEXT NOT NULL,"
        . " role TEXT CHECK(role IN ('admin', 'user')) NOT NULL DEFAULT 'user',"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE"
        . ");"

        . "CREATE TABLE IF NOT EXISTS subscriptions ("
        . " id INTEGER PRIMARY KEY AUTOINCREMENT,"
        . " tenant_id INTEGER NOT NULL,"
        . " plan TEXT NOT NULL,"
        . " price REAL NOT NULL,"
        . " currency TEXT NOT NULL DEFAULT 'BRL',"
        . " status TEXT CHECK(status IN ('active', 'canceled', 'expired')) NOT NULL DEFAULT 'active',"
        . " renew_at TIMESTAMP NOT NULL,"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE"
        . ");"

        . "CREATE TABLE IF NOT EXISTS payments ("
        . " id INTEGER PRIMARY KEY AUTOINCREMENT,"
        . " tenant_id INTEGER NOT NULL,"
        . " subscription_id INTEGER NOT NULL,"
        . " amount REAL NOT NULL,"
        . " currency TEXT NOT NULL DEFAULT 'BRL',"
        . " status TEXT CHECK(status IN ('pending', 'paid', 'failed')) NOT NULL DEFAULT 'pending',"
        . " payment_method TEXT NOT NULL,"
        . " transaction_id TEXT UNIQUE NOT NULL,"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE,"
        . " FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON DELETE CASCADE"
        . ");"

        . "CREATE TABLE IF NOT EXISTS payment_methods ("
        . " id INTEGER PRIMARY KEY AUTOINCREMENT,"
        . " tenant_id INTEGER NOT NULL,"
        . " type TEXT CHECK(type IN ('card', 'pix', 'boleto')) NOT NULL,"
        . " details TEXT NOT NULL,"
        . " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
        . " FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE"
        . ");";

    // Executar script SQL
    $pdo->exec($sql);

    echo "Banco de dados criado com sucesso!\n";
} catch (PDOException $e) {
    die("Erro ao criar o banco de dados: " . $e->getMessage());
}
