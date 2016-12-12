<?php

$qid = $_GET["id"];

$highestSet = isset($_GET["highest"]);
if($highestSet)
	$highest = $_GET["highest"];


session_start();
$loggedin = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;

require_once('../../mysqli-connect.php');

if($highestSet) {
	$sql = "SELECT * FROM Answers WHERE question_id =" . $qid . " AND id>" . $highest . " ORDER BY id DESC";
} else {
	$sql = "SELECT * FROM Answers WHERE question_id =" . $qid . " ORDER BY id DESC";
}
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

            <img src="upvote-grey.png" alt=<?php if($loggedin){echo "\"" . $row["id"] . "\"";} ?> class="upvote-arrow
            <?php
                if($result) {

                    $vote = mysqli_fetch_array($result);
                    if($vote["value"] == 1) { echo "upvote-highlight"; }
                    else { echo "upvote-unhighlight"; }

                } else { echo "upvote-unhighlight"; }

            ?>" /> 
            <label class="upvote-count"><?php echo $row["upvotes"]; ?> Upvotes</label>
            <br />

            <img src="downvote-grey.png" alt=<?php if($loggedin){echo "\"" . $row["id"] . "\"";} ?> class="downvote-arrow 
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
    	if(!$highestSet) {

?>
    <div class="qd-answer post-display no-answers">There are no answers yet.<br />Be the first!</div>

<?php
		}
    } //end else(no answers)


    mysqli_free_result($response);
    } //end if(response)
