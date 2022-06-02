<?php
session_start();

require_once './partials/dbconnect.php';

if(!isset($_SESSION['loggedin'])){
  header('Location:index.php');
}

$user=$_SESSION['name'];

// retriving user quiz history from ranks table
$sql="SELECT `q`.`quiz_name`, `r`.`score`,`r`.`Date and Time` FROM `ranks` `r` LEFT JOIN `quizlist` `q` ON `r`.`quiz_id`=`q`.`quiz_id` LEFT JOIN `users` `u` ON `r`.`user_id` = `u`.`user_id` WHERE `u`.`email`='fazlehaqs360@gmail.com';";
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
        margin: 0 auto;
         width: 100%;
         margin: 0 auto;
         padding: 0;
       }

      .table{
        min-width: 90%;
        width: 1200px;
        max-width: 1500px;
        margin: 2em auto;
        font-size: 2rem;
        text-align: center;
      }

      @media only screen and (max-width: 1200px) {
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
            <a href="welcome.php"  id="home" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="./partials/logout.php" class="nav-link-button">
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

    <!-- Name of the user -->
    <h1>User History</h1>
    <h2><?php echo $user ?></h2>

    <div class="container ">
    <table class="table table-striped ">
        <thead>
            <th>Sr.No</th>
            <th>Subject</th>
            <th>Score</th>
            <th>Date</th>
        </thead>
        
        <?php
        if($res==true){
        $count=1;
        while($row=mysqli_fetch_assoc($res)){
            echo "<tr >
            <td> $count </td>
            <td> ".$row['quiz_name']."</td>
            <td> ".$row['score']."</td>
            <td> ".$row['Date and Time']."</td>
            </tr>";
          $count++;
        }
    }

    else{
        echo '<h2>No Attempted Quiz Yet!<h2>';
    }
    ?>   
    </table>
    </div>
    
    <!-- Navbar javascript -->s
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