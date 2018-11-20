<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="custom.css"/>
    <link rel="stylesheet" type="text/css" href="mystyle.css"/>
    <link rel="stylesheet" type="text/css" href="signup.css"/>
    <link rel="stylesheet" type="text/css" href="question-display.css"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic,700' rel='stylesheet' type='text/css' >
    <script type="text/javascript" src="script.js"> </script>
  </head>

  <body onload="updateMostRecent(); setInterval( function() { refreshIndex(); }, 5000);">
  <?php  require_once("header.php"); ?>
  <?php  require_once("category-div.php"); ?>


  <!-- add question if logged in -->
	<?php if($loggedin) : ?>
	   <a href="./form-question.php"><img src="FAB.png" alt="Submit a question" title="Submit a question" id="FAB" /></a>
  <?php endif; ?>


<div class="container">
  <div class="column-8">
    <!-- list of questions in the database -->
    <div id="question-list">

    <?php
      require_once('mysqli-connect.php');
      DEFINE("maxPosts", 2000);

      require("update-top-answer.php");

      if(isset($_GET['cat']))
      {
        $sql = "SELECT * FROM Questions where category=\"".$_GET['cat']."\" ORDER BY id DESC;";
      }
      else {
        $sql = "SELECT * FROM Questions ORDER BY id DESC";
      }

      $response = $conn->query($sql);

      // checking if questions are present in the database
      if($response) {
        $count = 0;
        while($row = mysqli_fetch_array($response)) {
          updateTopAnswer($conn, $row["id"]);
          if($count == maxPosts) {
            break;
          }
          $count++;
          $sql = "SELECT * FROM Users WHERE id=" . $row["user_id"] . ";";
          $result = $conn->query($sql);
          if($result) {
            $user = mysqli_fetch_array($result);
            $avatarpath = "./avatars/avatar-" . $row["user_id"] . ".png";
            if(!file_exists($avatarpath)) {
              $avatarpath = "avatar.png";
            }
          }

      ?>

      <!-- inside question list div -->
      <div class="question-display">

        <div class="row">
          <div class="column-2">
            <!-- image of avatar -->
            <img src=<?php echo "\"" . $avatarpath . "\""; ?> alt="Avatar" class="question-avatar">
          </div>
          <!-- link to the page of question -->
          <div class="column-10">
            <div class="row">

              <a href=<?php echo "./question-detail.php?qid=" . $row["id"] ?> class="question"><h2><?php echo $row["question_text"]; ?></h2></a>

            </div>
            <div class="row">

              <div class="column-4">
                <!-- credentials -->
                <p class="date credentials"><?php echo date_format(date_create($row["time_asked"]), 'F jS Y g:i a'); ?></p>
              </div>
              <div class="column-4">
                <p class="credentials">Category: <?php echo $row["category"]; ?></p>
              </div>
              <div class="column-4">
                <!-- no of answers -->
                <p class="credentials"><?php echo $row["num_answers"]; ?> Answers<?php if($loggedin) : ?>
                     <a href=<?php echo "./form-answer.php?qid=" . $row["id"]; ?> class="answer-button">+</a>
                <?php endif; ?></p>
                <!-- <a href= <?php echo "./question-detail.php?qid=" . $row["id"] ?> class="num-answers"><?php echo $row["num_answers"]; ?> answers</a> -->
              <!-- </div>
              <div class="column-3"> -->
                <!-- answer if logged in -->

              </div>

            </div>
          </div>


        </div>



        <hr />

        <aside class="answer-bottom-section">
          <!-- inside answer section -->
          <?php if($row["num_answers"] > 0) {

            $sql = "SELECT * FROM Answers WHERE id=" . $row["top_answer_id"].";";
            $result = $conn->query($sql);

            $answer = mysqli_fetch_array($result);
            $top_answer_user_id = $answer["user_id"];

            $sql = "SELECT * FROM Users WHERE id=" . $top_answer_user_id.";";
            $result = $conn->query($sql);

            $top_answerer = NULL;
            if($user = mysqli_fetch_array($result)) {
              $top_answerer = $user;
            }

            $avatarpath = "./avatars/avatar-" . $top_answerer["id"] . ".png";
            if(!file_exists($avatarpath)) {
              $avatarpath = "avatar.png";
            }

           ?>
           <div class="column-2">
             <!-- profile image of the answerer -->
             <img src=<?php echo $avatarpath; ?> alt="Avatar" id="answer-avatar" />
             <!-- name of the answerer -->
             <p class="answerer-name"><?php echo $top_answerer["username"]; ?></p>

           </div>
          <div class="column-10">
            <!-- answer -->
            <p class="top-answer"><?php echo $answer["answer_text"]; ?></p>
          </div>

          <?php
            }
            // incase no answer is found
            else { ?>
          <p class="no-answers">There are no answers yet.<br />Be the first!</p>
          <?php } ?>
        </aside>

      </div>
      <!-- end of question display -->

    <?php
      } //end while
      mysqli_free_result($response);
    } //end if
    else { ?>
      <div class="question-display post-display">
        No questions found.
      </div>

  <?php } //end else  ?>
    </div>
    <!-- end of question list -->

  </div>

  <div class="column-4">
    <?php require('ad-section.php'); ?>
  </div>
</div>


  </body>
</html>
