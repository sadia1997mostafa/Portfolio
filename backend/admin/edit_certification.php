<?php
session_start();

// Only check session
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Certification</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Edit Certification</h1>
    <form method="post">
        <label for="cert_name">Certification Name</label>
        <input type="text" id="cert_name" name="cert_name" value="Web Development" required>
        <label for="organization">Issuing Organization</label>
        <input type="text" id="organization" name="organization" value="Coursera" required>
        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="2024-05-10" required>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3">Certificate for web development course.</textarea>
        <button type="submit" onclick="alert('Demo only: No update performed');return false;">Update Certification</button>
    </form>
</div>
</body>
</html>
