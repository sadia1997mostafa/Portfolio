// Form to add education
// ...existing code...
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Education</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="admin-container">
		<h1>Add Education</h1>
		<form method="post" action="">
			<label for="degree">Degree</label>
			<input type="text" id="degree" name="degree" required>

			<label for="institution">Institution</label>
			<input type="text" id="institution" name="institution" required>

			<label for="year">Year</label>
			<input type="text" id="year" name="year" required>

			<button type="submit">Add Education</button>
		</form>
	</div>
</body>
</html>
