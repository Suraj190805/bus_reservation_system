<?php
// cancel_booking.php
header('Content-Type: application/json');
require 'config.php';

if(empty($_SESSION['user_id'])){
    http_response_code(401);
    echo json_encode(['ok'=>false,'msg'=>'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$busnum = trim($input['busNumber'] ?? '');
$sid = trim($input['serviceId'] ?? '');
$ticket = trim($input['ticketNumber'] ?? '');

if(!$busnum || !$sid || !$ticket){
    http_response_code(400);
    echo json_encode(['ok'=>false,'msg'=>'Missing fields']);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM bookings WHERE ticket_number = ? AND bus_number = ? AND service_id = ? AND user_id = ?");
$stmt->execute([$ticket, $busnum, $sid, $_SESSION['user_id']]);
$row = $stmt->fetch();
if(!$row){
    echo json_encode(['ok'=>false,'msg'=>'No matching booking']);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
$stmt->execute([$row['id']]);
echo json_encode(['ok'=>true,'msg'=>'Cancelled']);
