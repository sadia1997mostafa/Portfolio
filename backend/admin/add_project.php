// Form to add a new project
// ...existing code...
?>
<?php
include '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $conn->real_escape_string($_POST['project_name']);
	$desc = $conn->real_escape_string($_POST['description']);
	$img = $conn->real_escape_string($_POST['image_url']);
	$ext = $conn->real_escape_string($_POST['external_link']);
	$git = $conn->real_escape_string($_POST['github_link']);
	$tech = $conn->real_escape_string($_POST['tech_stack']);
	$sql = "INSERT INTO projects (Project_name, Description, Image_url, External_link, Github_link, Tech_stack) VALUES ('$name', '$desc', '$img', '$ext', '$git', '$tech')";
	$conn->query($sql);
	header("Location: manage_projects.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Project</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="admin-container">
		<h1>Add Project</h1>
		<form method="post" action="">
			<label for="project_name">Project Name</label>
			<input type="text" id="project_name" name="project_name" required>

			<label for="description">Description</label>
			<textarea id="description" name="description" rows="4" required></textarea>

			<label for="image_url">Image URL</label>
			<input type="url" id="image_url" name="image_url">

			<label for="external_link">External Link</label>
			<input type="url" id="external_link" name="external_link">

			<label for="github_link">GitHub Link</label>
			<input type="url" id="github_link" name="github_link">

			<label for="tech_stack">Tech Stack (comma separated)</label>
			<input type="text" id="tech_stack" name="tech_stack" placeholder="e.g. React, Node.js, MongoDB">

			<button type="submit">Add Project</button>
		</form>
	</div>
</body>
</html>
