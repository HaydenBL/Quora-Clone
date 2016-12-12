<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Question Form</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<header>
  	<a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
  	</header>

    <?php 
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>

  	<h1 id="form-title" class="center">Submit a Question</h1>
  	<div class="center" id="submit-section">
  		<form class="center" id="submit-form" onsubmit="return validateQA()" action="question.php" method="post" enctype="multipart/form-data">
        <label id="error_msg" class="err_msg"></label>

        <label class="small_err" id="url_err"></label>
  			<input type="url" name="url" id="site-url" placeholder="Enter website URL"><br>
        <br />

        <textarea rows="10" cols="40" id="textform" name="text" placeholder="Enter your question here (at least 30 characters)"></textarea> <br />
        Character count: <label id="charCount">0</label>/300
        <br />

  			<input type="submit" id="submit-button" name="question-submit" value="Submit"><br>
  		</form>
  	</div>

    <script type="text/javascript" src="script.js"> </script>
    <script type="text/javascript" src="script-QA.js"> </script>

    <?php else : ?>

    <div class="center post-display" id="submit-section">
      You must be logged in to view this page.
    </div>

    <?php endif; ?>

  </body>
</html>
