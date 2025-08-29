<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill = $conn->real_escape_string($_POST['skill']);
    $level = $conn->real_escape_string($_POST['level']);
    $img = $conn->real_escape_string($_POST['image_url']);

    $sql = "INSERT INTO skills (Skill, Level, Image_url) 
            VALUES ('$skill', '$level', '$img')";
    $conn->query($sql);

    header("Location: manage_skills.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Skill</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Add Skill</h1>
    <form method="post">
        <label for="skill">Skill</label>
        <input type="text" id="skill" name="skill" required>

        <label for="level">Level</label>
        <input type="text" id="level" name="level" placeholder="Beginner, Intermediate, Expert" required>

        <label for="image_url">Image URL</label>
        <input type="url" id="image_url" name="image_url">

        <button type="submit">Add Skill</button>
    </form>
</div>
</body>
</html>
