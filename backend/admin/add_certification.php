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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $conn->real_escape_string($_POST['cert_name']);
	$org = $conn->real_escape_string($_POST['organization']);
	$date = $conn->real_escape_string($_POST['date']);
	$desc = $conn->real_escape_string($_POST['description']);
	$img = $conn->real_escape_string($_POST['image_url']);
	$sql = "INSERT INTO certifications (Cert_name, Organization, Date, Description, Image_url) VALUES ('$name', '$org', '$date', '$desc', '$img')";
	$conn->query($sql);
	header("Location: manage_certification.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Certification</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="admin-container">
		<h1>Add Certification</h1>
		<form method="post" action="">
			<label for="cert_name">Certification Name</label>
			<input type="text" id="cert_name" name="cert_name" required>

			<label for="organization">Issuing Organization</label>
			<input type="text" id="organization" name="organization" required>

			<label for="date">Date</label>
			<input type="date" id="date" name="date" required>

			<label for="description">Description</label>
			<textarea id="description" name="description" rows="3"></textarea>

			<label for="image_url">Image URL</label>
			<input type="url" id="image_url" name="image_url">

			<button type="submit">Add Certification</button>
		</form>
	</div>
</body>
</html>
