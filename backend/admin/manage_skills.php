<?php
include '../db.php';

// Delete record if delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM skills WHERE id=$id");
    header("Location: manage_skills.php");
    exit();
}

$result = $conn->query("SELECT * FROM skills ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Skills</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Manage Skills</h1>
    <a href="add_skills.php" class="btn">Add New Skill</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Skill</th>
                <th>Level</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['Id'] ?></td>
                <td><?= htmlspecialchars($row['Skill']) ?></td>
                <td><?= htmlspecialchars($row['Level']) ?></td>
                <td>
                    <?= htmlspecialchars($row['Image_url']) ?><br>
                    <img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="skill" width="50">
                </td>
                <td>
                    <a href="edit_skills.php?id=<?= $row['Id'] ?>">Edit</a> | 
                    <a href="?delete=<?= $row['Id'] ?>" onclick="return confirm('Delete this skill?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
