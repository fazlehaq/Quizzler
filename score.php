<?php 
session_start();
require_once './partials/dbconnect.php';

if(!isset($_SESSION['loggedin'])){
  header('Location:index.php');
}

// Accessing username and quizname to store scores in db
$email=$_SESSION['email'];
$name=$_SESSION['name'];
$quizName=$_SESSION['quizName'];

// retriving answers of quiz 
// $sql="SELECT `answer` FROM `$quizName`";
$sql="SELECT `answer` from `questions` `qs` LEFT JOIN `quizlist` `ql` ON `qs`.`quiz_id`=`ql`.`quiz_id` WHERE `quiz_name`='$quizName';";

$res=mysqli_query($conn,$sql);
$row[]='0';

// storing answers in array
while($data=mysqli_fetch_assoc($res)){
    $row[]=$data;
}

$correct=0;
$attemptedQ=0;
$total_questions=count($row)-1; // substracting 1 since we added a 0 at the begining

// we have both users submited answer array and Answers retrieved from db
// now we cannt just compare them since user might have skipped some question
// we had given each input of a question its qno as name so we can access it by just qno
// now we iterate every question using qno and then check the $_POST[] if a element exist 
// with key 'qno' using array key exist if it exist we compare $post[i] and $row[$i]['answer']

// now What is $row[$i]['answer'] ?
// when we vardump $row it is associative array where keys are 0 to totalQno
// in which each 'element' contain 'array' which is again associative array which has only one 
// key named answer that conatains answer to the question number of $i
// we trim both string and then compare them 

// if both are equal we increament score | same or not we increament attemptedQ var

for($i=1;$i<=$total_questions;$i++){
  if( array_key_exists($i,$_POST)){
      if(trim($row[$i]['answer'])==trim($_POST[$i]) ){
          $correct++; 
      }
      $attemptedQ++;
    } 
}

$wrongAns=($attemptedQ-$correct);
$score=$correct;


// inserting scores in rank table in db
// check if user have already given the test

require_once './partials/scoreDB.php';

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/welcome_style.css">
    <link rel="stylesheet" href="./css/table.css">
    <title>Hello, world!</title>
    <style>
        .cotainer{
            margin: 0 auto;
            width: 50%;
        }
        
        .table{
          width: 80%;
          max-width: 1500px;
          margin: 2em auto;
          font-size: 2rem;
          /* text-align: center; */
        }
        h1{
            text-align: center;
            margin-top: 5rem;
            font-size: 3rem;
        }
    </style>
  </head>
<body>

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
          <!-- <li class="nav-item">
            <button class="nav-link">Log Out</button>
          </li> -->
          <li class="nav-item">
            <a href="./partials/logout.php" class="nav-link-button">
            <button class="btn">Log Out</button>
              <!-- <button class="log-out">
                <img src="./ImagesAsset/signout.svg" alt="" />
              </button> -->
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

  <!-- Here We shows the result -->

    <div class="container ">
    <h1>SCORE</h1>
    <table class="table table-striped ">
        <tr>
            <th>User Name</th>
            <td> <?php echo $_SESSION['name'] ?>  </td>
        </tr>

        <tr>
            <th>Quiz Name</th>
            <td> <?php echo $_SESSION['quizName'] ?>  </td>
        </tr>

        <tr>
            <th>Time</th>
            <td> <?php echo $_SESSION['time']." min";?>  </td>
        </tr>

        <tr>
            <th>Total Question</th>
            <td> <?php echo $total_questions ?>  </td>
        </tr>

        <tr>
            <th>Attempted Question</th>
            <td> <?php echo $attemptedQ ?>  </td>
        </tr>

        <tr >
            <th >Correct Answer</th>
            <td> <?php echo $correct ?>  </td>
        </tr>

        <tr >
            <th >Wrong Answer</th>
            <td> <?php echo $wrongAns ?>  </td>
        </tr>

        <tr >
            <th>Score</th>
            <td> <?php echo $correct*2 ?>  </td>
        </tr>

    </table>
    </div>

    <script src="./js/nav.js"></script>

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