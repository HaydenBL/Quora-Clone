<?php

require_once('super-connect.php');

$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'mydatabase';";
$result = $conn -> query($sql);

if($result->num_rows > 0)
{
    $sql = 'drop database mydatabase;';
    $conn -> query($sql);
}
  $sql = "Create database mydatabase;";
  $conn->query($sql);
  $sql = "use mydatabase;";
  $conn->query($sql);
  $sql = "CREATE TABLE Users
  (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    birthday varchar(255) NOT NULL,
    PRIMARY KEY(id)
  );";
  $conn->query($sql);

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


  $sql = "CREATE TABLE Questions
          (
          id int NOT NULL AUTO_INCREMENT,
          user_id int NOT NULL,
          question_text varchar(500) NOT NULL,
          num_answers int NOT NULL,
          time_asked timestamp NOT NULL,
          top_answer_id int,
          category varchar(100) NOT NULL,
          PRIMARY KEY(id)
          );";

  $conn->query($sql);

  $sql = "CREATE TABLE Categories
          (
            name varchar(25) PRIMARY KEY NOT NULL
          );";

  $conn->query($sql);


  $temp = array("Game","Gym/Yoga","Health","History","India","Inspiration","Investment","Life","Place","Politics","Religious","Research","Science","Spiritual","Sports","Studies","Technology","Travel","World","others");
  for($i=0;$i<count($temp);$i++)
  {
    $sql = "Insert into Categories(name) values(\"".$temp[$i]."\");";
    $conn->query($sql);
  }


?>
