<?php
  session_start();
  
  require_once './partials/dbconnect.php';
  if(!isset($_SESSION['loggedin'])){
    session_unset();
    session_destroy();
    header('Location:index.php');
  }
  
  if(!isset($_SESSION) || $_SESSION['loggedin'] ==false ){
    header("location: index.php");
    exit;
  }

  $email=$_SESSION['email'];
  $name=$_SESSION['name'];

  // query for retreiving name of all quiz in db
  $sql='SELECT * FROM `quizlist`';
  $res=mysqli_query($conn,$sql);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/welcome_style.css">
    <link rel="stylesheet" href="./css/table.css">

    <title>Welcome</title>
    <style>
      .container{
        margin-top: 4rem; 
      }

      input,label{
        display:none;
      }

      .container{ 
         width: 100%;
         margin: 0 auto;
         padding: 0;
    }
      

     .table{
       width: 90%;
       max-width: 1500px;
       margin: 0 auto;
       padding: 0;
       font-size: 2rem;
       text-align: center;
       
     }
 
     h1{
       text-align: center;
       margin-top: 5rem;
       font-size: 3rem;
     }
     
     form[action="mcq.php"]{
       width: fit-content;
       margin: 0 auto;
     }

     @media only screen and (max-width:366px) {
        .container{
         overflow-x: scroll; 
        }
      }

    </style>

  </head>
  <body>

    <!-- navbar -->
    <header class="header">
      <nav class="navbar">
        <img class="nav-logo" src=".//ImagesAsset/logo.png" alt="" />
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="welcome.php" id="home" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="history.php" class="nav-link">History</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="./partials/logout.php" class="nav-link-button" >
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
    <!-- main content here -->
      <?php
        echo "<h1>Welcome To QuiZZler " .$name."</h1>";
      ?>

    <div class="container">
    
    <table class="table table-striped ">
      <thead>
        <th>S.no</th>
        <th>Topic</th>
        <th>Questions</th>
        <th>Time</th>
        <th>Action</th>
      </thead>

      <!-- printing all available quizes in db using fir loop and tables -->
      <!-- Here we used form in the last column to pass quiz name and 
      question no and time using post -->

      <?php 
      $i=1;
      while($row=mysqli_fetch_assoc($res)){
        echo "<tr>
        <td>".$i."</td>
        <td>".$row['quiz_name']."</td>
        <td>".$row['total_questions']."</td>
        <td>".$row['time']."</td>
        <td>
        <form action='mcq.php' method='post'>
          <input type='checkbox' name='quizName' id=".$i." checked='true' value=".$row['quiz_name']."> 
          <input type='checkbox' name='total_questions' id='' checked='true' value=".$row['total_questions'].">
          <input type='checkbox' name='time' id='' checked='true' value=".$row['time'].">";
      
          // schecking user has given exam before          
          // using left join to join user table and quizlist table 
          $Bsql ="SELECT `u`.`name`, `q`.`quiz_name` , `ranks`.`score`, `ranks`.`Date and Time` FROM `ranks` LEFT JOIN `users` `u` ON `u`.`user_id`=`ranks`.`user_id` LEFT JOIN `quizlist` `q` ON `ranks`.`quiz_id`=`q`.`quiz_id` WHERE `q`.`quiz_name`='".$row['quiz_name']."' AND `u`.`email`='$email';";

          $Bres=mysqli_query($conn,$Bsql);
          $isQuizGiven=mysqli_num_rows($Bres);

          // if not creating new record
          if($isQuizGiven<1){
            echo "<button class='start btn logout' type='submit'>Start</button>
            </form>";
            }
          
          // if given updating best score if curr score > best score
          else{
            echo "<button class='Restart btn logout type='submit'>Restart</button></form>";
          }

          $i++;
        }
        
        echo "</td>";
      ?>

    </table> 
    </div>

    <script src="./js/nav.js"></script>

    
    <!--Bootstrap-->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>