<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Certifications</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <h1>Manage Certifications</h1>
    <a href="add_certification.php" class="admin-nav">Add New Certification</a>
    <table style="width:100%;margin-top:24px;background:#1a1a1a;color:#fff;border-radius:12px;">
        <tr style="background:#222;"><th>Name</th><th>Organization</th><th>Date</th><th>Actions</th></tr>
        <tr>
            <td>Web Development</td>
            <td>Coursera</td>
            <td>2024-05-10</td>
            <td>
                <a href="edit_certification.php?id=1" style="color:#ff6b6b;">Edit</a> |
                <a href="#" style="color:#ff4757;" onclick="alert('Delete UI only!');return false;">Delete</a>
            </td>
        </tr>
        <tr>
            <td>JavaScript Mastery</td>
            <td>Udemy</td>
            <td>2023-11-20</td>
            <td>
                <a href="edit_certification.php?id=2" style="color:#ff6b6b;">Edit</a> |
                <a href="#" style="color:#ff4757;" onclick="alert('Delete UI only!');return false;">Delete</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
