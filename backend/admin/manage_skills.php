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
    <a href="add_skills.php" class="admin-nav">Add New Skill</a>
    <table style="width:100%;margin-top:24px;background:#1a1a1a;color:#fff;border-radius:12px;">
        <tr style="background:#222;"><th>Skill</th><th>Level</th><th>Actions</th></tr>
        <tr>
            <td>HTML/CSS</td>
            <td>Expert</td>
            <td>
                <a href="edit_skills.php?id=1" style="color:#ff6b6b;">Edit</a> |
                <a href="#" style="color:#ff4757;" onclick="alert('Delete UI only!');return false;">Delete</a>
            </td>
        </tr>
        <tr>
            <td>JavaScript</td>
            <td>Intermediate</td>
            <td>
                <a href="edit_skills.php?id=2" style="color:#ff6b6b;">Edit</a> |
                <a href="#" style="color:#ff4757;" onclick="alert('Delete UI only!');return false;">Delete</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
