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
        <input type="text" id="degree" name="degree" value="BSc Computer Science" required>
        <label for="institution">Institution</label>
        <input type="text" id="institution" name="institution" value="ABC University" required>
        <label for="year">Year</label>
        <input type="text" id="year" name="year" value="2022" required>
        <button type="submit" onclick="alert('Demo only: No update performed');return false;">Update Education</button>
    </form>
</div>
</body>
</html>
