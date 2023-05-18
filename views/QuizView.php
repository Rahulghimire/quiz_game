<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <?php include('header.php'); ?>
</head>
<body>
<!-- --------------Main Quiz View starts here---------- -->

<button class="quit-quiz" id="quit-quiz" onclick="quitQuiz();"><a class="text-decoration-none text-white" href="<?php base_url()?>logout">Quit Quiz</a></button>
<button class="quit-quiz" id="logout" onclick="localStorage.clear();"><a class="text-decoration-none text-white" href="<?php base_url()?>logout">Logout</a></button>
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
        <button type="button" class="btn btn-dark" id="submit" data-toggle="modal" data-target="#submitModal">Submit</button>
        </div>
    </div>
<button type="button" class="btn btn-primary view-result" id="view-result" onclick="viewResult()">View Result</button>
    
<!-- --------------Main Quiz View ends here---------- -->

<!-- -------------Submit Modal starts here--------- -->
<div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quiz Completed!!</h5>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
        <?php  $user=$this->session->userdata('auth_user');
        $name=$user['name'];
        $id=$user['id'];
        ?>
        <span><?php echo $name?><span id="user-id"><?php echo $id?></span> has scored:<span id="userscore"></span></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="showPreview()">Go to Preview</button>
        <button type="button" class="btn btn-primary" id="view-result" onclick="viewResult()">View Result</button>
      </div>
    </div>
  </div>
</div>
<!-- -------------Submit Modal ends here--------- -->

<!-- ------------View Result Modal starts here---------- -->
<div class="modal fade" id="viewResultModal" tabindex="-1" role="dialog" aria-labelledby="viewResultModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content view-content">
      <div class="modal-header view-content justify-content-start align-items-center">
        <img src="<?php echo base_url().'assets/user.png'?>" alt="avatar" width="20" height="20"><h5 class="modal-title px-1" id="vieResultModalLabel">User Result : <span class="font-weight-bold text-danger"><?php echo $name?></span></h5>
      </div>
      <div class="modal-body">
<div class="table-responsive-sm table-responsive-md">
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Total Questions</th>
      <th scope="col">Attempted Questions</th>
      <th scope="col">Correct Questions</th>
      <th scope="col">Total Time Taken</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row" id="userid"></th>
      <td id="total-questions"></td>
      <td id="attempted-questions"></td>
      <td id="correct-questions"></td>
      <td><span id="total-timetaken"></span>secs</td>
    </tr>
  </tbody>
</table>
</div>
      </div>
      <div class="modal-footer view-content">
      <button type="button" class="btn btn-danger px-4" onclick="localStorage.clear();"><a class="text-decoration-none text-white" href="<?php base_url()?>logout">Logout</a></button>
      </div>
    </div>
  </div>
</div>
<!-- ------------View Result Modal ends here---------- -->

