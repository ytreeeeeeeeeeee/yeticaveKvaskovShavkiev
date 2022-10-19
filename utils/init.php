<?php

$db = (require 'utils/config.php')['db'];

$dsn = "{$db['driver']}:host={$db['host']};dbname={$db['name']};charset={$db['charset']}";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$db['charset']} COLLATE {$db['collate']}"
];

try {
    $con = new PDO($dsn, $db['username'], $db['password'], $options);
} catch (PDOException $e) {
    die("Ошибка: {$e->getMessage()}");
}

session_start();

$is_auth = isset($_SESSION['user_id']);

$user_name = $_SESSION['user_name'] ?? "";
