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
        <input type="text" id="skill" name="skill" value="HTML/CSS" required>
        <label for="level">Level</label>
        <input type="text" id="level" name="level" value="Expert" required>
        <button type="submit" onclick="alert('Demo only: No update performed');return false;">Update Skill</button>
    </form>
</div>
</body>
</html>