<script>
    var previewStatus=false;
    let counter;
    let timeLeft;
    let totalTimetaken;
    let uid;
    var dateTimeString;
    let totalQuestions=10;
    let timeValue =  15;
    let count = 0;
    let index=0;
    let timeValues=new Array(totalQuestions).fill(15);
    let userScore = 0;
    let id=1;
    let selectedAnswers=new Array(totalQuestions).fill(0);
    let correctAnswers=new Array(totalQuestions).fill(0);
    let questions=new Array(totalQuestions).fill(0);
    console.log(selectedAnswers);
    var timeStorage=new Array(totalQuestions).fill(0);

    const next=document.querySelector("#next");
    const prev=document.querySelector("#prev");
    const submit=document.querySelector("#submit");

    function getData(id){
        var data = localStorage.getItem('data'+id);
    if(data){
            showQuestions(id);
    }
    else{
        $.ajax({
        url:'<?php echo base_url().'index.php/Quiz/getData/'?>'+id,
        type:'post',
        data:{},
        dataType:'json',
        success:function(response){
        console.log(response);
        if(response){
        localStorage.setItem('data'+id,JSON.stringify(response));
        }
        showQuestions(id);
        },

        error:function(){
        console.log("error");
        },

        complete:function(){
        console.log("request completed");
        }
    });
    }   
    }

    function generateBeginDateTime(){
    var now=new Date();
    console.log(now);
    var year = now.getFullYear();
    var month = now.getMonth() + 1; 
    var day = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    dateTimeString = year + '-' + padNumber(month) + '-' + padNumber(day) + ' ' + padNumber(hour) + ':' + padNumber(minute) + ':' + padNumber(second);
    function padNumber(num) {
    return (num < 10 ? '0' : '') + num;
    }
    }

    function initializeApp(){
    $('#view-result').hide();
    $('#prev').hide();
    $('#logout').hide();
    generateBeginDateTime();
    var data = localStorage.getItem('data' + id);
    if(data) {
        showQuestions(1);
    } else {
        getData(id);
    }
    if(!previewStatus){
    startTimer(timeValues[0],id); 
    }
    $('#submit').hide();
    $('#totalQuestions').html(totalQuestions);
    }

    function showQuestions(id){
        const data=JSON.parse(localStorage.getItem('data'+id));
        console.log(data);
        options=JSON.parse(data[index].options);
        questions[id-1]=data[index].question_text;
        correctAnswers[id-1]=data[index].correct_answer;
        console.log("correct answer",correctAnswers);
        console.log("question",questions);
        $('#count').html(data[index].q_id);
        $('#que-text').html(data[index].question_text);

        for(i=0;i<options.length;i++){
        $('#option-'+i).html(options[i]);
        }

    //Adds class to the selected option

    if(selectedAnswers[id - 1]) {
    const selectedOption = options.indexOf(selectedAnswers[id - 1]);
    $('.option').removeClass('selected green red blue');
    $('#option-' + selectedOption).addClass('selected');
    if (previewStatus) {
        const correctAns = data[index].correct_answer;
        if (selectedAnswers[id - 1] === correctAns) {
            $('#option-' + selectedOption).addClass('green');
        } else {
            $('#option-' + selectedOption).addClass('red');
            const correctOption = options.indexOf(correctAns);
            $('#option-' + correctOption).addClass('green');
        }
    }
  }
  else if (previewStatus) {
    const selectedOption = options.indexOf(selectedAnswers[id - 1]);
    $('.option').removeClass('selected green red blue');
    $('#option-' + selectedOption).addClass('selected');
    const correctAns = data[index].correct_answer;
    const correctOption = options.indexOf(correctAns);
    $('#option-' + correctOption).addClass('blue');
    }

    for (i = 0; i < options.length; i++) {
        $('#option-' + i).removeClass('selected');
        $('#option-' + i).one('click', function() {
            let correctAns = data[index].correct_answer;
            const selectedOptionValue = $(this).text();
            $('.option').removeClass('selected');
            $(this).addClass('selected');
            optionSelected(selectedOptionValue, correctAns);
        });
        }  
    }

    //Option Selected Function starts here-------------------

    function optionSelected(answer, corrAns) {
        console.log(answer, corrAns);
    if (answer) {
        selectedAnswers[id - 1] = answer;
        console.log(selectedAnswers);
        if (answer == corrAns) {
        userScore += 1;
        }
    }
    }

    // Timer function starts here----------------
    function startTimer(time,id){
    timeLeft = time;
    $("#time").html(time);
    if (timeLeft === 0){
            $('.options').addClass('disabled');
            $("#time").html("Time Off");
        }
    counter=setInterval(timer,900);
    function timer(){
        if (timeLeft === 0){
            $('.options').addClass('disabled');
            $("#time").html("Time Off");
        }
        else if(timeLeft > 0){
            $('.options').removeClass('disabled');
            $("#time").html(timeLeft);
            timeLeft--;
        }
        else{
            clearInterval(counter);
            $("#time").html("Time Off");
            // $("#time").css('color','red');
            timeStorage[id-1]=timeValue-timeLeft;
            timeValues[id-1]=timeLeft;
            console.log("timeValues",timeValues);
            // $('.options').addClass('disabled');
        }
    }
}
    // Timer function ends here----------------

    // Next function starts here----------------
    next.addEventListener("click",function(){
        clearInterval(counter);
        timeStorage[id-1]=timeValue-timeLeft;
        timeValues[id-1]=timeLeft;
        console.log(timeStorage);
        id++;
        timeStorage[id-1]=timeValue-timeLeft;
        if(!previewStatus){
            startTimer(timeValues[id-1],id); 
        }else{
        $('#time').html("Time Off");
        clearInterval(counter);
       }
       if(id === totalQuestions){
        $('#next').hide();
        $('#submit').show();
        if(previewStatus){
        $('#submit').hide();
        }
        } 
     else {
        $('#submit').hide();
        $('#next').show();
    }
        $('#prev').show();
        getData(id); 

    if(selectedAnswers[id-1]) {
            console.log(selectedAnswers[id-1]);
            const selectedOption = options.indexOf(selectedAnswers[id-1]);
            console.log("selected option::",selectedOption);
            $('#option-'+selectedOption).addClass('selected');
    }
    });
    // Next function ends here---------------------

    // Previous function starts here----------------
    prev.addEventListener("click",function(){
    timeValues[id-1]=timeLeft;
    timeStorage[id-1]=timeValue-timeLeft;
    clearInterval(counter);    
    console.log(timeStorage);
    id--;
    timeStorage[id-1]=timeValue-timeLeft;
    if(!previewStatus){
    startTimer(timeValues[id-1],id); 
    }else{
        $('#time').html("Time Off");
    }
    if(id === 1) {
    $('#prev').hide();
    } else {
        $('#prev').show();
    }
    $('#next').show();
    $('#submit').hide();
    getData(id);

    if(selectedAnswers[id-1]) {
            console.log(selectedAnswers[id-1]);
            const selectedOption = options.indexOf(selectedAnswers[id-1]);
            console.log("selected option::",selectedOption);
            $('#option-'+selectedOption).addClass('selected');
    }
    });

    // Previous function ends here----------------

    //Send data to server function starts here

    function sendDataToServer() {
    const totalTimetaken = timeStorage.reduce((accumulator, currentValue) => accumulator + currentValue);

    for (let i = 0; i < selectedAnswers.length; i++) {
        if (selectedAnswers[i] !== 0) {
        count++;
        }
    }

    const userId = parseInt($("#user-id").text());

    const data = {
        user_id: userId,
        totalQuestions: totalQuestions,
        attempted_questions: count,
        correct_questions: userScore,
        total_time_taken: totalTimetaken,
        begin_date_time: dateTimeString,
        options_selected: selectedAnswers,
        question_text: questions,
        correct_ans: correctAnswers,
        time_storage: timeStorage
        };
        console.log(data);

        localStorage.setItem("resultData",JSON.stringify(data));

        $.ajax({
            url: '<?php echo base_url().'index.php/Quiz/resultController'?>',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(response) {
            console.log(response);
            },
            error: function() {
            console.log("error");
            },
            complete: function() {
            console.log("request completed");
            }
        });
        }

    function quitQuiz() {
    console.log("quit quiz clicked");
    $("#quit-quiz").prop("disabled", true); 
    sendDataToServer();
    localStorage.clear();
    }
    
    //Send data to server function ends here


    // Submit function starts here----------------

    submit.addEventListener("click",function(){
        clearInterval(counter);
        console.log("submit button clicked");
        console.log(id);
        timeStorage[id-1]=timeValue-timeLeft;
        $("#userscore").html(userScore);
        var userId = $("#user-id").text();
        console.log(userId);
        uid = parseInt(userId);
        sendDataToServer();
        $("#submitModal").show();
    });


    // Preview function starts here----------------

    function showPreview(){
        $('#submitModal').hide();
        $('.modal-backdrop').removeClass('modal-backdrop');
        console.log("preview clicked");
        previewStatus=true;
        $('#quit-quiz').hide();
        $('#logout').show();
        // clearInterval(counter);
        // $('#time').addClass('disabled');
        $('.options').addClass('disabled');
        $('#submit').hide();
        $('#view-result').show();
        showQuestions(id);
        // startTimer(timeValues[id-1],id);
    }

    // ViewResult function starts here----------------

    function viewResult(){
        console.log("timeStorage:",timeStorage);
        console.log("timeValues:",timeValues);
        console.log("selectedAnswers:",selectedAnswers);
        console.log("viewresult clicked");
        $("#submitModal").hide();
        $("#viewResultModal").show();
        $('#viewResultModal').removeClass('fade');
        const resultData=JSON.parse(localStorage.getItem("resultData"));
        if(resultData){
        $('#userid').html(resultData.user_id);
        $('#total-questions').html(resultData.totalQuestions);
        $('#attempted-questions').html(resultData.attempted_questions);
        $('#correct-questions').html(resultData.correct_questions);
        $('#total-timetaken').html(resultData.total_time_taken);
        }  
    }

    //Quiz App is initialized here----------------
    initializeApp();
</script>
</body>
</html>