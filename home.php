<?php session_start(); 

if (!isset($_SESSION["id"])) {
	header("Location:index.php");

	die("You need to login first");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php 
	echo $_SESSION["username"];?>
</title>

</head>
<body>

	
	<?php echo $_SESSION["id"]; ?><br/>
	<?php echo $_SESSION["username"]; ?><br/>
	<?php echo $_SESSION["fname"]; ?><br/>
	<?php echo $_SESSION["lname"]; ?><br/>

	<form action="#" method="POST">
		<input type="submit" name="logout" value="logout"><br/>
	</form>

	<?php 

	if (isset($_POST["logout"])) {
        session_destroy();
		header("Location:index.php");
	}?>
	
</body>
</html>

