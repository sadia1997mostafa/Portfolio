<?php
session_start();

// Only check session
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}
?>


<?php
// Add new education entry
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $degree = $conn->real_escape_string($_POST['degree']);
    $institution = $conn->real_escape_string($_POST['institution']);
    $year = $conn->real_escape_string($_POST['year']);
    $img = $conn->real_escape_string($_POST['image_url']);

    $sql = "INSERT INTO education (Degree, Institution, Year, Image_url) 
            VALUES ('$degree', '$institution', '$year', '$img')";
    $conn->query($sql);

    header("Location: manage_education.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Education</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Add Education</h1>
    <form method="post">
        <label for="degree">Degree</label>
        <input type="text" id="degree" name="degree" required>

        <label for="institution">Institution</label>
        <input type="text" id="institution" name="institution" required>

        <label for="year">Year</label>
        <input type="text" id="year" name="year" required>

        <label for="image_url">Image URL</label>
        <input type="url" id="image_url" name="image_url">

        <button type="submit">Add Education</button>
    </form>
</div>
</body>
</html>
