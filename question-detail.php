<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Question Detail</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" type="text/css" href="custom.css">
    <link rel="stylesheet" type="text/css" href="question-display.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="script.js"></script>
  </head>
  <body>
  	<?php require_once('header.php'); ?>

<?php if($loggedin) : ?>
    <a href="./form-question.php"><img src="FAB.png" alt="Submit a question" title="Submit a question" id="FAB" /></a>
<?php endif; ?>

<div class="container">

<div class="column-8">
  <div id="user-question">
  <?php
      require_once('mysqli-connect.php');

      $qid = $_GET["qid"];

      $sql = "SELECT * FROM Questions WHERE id=" . $qid;
      $response = $conn->query($sql);
      if($response) {
      if(mysqli_num_rows($response) > 0) {
          while($row = mysqli_fetch_array($response)){
              $avatarpath = "./avatars/avatar-" . $row["user_id"] . ".png";
              if(!file_exists($avatarpath)) {
                  $avatarpath = "avatar.png";
              }

              $sql2 = "SELECT * FROM Users WHERE id=" . $row["user_id"];
              $response2 = $conn->query($sql2);
              $user = mysqli_fetch_array($response2);

  ?>
      <div class="column-2">
        <img src=<?php echo $avatarpath; ?> alt="Avatar" id="qd-avatar" />
        <p id="qd-username"><?php echo $user["username"]; ?></p>
      </div>
  		<div class="column-10">
          <p id="qd-question"><?php echo $row["question_text"]; ?></p>
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
      <!-- <hr> -->
          <?php //if($loggedin) { ?>
          <!-- <a href=<?php echo "./form-answer.php?qid=" . $row["id"]; ?> class="answer-button">+ ans</a> -->

  <?php            // } //end if

          } //end while
  ?>

	</div>

  <div id="answer-list">

  <?php
      $sql = "SELECT * FROM Answers WHERE question_id=" . $qid . " ORDER BY upvotes-downvotes DESC";
      $response = $conn->query($sql);

      if($response) {
          if(mysqli_num_rows($response) > 0) {
          while($row = mysqli_fetch_array($response)) {
              $user_id = $row["user_id"];

              $sql = "SELECT * FROM Users WHERE id=" . $user_id;
              $result = $conn->query($sql);
              if($user = mysqli_fetch_array($result)) {}
  ?>

  	<div class="qd-answer">
          <?php
              if($loggedin){
              $sql = "SELECT value FROM Votes WHERE user_id=" . $_SESSION["id"] . " AND answer_id=" . $row["id"];
              $result = $conn->query($sql);
          }
              ?>
          <aside class="votes">

              <img src="upvote-grey.png" alt=<?php echo "\"" . $row["id"] . "\""; ?> class="upvote-arrow
              <?php
                  if($result) {

                      $vote = mysqli_fetch_array($result);
                      if($vote["value"] == 1) { echo "upvote-highlight"; }
                      else { echo "upvote-unhighlight"; }

                  } else { echo "upvote-unhighlight"; }

              ?>" />
              <label class="upvote-count"><?php echo $row["upvotes"]; ?> Upvotes</label>
              <br />

              <img src="downvote-grey.png" alt=<?php echo "\"" . $row["id"] . "\""; ?> class="downvote-arrow
              <?php
                  if($result) {
                      if($vote["value"] == -1) { echo "downvote-highlight"; }
                      else { echo "downvote-unhighlight"; }

                  } else { echo "downvote-unhighlight"; }

              ?>" />
              <label class="downvote-count"><?php echo $row["downvotes"]; ?> Downvotes</label>
          </aside>


          <aside class="answerer-info">
              <label class="answer-username"><?php echo $user["username"] ?></label>
          </aside>
          <hr />
          <label class="answer-text"><?php echo $row["answer_text"]; ?></label>
  	</div>


  <?php } //end while loop
      } //end if(rows > 0)
      else {

  ?>

      <div class="qd-answer post-display no-answers">There are no answers yet.<br />Be the first!</div>

  <?php

      } //end else(no answers)


      mysqli_free_result($response);
      } //end if(response)

      } //end if(question id exists)
      } //end if (response)
      else {
          echo "Error.";
      }

  ?>
      </div>
</div>
<div class="column-4">
  <?php require_once('ad-section.php'); ?>
</div>
</div>


    <?php if($loggedin) { ?>
    <script type="text/javascript" src="script-qd.js"></script>
    <?php } ?>
    </body>
</html>
