<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Question Form</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" type="text/css" href="custom.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<?php require_once("header.php"); ?>

    <?php
    // session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>

  	<h1 id="form-title" class="center">Submit a Question</h1>
  	<div class="center" id="submit-section">
  		<form class="center" id="submit-form" onsubmit="return validateQA()" action="question.php" method="post" enctype="multipart/form-data">
        <label id="error_msg" class="err_msg"></label>

        <label class="small_err" id="url_err"></label>
  			<input type="url" name="url" id="site-url" placeholder="Enter website URL">

        <select name="category">
          <option value="unSpecified">Select an option</option>
          <option value="Game">Game</option>
          <option value="Gym/Yoga">Gym/Yoga</option>
          <option value="Health">Health</option>
          <option value="History">History</option>
          <option value="India">India</option>
          <option value="Inspiration">Inspiration</option>
          <option value="Investment">Investment</option>
          <option value="Life">Life</option>
          <option value="Place">Place</option>
          <option value="Politics">Politics</option>
          <option value="Religious">Religious</option>
          <option value="Research">Research</option>
          <option value="Science">Science</option>
          <option value="Spiritual">Spiritual</option>
          <option value="Sports">Sports</option>
          <option value="Studies">Studies</option>
          <option value="Technology">Technology</option>
          <option value="Travel">Travel</option>
          <option value="World">World</option>
          <option value="others">Others</option>
        </select>

        <textarea rows="10" cols="40" id="textform" name="text" placeholder="Enter your question here (at least 30 characters)"></textarea> <br />
        Character count: <label id="charCount">0</label>/300

  			<input type="submit" id="submit-button" name="question-submit" value="Submit">
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
