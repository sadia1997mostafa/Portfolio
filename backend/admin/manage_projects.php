
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
        <tr style="background:#222;"><th>Name</th><th>Description</th><th>Link</th><th>Actions</th></tr>
        <!-- Dummy data for frontend UI demonstration -->
        <tr>
            <td>Portfolio Website</td>
            <td>Personal portfolio with 3D animated homepage.</td>
            <td><a href="#" target="_blank" style="color:#00d4ff;">Visit</a></td>
            <td>
                <a href="edit_project.php?id=1" style="color:#ff6b6b;">Edit</a> |
                <a href="#" style="color:#ff4757;" onclick="alert('Delete UI only!');return false;">Delete</a>
            </td>
        </tr>
        <tr>
            <td>Admin Panel</td>
            <td>CRUD admin panel for managing portfolio content.</td>
            <td><a href="#" target="_blank" style="color:#00d4ff;">Visit</a></td>
            <td>
                <a href="edit_project.php?id=2" style="color:#ff6b6b;">Edit</a> |
                <a href="#" style="color:#ff4757;" onclick="alert('Delete UI only!');return false;">Delete</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
