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
    <a href="add_education.php" class="admin-nav">Add New Education</a>
    <table style="width:100%;margin-top:24px;background:#1a1a1a;color:#fff;border-radius:12px;">
        <tr style="background:#222;"><th>Degree</th><th>Institution</th><th>Year</th><th>Actions</th></tr>
        <tr>
            <td>BSc Computer Science</td>
            <td>ABC University</td>
            <td>2022</td>
            <td>
                <a href="edit_education.php?id=1" style="color:#ff6b6b;">Edit</a> |
                <a href="#" style="color:#ff4757;" onclick="alert('Delete UI only!');return false;">Delete</a>
            </td>
        </tr>
        <tr>
            <td>MSc Data Science</td>
            <td>XYZ Institute</td>
            <td>2024</td>
            <td>
                <a href="edit_education.php?id=2" style="color:#ff6b6b;">Edit</a> |
                <a href="#" style="color:#ff4757;" onclick="alert('Delete UI only!');return false;">Delete</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
