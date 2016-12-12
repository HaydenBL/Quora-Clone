<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Question Submtted</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<header>
  	<a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
  	</header>

    <div class="center post-display" >
<?php session_start();
      if($_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_SESSION["loggedin"])
        && isset($_SESSION["id"])
        && $_SESSION["loggedin"] === true)
: ?>

<?php

      $url = $_POST["url"];
      $question = $_POST["text"];
      $user_id = $_SESSION["id"];
      $timestamp = date('Y-m-d g:i:s');

      $validURL = preg_match('/[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/i', $url);
      $validQuestion = strlen($question) <= 300;

      if($validURL && $validQuestion) {

      require_once('../../mysqli-connect.php');

      $sql = "CREATE TABLE Questions
              (
              id int NOT NULL AUTO_INCREMENT,
              user_id int NOT NULL,
              question_text varchar(500) NOT NULL,
              num_answers int NOT NULL,
              time_asked timestamp NOT NULL,
              top_answer_id int,
              PRIMARY KEY(id)
              );";

      $conn->query($sql);

      $sql = "INSERT INTO Questions(user_id, question_text, num_answers, time_asked)
      VALUES ("
      . $user_id . ", \""
      . htmlspecialchars($question) . "\", 0, \""
      . $timestamp . "\");";

      if($conn->query($sql) === TRUE) {
        echo "Question successfully submitted.<br />";
        echo "Click <a href=\"./question-detail.php?qid=" . $conn->insert_id . "\">here</a> to go back to question.";
      } else {
        echo "Error submitting question.<br />";
        echo $conn->error . "<br />";
      }

      $conn->close();
    } else {
      echo "Invalid submission.";
    }

?>
<?php else : ?>

      Error

<?php endif; ?>

    </div>
  </body>
</html>