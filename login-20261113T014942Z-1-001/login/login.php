<?php
session_start();
include('db.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Check if the account is disabled (0 = disabled, 1 = active)
            if ((int)$user['is_active'] === 0) {
                $errors[] = "Account is disabled.";
            } else {
                $_SESSION['username'] = $user['username'];
                header("Location: dashboard.php");
                exit();
            }
        } else {
            $errors[] = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
        <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password">
        <br><br>
        <button type="submit">Login</button>
    </form>
    <br><br>
    <a href="register.php">Register</a>
    <br><br>
    <?php
    foreach ($errors as $error) {
        echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>";
    }
    ?>
</body>
</html>
