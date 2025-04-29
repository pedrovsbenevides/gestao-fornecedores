<?php
require_once dirname(dirname(__FILE__)) . '\config\connection.php';

use backend\db\config\Connection;

try {
    $pdo = Connection::Connect();

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS demandas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            cep TEXT NOT NULL
        );
        CREATE TABLE IF NOT EXISTS fornecedores (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            razao_social TEXT NOT NULL,
            cep TEXT NOT NULL
        );
        CREATE TABLE IF NOT EXISTS demandas_fornecedores (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            demanda_id INTEGER NOT NULL,
            fornecedor_id INTEGER NOT NULL,
            created_at DATETIME NOT NULL,
            FOREIGN KEY (demanda_id) REFERENCES demandas(id),
            FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id)
        );
    ");

    echo "Migrated";
} catch (PDOException $e) {
    echo $e->getMessage();
}
