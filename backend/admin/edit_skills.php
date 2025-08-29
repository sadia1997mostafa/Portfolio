<?php
include '../db.php';
$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM skills WHERE id=$id");
$skill = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['skill']);
    $level = $conn->real_escape_string($_POST['level']);
    $img = $conn->real_escape_string($_POST['image_url']);

    $sql = "UPDATE skills 
            SET Skill='$name', Level='$level', Image_url='$img' 
            WHERE id=$id";
    $conn->query($sql);

    header("Location: manage_skills.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Skill</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Edit Skill</h1>
    <form method="post">
        <label for="skill">Skill</label>
        <input type="text" id="skill" name="skill" value="<?= htmlspecialchars($skill['Skill']) ?>" required>

        <label for="level">Level</label>
        <input type="text" id="level" name="level" value="<?= htmlspecialchars($skill['Level']) ?>" required>

        <label for="image_url">Image URL</label>
        <input type="url" id="image_url" name="image_url" value="<?= htmlspecialchars($skill['Image_url']) ?>">

        <button type="submit">Update Skill</button>
    </form>
</div>
</body>
</html>
