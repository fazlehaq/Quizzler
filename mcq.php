<?php 
  session_start();
  require_once './partials/dbconnect.php';
  
  // Checking if it is still logged in or not
  if(!isset($_SESSION) || $_SESSION['loggedin']==false){
      header('location:index.php');
  }

  // storing quizname and total question recieved form welcome.php start/Restart btn
  $quizName=$_POST['quizName'];
  $total_questions=$_POST['total_questions'];
  $time=$_POST['time'];

  $sql = "SELECT `quiz_id` FROM `quizlist` WHERE `quiz_name`='$quizName';";
  $res=mysqli_query($conn,$sql);
  $quiz_id=mysqli_fetch_assoc($res);
  // Making it available for different files
  $_SESSION['quizName']=$quizName;
  $_SESSION['total_questions']=$total_questions;
  $_SESSION['time']=$time;
  $_SESSION['quizId']=$quiz_id;


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css//table.css">
    <link rel="stylesheet" href="./css/welcome_style.css" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
    <!-- css style for fixed header and stop watch -->
    <link rel="stylesheet" href="./css/mcq.css">
  </head>

  <body>
    <!-- Header --->
    <div class="details fixed-top fixed">
     <header class="header">
      <nav class="navbar">
        <img class="nav-logo" src=".//ImagesAsset/logo.png" alt="" />
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="./redirects/ReHome.php" onclick='return confirm("Quiz Will Be submited !");' id="home" class="nav-link">Home
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">Contact Us</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">About</a>
          </li>

          <li class="nav-item">
            <a href="./redirects/ReLogout.php" class="nav-link-button" 
            onclick= 'return confirm("Quiz Will Be submited !");'>
            <button class="btn">Log Out</button>
            </a>
          </li>
        </ul>

        <div class="hamburger">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>

      </nav>
    </header> 

    <!-- Remaining Time -->
    <div class="qd">  
      <div class="time flex flex-row">
      <p>Time Remaining</p>
      <p class="timer"></p>
      </div>
    </div>
  </div>

        <!-- stopwatch js-->


    

    <!-- Exceptions -->
    <?php 
    try{
  
      // var_dump($total_questions);
      if($total_questions==0){
        throw new Exception('No Questions');
      }
    }
    
    catch (Exception $e){
      die("<h1>No questions Available currently<h1>"); // content below wont be dislplyed
    }
    ?>

  <!-- main  -->
      <form class="main-container" action='score.php' method='post'>
            <?php 
            // itertaing over all question and printing it
            $sql = "SELECT `question`, `option1`, `option2`, `option3`, `option4`, `answer` FROM `questions` `qs` LEFT JOIN quizlist `ql` ON `qs`.`quiz_id`=`ql`.`quiz_id`  WHERE `quiz_name`='$quizName';";
            $res=mysqli_query($conn,$sql);
            
            $i=1;
            while($row=mysqli_fetch_assoc($res)){
                // retriving from table 
                // $sql="SELECT * FROM `$quizName` WHERE `sr_no`='$i'";
                

                // $row=mysqli_fetch_assoc($res);
                
                $question=$row['question'];
                $option1=$row['option1'];
                $option2=$row['option2'];
                $option3=$row['option3'];
                $option4=$row['option4'];

                // $opt=explode(',',$options);                
 
                echo "<div class='Questions'>
                <div class='text'>
                ".$i.")".$question;

                echo "<div class='".$i." in'>  
                <input class='".$i."' type='radio' name='".$i."' id='".$i."-1' value='".$option1."'>
                <label for='".$i."-1'>".$option1."</label>
                </div>";               

                echo "<div class='".$i." in'>  
                <input class='".$i."' type='radio' name='".$i."' id='".$i."-2' value='".$option2."'>
                <label for='".$i."-2'>".$option2."</label>
                </div>";

                echo "<div class='".$i." in'>  
                <input class='".$i."' type='radio' name='".$i."' id='".$i."-3' value='".$option3."'>
                <label for='".$i."-3'>".$option3."</label>
                </div>";

                echo "<div class='".$i." in'>  
                <input class='".$i."' type='radio' name='".$i."' id='".$i."-4' value='".$option4."'>
                <label for='".$i."-4'>".$option4."</label>
                </div>";

                echo "</div>
                </div>";

                $i++;
              }               
          ?> 
            <div>
              <button type="submit" class="submit-btn">Submit</button>
            </div>       
           
      </form>

      
      <script>
      let TotalMinutes=<?php echo $time ?>;
      let time = TotalMinutes*60;
      const totalMS=TotalMinutes*61300;
      let minutes;
      let seconds;
      
      let timer = document.querySelector('.timer');
      const int=setInterval(counter,1000);
      let submit= document.querySelector('.submit-btn');

      function counter(){
        minutes=Math.floor(time/60);
        seconds=time%60;
        seconds = seconds < 10 ? '0'+ seconds : seconds;
        timer.innerHTML= `${minutes}:${seconds}`
        time--;
        // auto submit at 00:00
        if(minutes==0 && seconds==0){
          submit.click();
        }
      }

      setTimeout(()=>{
          clearInterval(int);
      },totalMS);

      </script>
      <!-- script for hamburger nav for smaller devices -->
      <script src="./js/nav.js"></script>

      <!-- Auto Submit After the Time over -->
      <script>
          // let time=<?php echo $total_questions ?>*60000;
          // let time=6000;
          // setTimeout(endQuiz,time);
          // let submit= document.querySelector('.submit-btn');
          // function endQuiz(){
          //   submit.click();
          // }
      </script>



  
      <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
