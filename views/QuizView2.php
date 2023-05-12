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
        /* background-color: #f5f5f5; */
        background-color:black;
        color:white;
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
    .selected {
    /* background-color: skyblue; */
    color:white;
    background-color:black;
    }
    .disabled {
    pointer-events: none;
    opacity: 0.5; 
    }

   .quit-quiz {
    position: absolute;
    top: 3rem;
    right: 13.5rem;
    background-color: #ff0000;
    color: white;
    font-size: 1rem;
    padding: 0.5rem 1.5rem;
    border: none;
    border-radius: 0.25rem;
    margin: 1rem 0 0;
    cursor: pointer;
  }

    .quit-quiz:hover {
        background-color:#cc0000;
    }

    #user-id{
        display:none;
    }
    #viewResultModal{
        /* background-color:seashell;*/
        background-color: #eff3fa;
    }
    .view-content{
        border: none !important;
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
    .green{
        background-color:green !important;
    }
    
    .red{
        background-color:red !important;
    }
    .blue{
        background-color:blue !important;
    }
    .modal-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    text-transform: capitalize;
    }

    .modal-title span {
    color: #007bff;
    }
    
</style>
</head>
<body>
<!-- --------------Main Quiz View starts here---------- -->

<button class="quit-quiz" id="quit-quiz">Quit Quiz</button>
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
      <div class="modal-header view-content">
        <h5 class="modal-title" id="vieResultModalLabel">User Result : <span class="font-weight-bold"><?php echo $name?></span></h5>
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

</body>

