<?php
session_start();
$score=$_SESSION["score"];
$name=$_SESSION["user_name"];
session_destroy();
include('db_Connection.php');

$sql = "INSERT INTO quizscores (`name`,score) VALUES ('".$name."','".$score."')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['name'=>$name,'score'=>$score]);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>