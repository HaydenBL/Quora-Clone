<?php

$qid = $_GET["id"];

require_once('../../mysqli-connect.php');

$sql = "SELECT * FROM Questions WHERE id =" . $qid;
$response = $conn->query($sql);

if($response) {
	while($row = mysqli_fetch_array($response)) {
		echo $row["num_answers"] . " answers";
	}
} else {
	echo "Error";
}

?>