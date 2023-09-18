<?php

function numberOfPages(): int
{

    global $pdo;

    $stmt = $pdo->query('SELECT COUNT(name) as "count" FROM products;');
    $rows = $stmt->fetch();
    $pages = (int)$rows['count'] / 10;

    return ceil($pages);
}

function dbConnect(): PDO
{
    $host = '127.0.0.1';
    $db   = 'mep_db_task';
    $user = 'homestead';
    $pass = 'secret';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new PDO($dsn, $user, $pass, $options);
}
