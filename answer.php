<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Answer Submtted</title>
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
      $answer = $_POST["text"];
      $user_id = $_SESSION["id"];
      $qid = $_GET["qid"];

      $validURL = preg_match('/[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/i', $url);
      $validAnswer = strlen($answer) <= 300;

      if($validURL && $validAnswer) {

      require_once('../../mysqli-connect.php');

      $sql = "CREATE TABLE Answers
              (
              id int NOT NULL AUTO_INCREMENT,
              user_id int NOT NULL,
              answer_text varchar(500) NOT NULL,
              question_id int NOT NULL,
              upvotes int NOT NULL,
              downvotes int NOT NULL,
              PRIMARY KEY(id)
              );";

      $conn->query($sql);

      $sql = "INSERT INTO Answers(user_id, answer_text, question_id, upvotes, downvotes)
      VALUES ("
      . $user_id . ", \""
      . htmlspecialchars($answer) . "\", \""
      . $qid . "\", 0, 0);" ;

      if($conn->query($sql) === TRUE) {
        $sql = "UPDATE Questions SET num_answers=num_answers+1 WHERE id=" . $qid;
        $conn->query($sql);

        include("./update-top-answer.php");
        updateTopAnswer($conn, $qid);

        echo "Answer successfully submitted.<br />";
        echo "Click <a href=\"./question-detail.php?qid=" . $qid . "\">here</a> to go back to question.";

      } else {
        echo "Error submitting Answer.<br />";
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