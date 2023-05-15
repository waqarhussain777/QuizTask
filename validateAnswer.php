<?php
session_start();
if(!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
$selectedOption = $_POST['selectedOption'];
$correctOption = $_SESSION['correct_answer'];
$_SESSION['score']=$selectedOption === $correctOption?$_SESSION['score']+1:$_SESSION['score'];
$isCorrect = $selectedOption === $correctOption;

echo json_encode(['isCorrect' => $isCorrect,'correct_answer' => $correctOption]);
?>
