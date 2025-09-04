<?php
session_start();

// Only check session
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}
?>



<?php
include '../db.php';
$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM education WHERE id=$id");
$edu = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $degree = $conn->real_escape_string($_POST['degree']);
    $institution = $conn->real_escape_string($_POST['institution']);
    $year = $conn->real_escape_string($_POST['year']);
    $img = $conn->real_escape_string($_POST['image_url']);

    $sql = "UPDATE education 
            SET Degree='$degree', Institution='$institution', Year='$year', Image_url='$img' 
            WHERE id=$id";
    $conn->query($sql);

    header("Location: manage_education.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Education</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Edit Education</h1>
    <form method="post">
        <label for="degree">Degree</label>
        <input type="text" id="degree" name="degree" value="<?= htmlspecialchars($edu['Degree']) ?>" required>

        <label for="institution">Institution</label>
        <input type="text" id="institution" name="institution" value="<?= htmlspecialchars($edu['Institution']) ?>" required>

        <label for="year">Year</label>
        <input type="text" id="year" name="year" value="<?= htmlspecialchars($edu['Year']) ?>" required>

        <label for="image_url">Image URL</label>
        <input type="url" id="image_url" name="image_url" value="<?= htmlspecialchars($edu['Image_url']) ?>">

        <button type="submit">Update Education</button>
    </form>
</div>
</body>
</html>
