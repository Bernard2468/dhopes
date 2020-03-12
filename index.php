<?php
session_start();

//("server","username","paasword","databasename");

$conn = mysqli_connect("localhost","root","","NsroTution");

if(!$conn){

	echo "Unable Connected";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>NsroTution</title>
</head>
<body>
	<form action="#" method="POST" style="float:right;">
		<input type="text" name="username" placeholder="Enter Your username">
		<input type="password" name="password" placeholder="enter your password"><br/>

		<input type="submit" name="signin" value="signin">

	</form>

	<br/>
	<br/>
	<br/>

	<form action="#" method="POST">
		<input type="text" name="username" placeholder="Enter Your username"><br/>

		<input type="text" name="fname" placeholder="Input Your firstname"><br/>

		<input type="text" name="lname" placeholder="Input Your lastname"><br/>

		<input type="password" name="password" placeholder="Enter New password"><br/>

		<input type="password" name="rpassword" placeholder="Repeate password"><br/>
		<input type="submit" name="signup" value="signup"><br/>

	</form>
	
</body>
</html>


<?php 

if (isset($_POST["signin"])) {
	$username=$_POST["username"];
	
	$password=$_POST["password"];


	if ($username=="") {

		echo "Enter username";
	}else{
		if ($password!="") {

			$enc_pass=md5($password);
			$query=mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$enc_pass' ");
			$bern=mysqli_num_rows($query);

			if ($bern!=0) {

				$fetch = mysqli_fetch_assoc($query);

				$_SESSION["username"]=$fetch["username"];
				$_SESSION["id"]=$fetch["id"];
				$_SESSION["fname"]=$fetch["fname"];
				$_SESSION["lname"]=$fetch["lname"];

				header("Location:home.php");

			}else{
				echo "username and password does not match";
			}

		 // echo "you are through";
		}else{
			echo "enter password";
		}
	}	
}

if (isset($_POST["signup"])) {
	$username=$_POST["username"];
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$password=$_POST["password"];
	$rpassword=$_POST["rpassword"];


	if ($username != "" AND $password != "" AND $rpassword != "") {
		if($rpassword == $password){

			// echo "username : $username <br/> fname : $fname<br/>; lname : $lname<br/>; password : $password<br/>; rpassword : $rpassword<br/>";

			$query=mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

			$num=mysqli_num_rows($query);

			if ($num!=0) {
				echo "username already exist";
			}else{

				$enc_pass=md5($password);
				mysqli_query($conn,"INSERT INTO users(username,fname,lname,password) VALUES ('$username' , '$fname' , '$lname' , '$enc_pass')");	
			}
		}else{

			echo " <span style=background-color:red;> password do not match;</span> ";

		}

	}
	else{
		echo " <span style=background-color:red;> pls no field should be left empty;</span> ";

	}
} 

?>