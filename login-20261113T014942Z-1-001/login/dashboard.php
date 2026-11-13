<?php
session_start();
include('db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle the Disable Account button click
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['disable'])) {
    $username = $_SESSION['username'];
    $newStatus = 0; // 0 = disabled

    // Update using 'username' instead of 'id'
    $stmt = $conn->prepare("UPDATE users SET is_active = ? WHERE username = ?");
    $stmt->bind_param("is", $newStatus, $username);
    $stmt->execute();

    // Log the user out immediately after disabling their account
    header("Location: logout.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
    <br>
    <a href="profile.php">Edit Profile</a> | <a href="logout.php">Logout</a> | 
    <form action="" method="POST" style="display:inline;">
        <button type="submit" name="disable" value="1">Disable Account</button>
    </form>
</body>

</html>
