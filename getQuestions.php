<?php
    session_start();
    // session_destroy();
    include('db_Connection.php');
    
    // Check if the session is already started
    if(!isset($_SESSION['question'])) {
        $_SESSION['question'] = "";
    }

    $query="";
    if(!empty($_SESSION['question']))
    {
        $ids = $_SESSION['question'];
        $query="WHERE id NOT IN ($ids)";
    }
    // Get the question with the random ID
    $sql = "SELECT * FROM questions " .$query;
    
    $result = $conn->query($sql);
    $question = array();
    $quiz_array = array();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $question = $row;
        }
    }
    $_SESSION['correct_answer'] = $question['correct_answer'];
    $options = array();
    foreach($question as $q)
    {
        $options = array_merge(array($question["correct_answer"]), json_decode($question["incorrect_answers"]));
    }
    $_SESSION['question'].=empty($_SESSION['question'])?$question["id"]:",".$question["id"];
    function url(&$value, $key) 
    {
        $value = urldecode($value);
    }
    
    array_walk($options, 'url');
    $quiz_array["options"] = $options;
    $quiz_array["question"] = $question["question"];
    $quiz_array["difficulty"] = $question["difficulty"];
    // Output question as JSON
    echo json_encode($quiz_array);
    $conn->close();
    
?>