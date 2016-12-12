<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE) {
	$user_id = $_SESSION["id"];
	$answer_id = $_GET["id"];

	require_once('../../mysqli-connect.php');

	//check if answer exists
	$sql = "SELECT id FROM Answers WHERE id=" . $answer_id;
	$result = $conn->query($sql);
	if($result) {
		//create table if it doesn't exist
		$sql = "CREATE TABLE Votes
			(
			user_id int NOT NULL,
			answer_id int NOT NULL,
			value int NOT NULL
			);";
		$conn->query($sql);

		//check if user already voted on this answer
		$sql = "SELECT * FROM Votes WHERE user_id=" . $user_id . " AND answer_id=" . $answer_id;
		$result = $conn->query($sql);
		if(mysqli_num_rows($result) > 0) {
			if($row = mysqli_fetch_array($result)) {
				//if already has an upvote
				if($row["value"] == 1) {
					$sql = "UPDATE Votes SET value=0 WHERE user_id=" . $user_id . " AND answer_id=" . $answer_id;
					$conn->query($sql);
					$sql = "UPDATE Answers SET upvotes=upvotes-1 WHERE id=" . $answer_id;
					$conn->query($sql);
					//echo "Vote changed from upvoted";
				}
				//has no vote
				else if ($row["value"] == 0) {
					$sql = "UPDATE Votes SET value=1 WHERE user_id=" . $user_id . " AND answer_id=" . $answer_id;
					$conn->query($sql);
					$sql = "UPDATE Answers SET upvotes=upvotes+1 WHERE id=" . $answer_id;
					$conn->query($sql);
					//echo "Vote changed from nothing";
				}
				//has a downvote
				else {
					$sql = "UPDATE Votes SET value=1 WHERE user_id=" . $user_id . " AND answer_id=" . $answer_id;
					$conn->query($sql);
					$sql = "UPDATE Answers SET upvotes=upvotes+1, downvotes = downvotes-1 WHERE id=" . $answer_id;
					$conn->query($sql);
					//echo "Vote changed from downvote";
				}
				
			}
			mysqli_free_result($result);
		}
		//user didn't vote on this answer yet
		else {
			$sql = "INSERT INTO Votes(user_id, answer_id, value)
			VALUES (" . $user_id . ", " . $answer_id . ", 1);";
			$conn->query($sql);
			$sql = "UPDATE Answers SET upvotes=upvotes+1 WHERE id=" . $answer_id;
			$conn->query($sql);
			//echo "Added upvote";
		}
		
		//echo "ID: " . $user_id . " - Question: " . $answer_id;

	} else {
		echo "Error: answer doesn't exist";
	}

	$conn->close();

} else {
	echo "Not logged in";
}
?>