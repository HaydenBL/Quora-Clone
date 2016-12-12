<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
 </head>

<body>

<header>
  	<a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
</header>

<?php if($_SERVER['REQUEST_METHOD'] === 'POST') : ?>

<?php 

$username = $_POST["username"];
$password = $_POST["password"];
$pswdconfirm = $_POST["pswdconfirm"];
$email = $_POST["email"];
$bday = $_POST["bday"];

$validUsername = preg_match('/^(?!\s)([A-Z0-9^\S]){8,}/i' , $username);
$validPassword = preg_match('/([A-Z0-9^\s]){8,}/i', $password);
$passMatch = $password === $pswdconfirm;
$validEmail = preg_match('/[A-Z]+@[A-Z]+[.][A-Z]+/i', $email);
$validBday = preg_match('/([0-9]){4}[-]([0-9]){2}[-]([0-9]){2}/i', $bday);

?>
<div class="center post-display" >

<?php

if($validUsername && $validPassword && $passMatch
	&& $validEmail && $validBday) {

	require_once('../../mysqli-connect.php'); 

	$sql = "CREATE TABLE Users
		(
		id int NOT NULL AUTO_INCREMENT,
		username varchar(255) NOT NULL UNIQUE,
		password varchar(255) NOT NULL,
		email varchar(255) NOT NULL UNIQUE,
		birthday varchar(255) NOT NULL,
		PRIMARY KEY(id)
		);";
	$conn->query($sql);
	//encrypt passwords
	$password = md5($_POST["password"]);
	$pswdconfirm = md5($_POST["pswdconfirm"]);

	$sql = "INSERT INTO Users(username, password, email, birthday)
	VALUES ('"
	. htmlspecialchars($username) . "', '"
	. htmlspecialchars($password) . "', '"
	. htmlspecialchars($email) . "', '"
	. htmlspecialchars($bday) . "');" ;

	if($conn->query($sql) === TRUE) {
		if(!empty($_FILES["upload"]["name"])) {
			
			$last_id = $conn->insert_id;
			$target_dir = "avatars/";
			$target_file = $target_dir. "avatar-" . $last_id . ".png";
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["upload"]["tmp_name"]);
		    if($check !== false) {
		        //echo "File is an image - " . $check["mime"] . ".<br />";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.<br />";
		        $uploadOk = 0;
		    }

			// Check file size
			if ($_FILES["upload"]["size"] > 500000) {
			    echo "File is too large.<br />";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Only JPG, JPEG, PNG & GIF files are allowed.<br />";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.<br />";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
			        echo "Your avatar has been uploaded.<br />";
			    } else {
			        echo "Avatar was too large.<br />";
			    }
			}
		} else {
			echo "No image set.<br />";
		}

		echo "Registration successful.<br />";

	} else {
		echo "Error: could not add user: " . $conn->error . "<br />";
	}
} else {
	echo "Registration error.<br />";
}

echo "Click <a href=\"./index.php\">here</a> to go to the index page.";

//TESTING CODE, DELETE LATER;
//$conn->query("DROP TABLE Users;");

$conn->close();

?>

<?php else : ?>

    <div class="center post-display">Error</div>

<?php endif; ?>

</div>

</body>
</html>