<script>
    var previewStatus=false;
    let totalQuestions=4;
    let timeValue =  10;
    let totalTimetaken;
    let count = 0;
    let uid;
    let timeValues=new Array(totalQuestions).fill(10);
    let userScore = 0;
    let counter;
    let timeLeft;
    let id=1;
    let selectedAnswers=new Array(totalQuestions).fill(0);
    console.log(selectedAnswers);
    let index=0;
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
        localStorage.setItem('data'+id,JSON.stringify(response));
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

    function initializeApp(){
    $('#prev').hide();
    $('#logout').hide();

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
        options=JSON.parse(data[index].options);
        $('#count').html(data[index].q_id);

        //var qid=data[index].q_id;

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


    //     for (let i = 0; i < options.length; i++) {
    //     $('#option-' + i).removeClass('selected');
    //     $('#option-' + i).off('click');
    //     $('#option-' + i).one('click', function() {
    //         const correctAns = data[index].correct_answer;
    //         const selectedOptionValue = $(this).text();
    //         $('.option').removeClass('selected');
    //         $(this).addClass('selected');
    //         optionSelected(selectedOptionValue, correctAns);
    //         console.log(previewStatus);
    //         if (previewStatus) {
    //         console.log(previewStatus);
    //             console.log("inside preview status");
    //             if (selectedOptionValue === correctAns) {
    //                 $(this).addClass('green');
    //             } else {
    //                 $(this).addClass('red');
    //             }
    //         }
    //     });
    // }

    // for (i = 0; i < options.length; i++) {
    //     $('#option-' + i).removeClass('selected');
    //     $('#option-' + i).one('click', function() {
    //         let correctAns = data[index].correct_answer;
    //         const selectedOptionValue = $(this).text();
    //         $('.option').removeClass('selected');
    //         $(this).addClass('selected');
    //         optionSelected(selectedOptionValue, correctAns);
    //     });
    //     } 

    // for (let i = 0; i < options.length; i++) {
    // $('#option-' + i).removeClass('selected');
    // const correctAns = data[index].correct_answer;
    // const selectedOptionValue = options[i];
    // if (selectedOptionValue === selectedAnswers[id - 1]) {
    //     // $('#option-' + i).addClass('selected');
    //     if (previewStatus) {
    //         if (selectedOptionValue === correctAns) {
    //             $('#option-' + i).addClass('green');
    //         } else {
    //             $('#option-' + i).addClass('red');
    //         }
    //     }
    // }
    // }

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

    //Option Selected Function

    function optionSelected(answer, corrAns) {
        console.log(answer, corrAns);
    if (answer) {
        selectedAnswers[id - 1] = answer;
        console.log(selectedAnswers);
        if (answer == corrAns) {
        userScore += 1;
        // $(this).addClass("green");
        }
        // if (answer === corrAns && previewStatus) {
        // console.log("inside check preview status and answer");
        // $(this).removeClass("selected");
        // $(this).addClass("green");
        // }
    }
    // localStorage.setItem("userscore",userScore);
    }


    function startTimer(time,id){
    timeLeft = time;
    $("#time").html(time);
    if (timeLeft === 0){
            $('.options').addClass('disabled');
            $("#time").html("Time Off");
        }
    
    counter=setInterval(timer,1000);
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

    next.addEventListener("click",function(){
        clearInterval(counter);
        timeStorage[id-1]=timeValue-timeLeft;
        timeValues[id-1]=timeLeft;
        console.log(timeStorage);
        id++;
        timeStorage[id-1]=timeValue-timeLeft;
        if(!previewStatus){
            startTimer(timeValues[id-1],id); 
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

    prev.addEventListener("click",function(){
    timeValues[id-1]=timeLeft;
    timeStorage[id-1]=timeValue-timeLeft;
    clearInterval(counter);    
    console.log(timeStorage);
    id--;
    timeStorage[id-1]=timeValue-timeLeft;
    if(!previewStatus){
    startTimer(timeValues[id-1],id); 
    }
    if (id === 1) {
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

    submit.addEventListener("click",function(){
        clearInterval(counter);
        console.log("submit button clicked");
        console.log(id);
        timeStorage[id-1]=timeValue-timeLeft;
        localStorage.setItem("timeValues", JSON.stringify(timeValues));
        localStorage.setItem("timeStorage",JSON.stringify(timeStorage));
        localStorage.setItem("selectedAnswers",JSON.stringify(selectedAnswers));
        $("#userscore").html(userScore);
        var userId = $("#user-id").text();
        console.log(userId);
        uid = parseInt(userId);
        totalTimetaken=timeStorage.reduce((accumulator, currentValue) => accumulator + currentValue);

       
        for (let i = 0; i < selectedAnswers.length; i++) {
        if (selectedAnswers[i] !== 0) {
            count++;
        }
        }

        const data={
            user_id:uid,
            totalQuestions:totalQuestions,
            attempted_questions:count,
            correct_questions:userScore,
            total_time_taken:totalTimetaken,
        };

        localStorage.setItem("resultData",JSON.stringify(data));

        //console.log(data);

        $.ajax({
        url:'<?php echo base_url().'index.php/Quiz/resultController'?>',
        type:'post',
        data:data,
        dataType:'json',
        success:function(response){
        console.log(response);
        },

        error:function(){
        console.log("error");
        },

        complete:function(){
        console.log("request completed");
        }
    }); 

    $("#submitModal").show();

    });

    function showPreview(){
        $('#submitModal').hide();
        $('.modal-backdrop').removeClass('modal-backdrop');
        console.log("preview clicked");
        previewStatus=true;
        $('#quit-quiz').hide();
        $('#logout').show();
        // clearInterval(counter);
        $('#time').addClass('disabled');
        $('.options').addClass('disabled');
        $('#submit').hide();
        showQuestions(id);
    }

    function viewResult(){
        console.log("timeStorage:",timeStorage);
        console.log("timeValues:",timeValues);
        console.log("selectedAnswers:",selectedAnswers);
        console.log("viewresult clicked");
        $("#submitModal").hide();
        $("#viewResultModal").show();
        $('#viewResultModal').removeClass('fade');
        const resultData=JSON.parse(localStorage.getItem("resultData"));
        // console.log(resultData);
        $('#userid').html(resultData.user_id);
        $('#total-questions').html(resultData.totalQuestions);
        $('#attempted-questions').html(resultData.attempted_questions);
        $('#correct-questions').html(resultData.correct_questions);
        $('#total-timetaken').html(resultData.total_time_taken);
    }

    initializeApp();
    
</script>
</html>