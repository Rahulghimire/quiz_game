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
          width:25%;
        }

        .alert{
            border-radius: 0.15rem;
        }

    </style>
</head>

<body id="body">
        <?php
                $status = $this->session->flashdata('success');
                if($status){
                    echo '<div class="alert alert-success alert-dismissible fade show zindex" role="alert">' . $status . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>';
                }
            ?>
    <h1 id="intro" class="text-white text-center"></h1>
    <div class="button-group">
        <button type="button" class="btn btn-success px-4" id="login"><a class="text-decoration-none text-white" href="<?php base_url()?>loadQuiz">Start Quiz</a></button>
        <button type="button" class="btn btn-danger px-4"><a class="text-decoration-none text-white" href="<?php base_url()?>logout">Exit Quiz</a></button>
    </div>
</body>

<script>
  
setTimeout(function() {
    $('.alert').alert('close');
  },1200);

    //For user signup
    function start(){
        $(document).ready(function(){
            $.ajax({
                url:'<?php echo base_url().'index.php'?>',
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
  var text = "Welcome To The Quiz Application";
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


