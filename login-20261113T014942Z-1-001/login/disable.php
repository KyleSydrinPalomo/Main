<?php

session_start();
include('db.php');

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = (int) $_POST['user_id'];
    $newStatus = isset($_POST['disable']) ? 0 : 1;

    $stmt = $conn->prepare("UPDATE users SET is_active = ? WHERE id = ?");
    $stmt->bind_param("ii", $newStatus, $userId);
    $stmt->execute();

    header("Location: logout.php?updated=1");
    exit();
}
?>


// query to update the table



// redirecto logout page, to destroy the session and in logout and we know that logout has that 
// header to locate us back to login
