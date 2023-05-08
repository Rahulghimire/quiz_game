<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css'?>">
    <script type="text/javascript" src="<?php echo base_url().'assets/jquery-3.6.4.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
    }

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f5f5f5;
    }

    .trivia {
        width: 850px;
        max-width: 90%;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .question-number {
        font-weight: bold;
        color: #3f51b5;
    }

    .timer {
        display: flex;
        align-items: center;
        opacity:0.8;
    }

    .timer img {
        margin-right: 5px;
    }

    .question {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
        margin-bottom: 20px;
    }

    .option {
        font-size: 18px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .option:hover {
        background-color: #f5f5f5;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
    }

    .btn {
        font-size: 18px;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .btn:hover {
        background-color: #3f51b5;
        color: white;
    }

    .btn-info {
        background-color: #2196f3;
        color: white;
    }

    .btn-success {
        background-color: #4caf50;
        color: white;
    }

    .btn-dark {
        background-color: #212121;
        color: white;
    }

    @media screen and (max-width: 900px) {
        .trivia {
            max-width: 600px;
            padding: 15px;
        }

        .question {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .options {
            grid-template-columns: repeat(1, 1fr);
            grid-gap: 15px;
            margin-bottom: 15px;
        }

        .option {
            font-size: 16px;
            padding: 8px;
        }

        .btn {
            font-size: 16px;
            padding: 8px 16px;
        }
    }
</style>


</head>

<body>
    <div class="trivia">
    <div class="form-header">
    <div class="question-number my-1"><span class="text-dark">Question.</span><span id="count" class="fw-bolder text-success"> 1</span><span> of </span><span id="totalQuestions"></span></div>
    <div class="timer d-flex align-items-center"><img src="<?php echo base_url()?>assets/clock.png" alt="time-image" width="18" height="16"><span id="time" class="px-1 fw-bold">15</span></div>
    </div>
        <div class="question text-center" id="que-text">Demo Question</div>
        <div class="options">
        <div class="option" id="option-0">option 0</div>
        <div  class="option" id="option-1">option 1</div>
        <div  class="option" id="option-2">option 2</div>
        <div  class="option" id="option-3">option 3</div>
        </div>
        <div class="button-group">
        <button type="button" class="btn btn-info" id="prev">Previous</button>
        <button type="button" class="btn btn-success" id="next">Next</button>
        <button type="button" class="btn btn-dark" id="submit">Submit</button>
        </div>
    </div>
</body>

<script>

    let totalQuestions = 4;
    let timeValues = [15, 15, 15, 15]; // array of time values for each question
    let que_count = 0;
    let que_numb = 1;
    let userScore = 0;
    let counter;
    let id = 1;
    let selectedAnswer = [];
    let index = 0;
    let timeStorage = [];
    let timers = [];    


    
    
    function getData(id){
        $.ajax({
        url:'<?php echo base_url().'index.php/Quiz/getData/'?>'+id,
        type:'post',
        data:{},
        dataType:'json',
        success:function(response){
        console.log(response);
        localStorage.setItem('data'+id,JSON.stringify(response));
        //id_Array[id-1]=response[0].q_id;
        },

        error:function(){
        console.log("error");
        },

        complete:function(){
        console.log("request completed");
        }
    });
    }

function initializeApp() {
  $('#prev').hide();
  getData(id);
  showQuestions(1);
  startTimer(timeValues[0], 0);
  $('#submit').hide();
  $('#totalQuestions').html(totalQuestions);
}

    function showQuestions(id){

        const data=JSON.parse(localStorage.getItem('data'+id));
        options=JSON.parse(data[index].options);
        $('count').html(data[index].q_id);
        $('#que-text').html(data[index].question_text);

        for(i=0;i<options.length;i++){
        $('#option-'+i).html(options[i]);
        }


        for (i = 0; i < options.length; i++) {
        $('#option-' + i).click(function() {
        let correctAns=data[index].correct_answer;
        const selectedOptionValue = $(this).text();
        optionSelected(selectedOptionValue,correctAns);
        //$('.option').not(this).prop('disabled', true);

        });
       }  
    }

    function optionSelected(answer,corrAns){
        console.log(answer);
        console.log(corrAns);
        if(answer){
            if (timeLeft === 0) {
      $('.option').prop('disabled', true);
    }

        }
    }


    function startTimer(time, questionIndex) {
  $("#time").html(time);
  timeLeft = time;
  timers[questionIndex] = setInterval(function() {
    if (timeLeft > 0) {
      timeLeft--;
      $("#time").html(timeLeft);
    } else {
      $("#time").html("Time Off");
      clearInterval(timers[questionIndex]);
      timeStorage[questionIndex] = timeLeft;
      $('.option').prop('disabled', true);
    }
  }, 1000);
}


    const next=document.querySelector("#next");
    const prev=document.querySelector("#prev");

    $('#next').click(function() {
  clearInterval(timers[index]);
  id++;
  if (id === totalQuestions) {
    $('#next').hide();
    $('#submit').show();
  } else {
    $('#submit').hide();
    $('#next').show();
  }
  index++;
  startTimer(timeValues[index], index);
  $('#prev').show();
  getData(id);
  const data = JSON.parse(localStorage.getItem('data' + id));
  options = JSON.parse(data[index].options);
  $('#count').html(data[index].q_id);
  $('#que-text').html(data[index].question_text);

  for (i = 0; i < options.length; i++) {
    $('#option-' + i).html(options[i]);
  }

  for (i = 0; i < options.length; i++) {
    $('#option-' + i).click(function() {
      let correctAns = data[index].correct_answer;
      const selectedOptionValue = $(this).text();
      optionSelected(selectedOptionValue, correctAns);
      //$('.option').not(this).prop('disabled', true);
    });
  }
    });


    prev.addEventListener("click", function() {     
        clearInterval(timers[index]);
  id--;
  if (id === 1) {
    $('#prev').hide();
  } else {
    $('#prev').show();
  }
  $('#next').show();
  $('#submit').hide();
  index--;
  // Get the remaining time of the current timer
  const remainingTime = $("#time").html();
  // Show the previous question and its options
  const data = JSON.parse(localStorage.getItem('data' + id));
  options = JSON.parse(data[index].options);
  $('#count').html(data[index].q_id);
  $('#que-text').html(data[index].question_text);
  for (i = 0; i < options.length; i++) {
    $('#option-' + i).html(options[i]);
  }
  // Disable all options if time is 0
  if (remainingTime === "Time Off") {
    $('.option').prop('disabled', true);
  } else {
    // Resume the timer from the remaining time
    startTimer(parseInt(remainingTime), index);
  }

    // Add event listeners to options
    for (i = 0; i < options.length; i++) {
        $('#option-' + i).click(function() {
            let correctAns = data[index].correct_answer;
            const selectedOptionValue = $(this).text();
            optionSelected(selectedOptionValue, correctAns);
        });
    }
});


    initializeApp();


</script>


</html>