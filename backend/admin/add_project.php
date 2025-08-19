// Form to add a new project
// ...existing code...
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

			<label for="link">Project Link</label>
			<input type="url" id="link" name="link">

			<button type="submit">Add Project</button>
		</form>
	</div>
</body>
</html>
