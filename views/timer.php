<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            display:flex;
            justify-content:center;
            height:100vh;
        }
        .time{
            font-size:20px;
        }
    </style>

    <script>

        const students=["ram","hari","krishna"];
        console.log(students);

        localStorage.setItem('students',JSON.stringify(students));

        const myObj = { name: 'John', age: 30 };
        localStorage.setItem('myObj', JSON.stringify(myObj));

        localStorage.getItem(myObj);

        // Retrieve an object from localStorage
        const obj = JSON.parse(localStorage.getItem('myObj'));
        console.log(obj); 
        localStorage.getItem('students');

        //localStorage.removeItem(students);
        //localStorage.removeItem(myObj);

        //localStorage.clear();
    </script>
  
</head>
<body>
    <div>
        <div><span id="time" class="time">00</span><span>secs</span></div>
        <div class="buttons" id="buttons" >
            <button type="button" id="start">start</button>
            <button type="button" id="pause">pause</button>
            <button type="button" id="reset">reset</button>
        </div>
    </div>
    <div>
        <p id="text">text</p>
    </div>
    <div>
        <button onclick="myFunc()">Audio</button>
    </div>
<script>

    const time=document.querySelector('#time');
    const pauseBtn=document.querySelector("#pause");
    const stopBtn=document.querySelector("#stop");
    const startBtn=document.querySelector("#start");

    console.log(startBtn);

    let startTime=0;
    let elapsedTime=0;
    let paused =true;
    let intervalId;

    let secs=0;

    startBtn.addEventListener("click",()=>{
        console.log("clicked");
        if(paused){
            paused=false;
            let startTime=Date.now();
            console.log(startTime);
        }
    });

    let t1=Date.now();
    let t2=Date.now();
    console.log(t1,t2);

//    let id=setInterval(myFunc,1000);
//    console.log(id);
//    function myFunc(){
//     console.log("hello");
//     let text=document.querySelector("#text")
//     text.innerHTML="This is para 1";
//    }

//    let endTime=15;
//    time.innerHTML=endTime;

//    let timeId=setInterval(myTimer,1000);
   
//    function myTimer(){
//     time--;
//    }






</script>

</body>
</html>