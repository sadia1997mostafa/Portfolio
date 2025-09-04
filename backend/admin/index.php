<?php
session_start();

// Only check session
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="admin-container">
		<h1>Admin Panel</h1>
		<nav class="admin-nav">
			<a href="manage_projects.php">Manage Projects</a>
			<a href="manage_education.php">Manage Education</a>
			<a href="manage_skills.php">Manage Skills</a>
			<a href="manage_certification.php">Manage Certifications</a>
			  <a href="contact_management.php">Manage Contacts</a>
		</nav>
		<div>
			<a href="../../logout.php">Logout</a>

		</div>
		<p>Welcome to the admin dashboard. Choose an option above to add new content.</p>
	</div>
</body>
</html>
