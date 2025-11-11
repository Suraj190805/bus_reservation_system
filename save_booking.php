<?php
// save_booking.php
header('Content-Type: application/json');
require 'config.php';

if(empty($_SESSION['user_id'])){
    http_response_code(401);
    echo json_encode(['ok'=>false,'msg'=>'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

$ticketNumber = $input['ticketNumber'] ?? null;
$serviceId = $input['serviceId'] ?? null;
$serviceName = $input['serviceName'] ?? null;
$busNumber = $input['busNumber'] ?? null;
$seats = $input['seats'] ?? null; // array
$date = $input['date'] ?? null; // string
$price = $input['price'] ?? 0;
$paidBy = $input['paidBy'] ?? null;

if(!$ticketNumber || !$serviceId){
    http_response_code(400);
    echo json_encode(['ok'=>false,'msg'=>'Missing booking data']);
    exit;
}

try{
    $stmt = $pdo->prepare("INSERT INTO bookings (ticket_number, user_id, service_id, service_name, bus_number, seats, travel_date, amount, paid_by)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $seatJson = json_encode($seats);
    // convert date to YYYY-MM-DD or null
    $dt = null;
    if($date){
        $dtObj = date_create($date);
        if($dtObj) $dt = $dtObj->format('Y-m-d');
    }
    $stmt->execute([$ticketNumber, $_SESSION['user_id'], $serviceId, $serviceName, $busNumber, $seatJson, $dt, $price, $paidBy]);
    echo json_encode(['ok'=>true,'msg'=>'Saved']);
} catch(Exception $e){
    http_response_code(500);
    echo json_encode(['ok'=>false,'msg'=>'DB error: '.$e->getMessage()]);
}
