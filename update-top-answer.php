<?php

function updateTopAnswer($conn, $qid) {

	$sql = "SELECT * FROM Answers WHERE question_id=" . $qid;
    $response = $conn->query($sql);
    if($response) {
      if(mysqli_num_rows($response) > 0) {
        $most_points = 0;
        $top_answer_id = NULL;
        while($row = mysqli_fetch_array($response)) {
          $points = $row["upvotes"] - $row["downvotes"];
          if($points >= $most_points) {
            $top_answer_id = $row["id"];
            $most_points = $points;
          }
        }
        $sql = "UPDATE Questions SET top_answer_id=" . $top_answer_id . " WHERE id=" . $qid;
        $conn->query($sql);
      }
      mysqli_free_result($response);
  }
}

?>