<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log out</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
 </head>

<body>

<header>
  	<a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
</header>

<div class="center post-display" >

<?php 
session_start();

if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) {
	session_destroy();
} else {
	echo "You're already logged out!<br />";
}


echo "Click <a href=\"./index.php\">here</a> to go to the index page.";

?>

</div>

</body>
</html>