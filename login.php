<?php
session_start();
include 'backend/db.php'; // adjust path to your DB

$error = '';

// If session already exists OR cookie exists, redirect to admin dashboard
if (isset($_SESSION['admin'])) {
    header("Location: backend/admin/index.php");
    exit();
} elseif (!isset($_SESSION['admin']) && isset($_COOKIE['admin_email'])) {
    $_SESSION['admin'] = $_COOKIE['admin_email'];
    header("Location: backend/admin/index.php");
    exit();
}

// Handle POST login
if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']); // match your DB hash

    $sql = "SELECT * FROM admin WHERE Email='$email' AND Password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        // Set session
        $_SESSION['admin'] = $email;

        // Set cookie if “Remember Me” is checked
        if (!empty($_POST['remember'])) {
            setcookie(
                'admin_email',
                $email,
                [
                    'expires' => time() + 7*24*60*60, // 7 days
                    'path' => '/',
                    'domain' => '',
                    'secure' => false, // must be false on localhost HTTP
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]
            );
        }

        // Redirect to admin dashboard
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
    <form method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <label><input type="checkbox" name="remember"> Remember Me</label><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>
