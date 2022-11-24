<?php
echo isset($_POST)."</br>";
echo count($_POST)."</br>";
echo "Data: name=>".$_POST['name']." submit: ".$_POST['submit']."</br>";
// print_r($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post</title>
</head>
<body>
	<form action="post.php" method="post">
		<input type="text" name="name">
		<button type="submit" name="submit">Submit</button>
	</form>
</body>
</html>