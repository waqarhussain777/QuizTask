<?php
    session_start();
    $_SESSION['user_name']=$_POST['name'];
    header('Location: quiz.php');
    exit();


?>