
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Edit Project</h1>
    <form method="post">
        <label for="project_name">Project Name</label>
        <input type="text" id="project_name" name="project_name" value="Portfolio Website" required>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required>Personal portfolio with 3D animated homepage.</textarea>
        <label for="link">Project Link</label>
        <input type="url" id="link" name="link" value="#">
        <button type="submit" onclick="alert('Demo only: No update performed');return false;">Update Project</button>
    </form>
</div>
</body>
</html>
