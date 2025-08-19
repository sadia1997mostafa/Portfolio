// Form to add certification
// ...existing code...
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

			<button type="submit">Add Certification</button>
		</form>
	</div>
</body>
</html>
