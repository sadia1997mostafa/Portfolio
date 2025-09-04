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

// Delete record if delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM education WHERE id=$id");
    header("Location: manage_education.php");
    exit();
}

$result = $conn->query("SELECT * FROM education ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Education</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Manage Education</h1>
    <a href="add_education.php" class="btn">Add New Education</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Degree</th>
                <th>Institution</th>
                <th>Year</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['Id'] ?></td>
                <td><?= htmlspecialchars($row['Degree']) ?></td>
                <td><?= htmlspecialchars($row['Institution']) ?></td>
                <td><?= htmlspecialchars($row['Year']) ?></td>
                <td><img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="edu" width="60"></td>
                <td>
                    <a href="edit_education.php?id=<?= $row['Id'] ?>">Edit</a> | 
                    <a href="?delete=<?= $row['Id'] ?>" onclick="return confirm('Delete this entry?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
