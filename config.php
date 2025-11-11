<?php
// config.php
session_start();

$DB_HOST = '127.0.0.1';
$DB_NAME = 'indiabus';
$DB_USER = 'root';
$DB_PASS = ''; // XAMPP default is empty; change if you have a password

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, $options);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB connection failed: '.$e->getMessage()]);
    exit;
}
