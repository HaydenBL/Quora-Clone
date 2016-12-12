<?php

$mostRecent = $_GET["mostrecent"];

session_start();
$loggedin = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;

require_once('../../mysqli-connect.php');

if($mostRecent != null) {
	$sql = "SELECT * FROM Questions WHERE id > " . $mostRecent . " ORDER BY id DESC";
} else {
	$sql = "SELECT * FROM Questions ORDER BY id DESC";
}
$response = $conn->query($sql);

if($response) {
	while($row = mysqli_fetch_array($response)) {

		$sql = "SELECT * FROM Users WHERE id=" . $row["user_id"];
		$result = $conn->query($sql);
		if($result) {
			$user = mysqli_fetch_array($result);
			$avatarpath = "./avatars/avatar-" . $row["user_id"] . ".png";
			if(!file_exists($avatarpath)) {
				$avatarpath = "avatar.png";
			}
		}

    ?>

		<div class="question-display">

			<a href=<?php echo "./question-detail.php?qid=" . $row["id"] ?> class="question"><?php echo $row["question_text"]; ?></a>
			<img src=<?php echo "\"" . $avatarpath . "\""; ?> alt="Avatar" class="question-avatar">
			<br />
			<p class="date"><?php echo $row["time_asked"]; ?></p>
			
			<a href= <?php echo "./question-detail.php?qid=" . $row["id"] ?> class="num-answers"><?php echo $row["num_answers"]; ?> answers</a>
			<?php if($loggedin) { ?>
			<a href=<?php echo "./form-answer.php?qid=" . $row["id"]; ?> class="answer-button">Answer!</a>
			<?php } //end if ?>
			<br />
			<hr />

			<aside class="answer-bottom-section">
				<?php if($row["num_answers"] > 0) {

					$sql = "SELECT * FROM Answers WHERE id=" . $row["top_answer_id"];
					$result = $conn->query($sql);

					$answer = mysqli_fetch_array($result);
					$top_answer_user_id = $answer["user_id"];

					$sql = "SELECT * FROM Users WHERE id=" . $top_answer_user_id;
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
				<p class="inline answerer-name"><i>Top answer by <?php echo $top_answerer["username"]; ?></i></p>
				<img src=<?php echo $avatarpath; ?> alt="Avatar" id="answer-avatar" />
				<p class="top-answer"><?php echo $answer["answer_text"]; ?></p>
				<?php } else { ?>
				<p class="no-answers">There are no answers yet.<br />Be the first!</p>
				<?php } ?>
			</aside>

		</div>

<?php
	} //end while
	mysqli_free_result($response);
} //end if
else { ?>
		<div class="question-display post-display">
			No questions found.
		</div>

<?php } //end else  ?>