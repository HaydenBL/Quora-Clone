<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Answer Form</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<header>
  	   <a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
  	</header>
<?php 
  session_start();
  if(isset($_SESSION["loggedin"])) {
  ?>
    <a href="./form-question.php"><img src="FAB.png" alt="Submit a question" title="Submit a question" id="FAB" /></a>
    
<?php
    $qid = $_GET["qid"];

    require_once('../../mysqli-connect.php');

    $qid = $_GET["qid"];

    $sql = "SELECT * FROM Questions WHERE id=" . $qid;
    $response = $conn->query($sql);
    if(mysqli_num_rows($response) > 0) {
?>

  	<h1 id="form-title" class="center">Submit an Answer</h1>
  	<div class="center" id="submit-section">
  		<form class="center" id="submit-form" onsubmit="return validateQA()" action=<?php echo "./answer.php?qid=" . $qid ?> method="post" enctype="multipart/form-data">
        <label id="error_msg" class="err_msg"></label>

        <label class="small_err" id="url_err"></label>
  			<input type="url" name="url" id="site-url" placeholder="Enter website URL"><br>
            <br />
            <textarea rows="10" cols="40" id="textform" name="text" placeholder="Enter your answer here (at least 30 characters)"></textarea> <br />
            Character count: <label id="charCount">0</label>/300
            <br />
  			<input type="submit" id="submit-button" name="question-submit" value="Submit"><br>
  		</form>
  	</div>
<?php
    } //end if 
    else {
?>
  
  <div class="center post-display" id="submit-section">Error: invalid question ID.</div>

<?php

  } //end else

} //end if
  else {
?>
    <div class="center post-display" id="submit-section">You must be logged in to view this page.</div>
<?php
  }
?>
    <script type="text/javascript" src="script.js"> </script>
    <script type="text/javascript" src="script-QA.js"> </script>

  </body>
</html>
