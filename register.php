<?php
// register.php
header('Content-Type: application/json');
require 'config.php';

$input = json_decode(file_get_contents('php://input'), true);
$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if(!$name || !$email || !$password){
    http_response_code(400);
    echo json_encode(['ok'=>false,'msg'=>'Missing fields']);
    exit;
}

try {
    // check exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if($stmt->fetch()){
        echo json_encode(['ok'=>false,'msg'=>'Account with that email already exists']);
        exit;
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password_hash) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $hash]);
    echo json_encode(['ok'=>true,'msg'=>'Account created']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['ok'=>false,'msg'=>'Server error']);
}
