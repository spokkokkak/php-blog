<?php
session_start(); 
require_once '../src/config/database.php';

header('Content-Type: application/json');
$response = ['status' => 'failed', 'message' => '']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $response['message'] = 'Invalid CSRF token';
        echo json_encode($response);
        exit;
    }

    try {
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("UPDATE users SET plan = 'free' WHERE id = ?");
        $stmt->execute([$user_id]);

         // Fetch the updated user information
         $stmt = $conn->prepare("SELECT plan FROM users WHERE id = ?");
         $stmt->execute([$user_id]);
         $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $response['status'] = 'success';
        $response['message'] = 'Cancelled Premium successfully';

        // Update the session variable
        $_SESSION['plan'] = $user['plan'];
        session_write_close();

        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
        header("Location: $referrer");



    } catch (PDOException $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Unauthorized request';
}
echo json_encode($response);
