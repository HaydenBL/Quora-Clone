<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
 </head>

<body>

<header>
  	<a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
</header>

<div class="center post-display" >

<?php if($_SERVER['REQUEST_METHOD'] === 'POST') : ?>

<?php 

$email = $_POST["email"];
$password = md5($_POST["password"]);

require_once('../../mysqli-connect.php');

$sql = "SELECT * FROM Users WHERE email='" . htmlspecialchars($email) . "'";
$response = $conn->query($sql);

if($response) {
	if($row = mysqli_fetch_array($response)) {
		if($row["password"] === htmlspecialchars($password)) {
			session_start();
			$_SESSION["loggedin"] = true;
			$_SESSION["id"] = $row["id"];
			echo "Login success.<br />";
		} else {
			echo "Invalid login credentials.<br />";
		}
	} else {
		echo "Login error.<br />";
	}
} else {
	echo "Login error.<br />";
}

mysqli_free_result($response);

$conn->close();

echo "Click <a href=\"./index.php\">here</a> to go to the index page.";

?>

<?php else : ?>
	Error.

<?php endif; ?>

</div>

</body>
</html>