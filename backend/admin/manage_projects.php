
<?php
include '../db.php';
// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM projects WHERE id=$id");
    header("Location: manage_projects.php");
    exit();
}
$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Projects</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Manage Projects</h1>
    <a href="add_project.php" class="admin-nav">Add New Project</a>
    <table style="width:100%;margin-top:24px;background:#1a1a1a;color:#fff;border-radius:12px;">
        <tr style="background:#222;">
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>External Link</th>
            <th>GitHub</th>
            <th>Tech Stack</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['Project_name']) ?></td>
            <td><?= htmlspecialchars($row['Description']) ?></td>
            <td><img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="Project Image" style="width:80px;"></td>
            <td><a href="<?= htmlspecialchars($row['External_link']) ?>" target="_blank" style="color:#00d4ff;">Visit</a></td>
            <td><a href="<?= htmlspecialchars($row['Github_link']) ?>" target="_blank" style="color:#00d4ff;">GitHub</a></td>
            <td><?= htmlspecialchars($row['Tech_stack']) ?></td>
            <td>
                <a href="edit_project.php?id=<?= $row['Id'] ?>" style="color:#ff6b6b;">Edit</a> |
                <a href="manage_projects.php?delete=<?= $row['Id'] ?>" style="color:#ff4757;" onclick="return confirm('Delete this project?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
