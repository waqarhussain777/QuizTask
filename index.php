<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    padding: 20px;
}

#quizContainer {
    width: 600px;
    margin: auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

h1 {
    color: #333333;
}

h2 {
    /* text-align: right; */
}

.options-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.option {
    width: 100%;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    box-sizing: border-box;
    cursor: pointer;
}

button {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    background-color: #343a40;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
/* existing CSS above... */

.option input[type="radio"] {
    display: none;
}

/* existing CSS above... */

.option label {
    display: block;
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
}
#progressBarContainer {
    width: 100%;
    height: 10px;
    background-color: #f0f0f0;
    border-radius: 7px;
}

#progressBar {
    height: 100%;
    width: 0;
    background-color: #28a745;
    border-radius: 10px;
}
.correct {
    background-color: green;
}

.incorrect {
    background-color: red;
    color: white;
}

.score-container {
  width: 100%;
  height: 15px;
  background-color: #f3f3f3;
  border-radius: 15px;
  overflow: hidden;
}

.score-bar {
  height: 100%;
  width: 0;
  background-color: #f39f05;
  transition: width 0.3s ease-in-out;
}





    </style>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <!-- <script src="quiz.js"></script> -->
</head>
<body>
    <div id="quizContainer">
    
        <h2 id="question"></h2>
        <!-- <div class="options-container" id="options-container"> -->
            <form id="quizForm" action="start.php" method="post">
                <h1>Enter Name</h1>
                <input type="text" name="name" required class="option" placeholder="Name">
                <button id="nextQuestionBtn" class="btn btn-dark" type="submit">Submit</button>
            </form>
        <!-- </div> -->
    </div>

    </script>
</body>
</html>
