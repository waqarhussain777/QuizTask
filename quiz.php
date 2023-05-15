
<?php 
session_start();
    if(!isset($_SESSION['user_name']))
    {
        header('Location: index.php');
    }
?>
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
    width: 48%;
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

.star {
    color: grey;
    font-size: 25px;
}

.star.active {
    color: red; /* Change this to the color you want for active stars */
}




    </style>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <!-- <script src="quiz.js"></script> -->
</head>
<body>
    <div id="quizContainer">
        <div id="progressBarContainer">
            <div id="progressBar"></div>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 id="goingon">Question 1 of 5</h1>
            <h3 id="timer">5:00</h3>
        </div>
        <div id="star-container">
            <span class="star" id="star1">★</span>
            <span class="star" id="star2">★</span>
            <span class="star" id="star3">★</span>
        </div>

        <h2 id="question"></h2>
        <form id="quizForm" action="validateAnswer.php" method="post">
            <div class="options-container" id="options-container">
            </div>
                <h2 id="correct_label" style="color:#28a745;text-align: center;">   
                </h2>
                <h2 id="sorry_label" style="color:red;text-align: center;">
                </h2>
            <button id="nextQuestionBtn" class="btn btn-dark" type="submit">Next Question</button>
        </form>
        <h3 style id="score-text"></h3>
        <div class="score-container">
            <div id="score-bar" class="score-bar"></div>
        </div>


    </div>
    <script>
let timeRemaining = 300;  // 5 minutes in seconds
// Update the timer every second
setInterval(function() {
    timeRemaining--;
    let minutes = Math.floor(timeRemaining / 60);
    let seconds = timeRemaining % 60;
    document.getElementById("timer").innerHTML = "<i id='timer-icon' class='far fa-clock'></i> " + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
}, 1000);

function changeColor(optionDivId) {
    // Reset background color for all options
    let options = document.getElementsByClassName('option');
    for(let i = 0; i < options.length; i++) {
        options[i].style.backgroundColor = 'white';
        options[i].getElementsByTagName('label')[0].style.color = 'black';
    }

    // Change background color for the selected option
    let optionDiv = document.getElementById(optionDivId);
    optionDiv.style.backgroundColor = '#28a745';

    // Change text color for the selected option
    let optionLabel = optionDiv.getElementsByTagName('label')[0];
    optionLabel.style.color = '#ffffff';
}

let currentScore = 0;
const maxScore = 5;  // Maximum achievable score.

function updateScoreBar() {
  let scoreBar = document.getElementById('score-bar');
  let percentage = (currentScore / (currentQuestionIndex-1)) * 100;
  scoreBar.style.width = percentage + '%';

  let scoreText = document.getElementById('score-text');
  scoreText.textContent = `Score: ${Math.round(percentage)}%`;
}

function updateScore(isCorrect) {
  if (isCorrect) {
    currentScore++;
  }
  updateScoreBar();
}

let currentQuestionIndex = 1;
let questions = [];
let currentCorrectAnswer;

document.addEventListener('DOMContentLoaded', function() {
    loadQuestion(currentQuestionIndex);
    let quizTimeInMinutes = 5;
let quizTimeInMilliseconds = quizTimeInMinutes * 60 * 1000;

setTimeout(finished_quiz, quizTimeInMilliseconds);
});

function loadQuestion(questionIndex) {
    let progressBar = document.getElementById("progressBar");
    let progressPercentage = (questionIndex / 5) * 100;
    progressBar.style.width = progressPercentage + "%";
    fetch('getQuestions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `index=${questionIndex}`
    })
    .then(response => response.json())
    .then(data => {
        counter=1;
        html='';
        data.options.forEach((opt)=>
        {
            html+=`
            <div class="option" id="option${counter}Div">
                <input type="radio" id="option${counter}" name="answer" value="${decodeURI(opt)}">
                <label for="option${counter}">
                    <span id="label${counter}">${decodeURI(opt)}</span>
                </label>
            </div>`;
            
            counter++;
        });
        document.getElementById('question').textContent = data.question;
        let optionsContainer = document.getElementById('options-container');
        currentCorrectAnswer = data.correct_answer;
        optionsContainer.innerHTML = html;
        displayStars(data.difficulty);

        // Add click listeners to newly created radio buttons
        for (let i = 1; i < counter; i++) {
            document.getElementById(`option${i}`).addEventListener('click', function() {
                changeColor(`option${i}Div`);
            });
        }
        

    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('nextQuestionBtn').addEventListener('click', function(event) {
    // Assuming you want to validate the answer before going to the next question
    event.preventDefault();
    if (validate()) {
        currentQuestionIndex++;
        setTimeout(function() {
            document.getElementById('correct_label').textContent = "";
            document.getElementById('sorry_label').textContent = "";
            if (currentQuestionIndex < 6) {
                loadQuestion(currentQuestionIndex);
                document.getElementById('goingon').innerText=`Question ${currentQuestionIndex} of 5`;
            } else {
                // Quiz is finished, display results or whatever you want to do
                finished_quiz();
            }
        }, 1000);
    }
});
function finished_quiz()
{
    fetch('finishQuiz.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: ``
        })
        .then(response => response.json())
        .then(data => {
            finish = `<div style="text-align: center;">
                        <h1>Name: <span style="color:green;">${data.name}<span></h1>
                        <h1>Total Score: <span style="color:green;">${data.score}<span></h1>
            <div>`;
            document.getElementById('quizContainer').innerHTML=finish;
        })
        .catch(error => console.error('Error:', error));
}
function displayStars(difficulty) {
    // Reset all stars to inactive
    document.querySelectorAll('.star').forEach(star => {
        star.classList.remove('active');
    });

    // Set the appropriate number of stars to active
    if(difficulty === 'easy') {
        document.getElementById('star1').classList.add('active');
    } else if(difficulty === 'medium') {
        document.getElementById('star1').classList.add('active');
        document.getElementById('star2').classList.add('active');
    } else if(difficulty === 'hard') {
        document.getElementById('star1').classList.add('active');
        document.getElementById('star2').classList.add('active');
        document.getElementById('star3').classList.add('active');
    }
}

function validate() {
    let options = document.getElementsByName('answer');
    let selectedOption;
    let hasSelected = false;

    for(let i=0; i<options.length; i++){
        if(options[i].checked){
            selectedOption = options[i];
            hasSelected = true;
            break;
        }
    }
    if (!hasSelected) {
        alert("Please select an answer before proceeding");
        return false;
    } else {
        // document.getElementById('nextQuestionBtn').disabled = true;
        // Send the selected option to the server for validation
        fetch('validateAnswer.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `selectedOption=${selectedOption.value}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.isCorrect) {
                // selectedOption.parentElement.classList.add('correct'); // Add the correct class
                document.getElementById('correct_label').textContent = "Correct!";
                updateScore(true);
            } else {
                updateScore(false);
                selectedOption.parentElement.style.backgroundColor = "red"; 
                selectedOption.parentElement.style.color = "white"; 
                for(let i=0; i<options.length; i++)
                {
                    if(options[i].value==data.correct_answer)
                    {
                        selectedOption = options[i];
                        selectedOption.parentElement.style.backgroundColor = "#28a745"; 
                        selectedOption.parentElement.getElementsByTagName('label')[0].style.color = "white";
                        document.getElementById('sorry_label').textContent = "Sorry!";
                        break;
                    }
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
    return true;
}




    </script>
</body>
</html>
