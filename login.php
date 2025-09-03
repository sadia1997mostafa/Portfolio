<?php
session_start();
include 'backend/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']); // match your DB hash

    // Column names with correct capitalization
    $sql = "SELECT * FROM admin WHERE Email='$email' AND Password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $_SESSION['admin'] = $email; // store admin email in session
        header("Location: backend/admin/index.php");
        exit();
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link rel="stylesheet" href="styles.css">
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #0a1a2b;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }
    .login-container {
        background: rgba(5,5,20,0.95);
        padding: 40px;
        border-radius: 10px;
        color: #fff;
        box-shadow: 0 0 15px #00e0ff;
        text-align: center;
        width: 320px;
    }
    .login-container h2 {
        margin-bottom: 20px;
    }
    .login-container input {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border-radius: 6px;
        border: none;
        outline: none;
    }
    .login-container button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background: #00e0ff;
        color: #111;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .login-container button:hover {
        background: #0077ff;
        color: #fff;
    }
    .login-container p.error {
        color: #ff4d4d;
        font-weight: 500;
    }
</style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
