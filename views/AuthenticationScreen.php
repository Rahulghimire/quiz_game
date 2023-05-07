<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css'?>">
    <script type="text/javascript"src="<?php echo base_url().'assets/jquery-3.6.4.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
  
   <style>
    
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            /* background-color:#e3edf7; */
            /* background-image:url('http://localhost/quiz_game/assets/bg-gradient.avif'); */
            background-position: center; 
            background-repeat: no-repeat; 
            background-size: cover;
            animation: bg-animation 8s infinite;
            animation-timing-function:ease-in-out;
            animation-direction: alternate;
        }

        .button-group{
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:20px;
        }

        #intro{
            width:100%;
            position:absolute;
            top:8rem;
        }

        @keyframes bg-animation {
        0% {  background-image:url('http://localhost/quiz_game/assets/bg-gradient.avif'); }
        50% { background-image:url('http://localhost/quiz_game/assets/bg-3.avif');}
        100% {  background-image:url('http://localhost/quiz_game/assets/digi.avif'); }
        }

        @media screen and (max-width: 600px){
          h1{
          font-size:2rem;
          }
        }

        .formWrapper{
            margin:20px;
        }

        .zindex{
          z-index: 1;
        }

    </style>
</head>

<body id="body">
    <h1 id="intro" class="text-white text-center"></h1>
    <div class="button-group">
        <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success px-4" id="login" onclick="login()">Login</button>
        <button type="button" class="btn btn-info px-4" id="signup" onclick="signup()">Register</button>
    </div>
</body>

<script>

    //For user signup

    function signup(){
        $(document).ready(function(){
            $.ajax({
                url:'<?php echo base_url().'index.php/Auth/RegisterController/'?>',
                type:'GET',
                data:{},
                dataType:"html",
                success:function(response){
                    console.log(response);
                    $('#body').html(response);
                },
                error:function(){
                  console.log(error);
                },
                complete:function(xhr,status,error){
                  console.log("request completed");
                }
            });
        });
    }


    //For user and admin login

    function login(){
        console.log("button clicked");     
        $(document).ready(function(){
          $.ajax({
            url:'<?php echo base_url().'index.php/Auth/LoginController/'?>',
            type:'GET',
            data:{},
                dataType:"html",
                success:function(response){
                    console.log(response);
                    $('#body').html(response);
                },
                error:function(){
                  console.log(error);
                },
                complete:function(xhr,status,error){
                  console.log("request completed");
                }
          });

    });   
    }


  //For the typing animation

  $(document).ready(function(){
  var text = "Welcome Please Register To Play";
  var index = 0;
  var typing = setInterval(function(){
    $('#intro').text(function(){
      return text.slice(0, ++index);
    });
    if(index == text.length){
      clearInterval(typing);
      setTimeout(function(){
        index = 0;
        typing = setInterval(function(){
          $('#intro').text(function(){
            return text.slice(0, ++index);
          });
          if(index == text.length){
            clearInterval(typing);
          }
        }, 100);
      }, 2000);
    }
  }, 100);
});

</script>

</html>


