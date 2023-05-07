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

    <style>
        
          *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Roboto', sans-serif;
        }

        body{
            background-image:url('http://localhost/quiz_game/assets/bg.jpg');
            background-repeat: no-repeat; 
            background-size: cover;
        }

        .trivia {
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        }

        .question {
        width: 80%;
        background: linear-gradient(#100241, black);
        text-align: center;
        color:white;
        padding: 20px;
        border-radius: 10px;
        border: 2px solid white;
        font-size: 20px;
        }

        .options{
            display:flex;
            flex-wrap: wrap;
            justify-content: center;
            cursor: pointer;
            color:white;
        }

        .option{
            width: 45%;
            padding: 10px;
            margin: 0 10px 20px 10px;
            text-align: center;
            background: linear-gradient(#0e0124, #22074d);
            border: 1px solid white;
            border-radius: 15px;
            font-weight: 300;
            font-size: 20px;
            cursor: pointer;
        }

        .option:hover{
        background: mediumblue;

        }

        .timer {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 5px solid white;
        display: flex;
        align-items: center;
        justify-content: center;        
        font-size: 30px;
        font-weight: 700;
        }


    </style>
</head>
<body>
    <div class="trivia">
    <div class="timer text-white text-bold">50</div>
        <div class="question">Demo Question</div>
        <div class="options">
        <div class="option">Hello Welcome to the world how are you doing</div>
        <div  class="option">option-2</div>
        <div  class="option">option-3</div>
        <div  class="option">option-4</div>
        </div>
    </div>

</body>
</html>