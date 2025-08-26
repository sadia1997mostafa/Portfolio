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
    <?php
    include '../db.php';
    $result = $conn->query("SELECT * FROM certifications ORDER BY Id DESC");
    ?>
    <table style="width:100%;margin-top:24px;background:#1a1a1a;color:#fff;border-radius:12px;">
        <tr style="background:#222;"><th>Name</th><th>Organization</th><th>Date</th><th>Description</th><th>Image</th></tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['Cert_name']) ?></td>
            <td><?= htmlspecialchars($row['Organization']) ?></td>
            <td><?= htmlspecialchars($row['Date']) ?></td>
            <td><?= htmlspecialchars($row['Description']) ?></td>
            <td><img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="Certification Image" style="width:80px;"></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
