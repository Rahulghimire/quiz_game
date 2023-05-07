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

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family: 'Roboto', sans-serif;
    }

    body{
        display:flex;
        align-items:center;
        justify-content:center;
        height:100vh;
        background-image:url('http://localhost/quiz_game/assets/bg-gradient.avif');
        background-position: center; 
        background-repeat: no-repeat; 
        background-size: cover;
        animation: bg-animation 8s infinite;
        animation-timing-function:ease-in-out;
        animation-direction: alternate;
    }

    .trivia {
        max-width: 850px;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .question {
        min-width: 800px;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 30px;
    }

    .options{
        min-height:225px;
        min-width:300px;
    }

    .option {
        font-size: 16px;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        width: 90%;
        cursor:pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .button-group{
        display:flex;
        justify-content:space-between;
    }

    .form-header{
        display:flex;
        justify-content:space-between;
        margin-bottom:10px;
    }

    .btn {
    font-size: 18px;
    font-weight: 500;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    }

    .btn:hover {
    opacity: 0.9;
    }

    .btn-info {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
    }

    .btn-info:hover {
    background-color: #0069d9;
    border-color: #0062cc;
    }

    .btn-success {
    background-color: #28a745;
    border-color: #28a745;
    color: #fff;
    }
    
    .btn-dark {
    background-color: #343a40;
    border-color: #343a40;
    color: #fff;
    }

    .btn-dark:hover {
    background-color: #23272b;
    border-color: #1d2124;
    }

    .option:hover {
    background-color: #e6f7ff;
    }

    .timer {
    display: flex;
    align-items: center;
    font-size: 18px;
    font-weight: 500;
    }

    .timer img {
    margin-right: 5px;
    opacity: 0.8;
    }

    @media screen and (max-width:900px){
        .trivia {
            min-height:300px;
            min-width:300px;
            max-width:600px;
            padding:15px;
        }

        .question {
            font-size: 16px;
            margin-bottom: 20px;
            min-width: 300px;
        }

        .options{
            min-height:150px;
            min-width:200px;
        }

        .option {
            font-size: 14px;
            margin-bottom: 5px;
            padding: 8px;
            width: 80%;
        }
    }

    @keyframes bg-animation {
        0% {
            background-image: url('http://localhost/quiz_game/assets/bg-gradient.avif');
        }
        50% {
            background-image: url('http://localhost/quiz_game/assets/bg-3.avif');
        }
        100% {
            background-image: url('http://localhost/quiz_game/assets/digi.avif');
        }
    }
</style>
</head>

<body>
    <div class="trivia">
    <div class="form-header">
    <div class="question-number my-1"><span id="count" class="fw-bolder text-success">1</span><span> of </span><span id="totalQuestions"></span></div>
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

    let totalQuestions=4;
    let timeValue =  15;
    let que_count = 0;
    let que_numb = 1;
    let userScore = 0;
    let counter;
    let id=1;
    //let id_Array=new Array(totalQuestions).fill(0);
    let selectedAnswer=[];
    let index=0;
    let timeStorage=[];
    
    
    function getData(id){
        $.ajax({
        url:'<?php echo base_url().'index.php/Quiz/getData/'?>'+id,
        type:'post',
        data:{},
        dataType:'json',
        success:function(response){
        console.log("success");
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

    function initializeApp(){
    $('#prev').hide();
    getData(id);
    showQuestions(1);
    startTimer(timeValue); 
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

        }
    }


    function startTimer(time){
        $("#time").html(time);
       counter=setInterval(timer,1000);
       function timer(){
        if(time>0){
        time--;
        $("#time").html(time);
        timeLeft=time;
        }
        else{
            $("#time").html("Time Off");
            clearInterval(counter);
            timeStorage.push(timeLeft); 
        }
       }
    }

    const next=document.querySelector("#next");
    const prev=document.querySelector("#prev");

    next.addEventListener("click",function(){
        id++;
        clearInterval(counter);
        startTimer(15); 
        $('#prev').show();
        getData(id);
        const data=JSON.parse(localStorage.getItem('data'+id));
        options=JSON.parse(data[index].options);
        $('#count').html(data[index].q_id);
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
    });


    prev.addEventListener("click",function(){
        
        id--;
        const data=JSON.parse(localStorage.getItem('data'+id));
        options=JSON.parse(data[index].options);
       
        $('#count').html(data[index].q_id);
        $('#que-text').html(data[index].question_text);

        for(i=0;i<options.length;i++){
        $('#option-'+i).html(options[i]);
        }

        for (i = 0; i < options.length; i++) {
        $('#option-' + i).click(function() {
        let correctAns=data[index].correct_answer;
        const selectedOptionValue = $(this).text();
        optionSelected(selectedOptionValue,correctAns);
        });
       }

    });

    

    initializeApp();


</script>


</html>