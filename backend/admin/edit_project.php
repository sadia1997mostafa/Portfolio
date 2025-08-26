
<?php
include '../db.php';
$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM projects WHERE id=$id");
$project = $res->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['project_name']);
    $desc = $conn->real_escape_string($_POST['description']);
    $img = $conn->real_escape_string($_POST['image_url']);
    $ext = $conn->real_escape_string($_POST['external_link']);
    $git = $conn->real_escape_string($_POST['github_link']);
    $tech = $conn->real_escape_string($_POST['tech_stack']);
    $sql = "UPDATE projects SET project_name='$name', description='$desc', image_url='$img', external_link='$ext', Github_link='$git', tech_stack='$tech' WHERE id=$id";
    $conn->query($sql);
    header("Location: manage_projects.php");
    exit();
}
?>
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
        <input type="text" id="project_name" name="project_name" value="<?= htmlspecialchars($project['project_name']) ?>" required>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required><?= htmlspecialchars($project['description']) ?></textarea>
        <label for="image_url">Image URL</label>
        <input type="url" id="image_url" name="image_url" value="<?= htmlspecialchars($project['image_url']) ?>">
        <label for="external_link">External Link</label>
        <input type="url" id="external_link" name="external_link" value="<?= htmlspecialchars($project['external_link']) ?>">
    <label for="github_link">GitHub Link</label>
    <input type="url" id="github_link" name="github_link" value="<?= htmlspecialchars($project['Github_link']) ?>">
        <label for="tech_stack">Tech Stack (comma separated)</label>
        <input type="text" id="tech_stack" name="tech_stack" value="<?= htmlspecialchars($project['tech_stack']) ?>">
        <button type="submit">Update Project</button>
    </form>
</div>
</body>
</html>
