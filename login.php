<?php
// login.php
header('Content-Type: application/json');
require 'config.php';

$input = json_decode(file_get_contents('php://input'), true);
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if(!$email || !$password){
    http_response_code(400);
    echo json_encode(['ok'=>false,'msg'=>'Missing credentials']);
    exit;
}

$stmt = $pdo->prepare("SELECT id, fullname, email, password_hash FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if(!$user || !password_verify($password, $user['password_hash'])){
    echo json_encode(['ok'=>false,'msg'=>'Invalid credentials']);
    exit;
}

// set session
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_name'] = $user['fullname'];

echo json_encode(['ok'=>true,'user'=>['id'=>$user['id'],'email'=>$user['email'],'name'=>$user['fullname']]]);

