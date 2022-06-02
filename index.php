<?php
session_start();
// destroying session if it is still logged in 
if(isset($_SESSION['loggedin'])){
	session_unset();
    session_destroy();
	session_start();
}

$passwordError=false;
$InavlidUser=false;

if($_SERVER['REQUEST_METHOD']=="POST")
{
  // Connecting to the database
  include_once 'partials/dbconnect.php';
  $e_Email=$_POST['email'];
  $e_Password=$_POST['Password'];

  // Fetching data as per user name entered by user
  $loginSql="Select * from `users` where `email`='$e_Email'";
  $res=mysqli_query($conn,$loginSql);

  // Checking if there is even user with entered username
  $existNum=mysqli_num_rows($res);
  $UserExist=true;
  
  if($existNum>0)
  {    
    while($row=mysqli_fetch_assoc($res))
    {
	  // Comparing passsword    
      if(password_verify($e_Password,$row['Password']))
      {
		// starting session and sending user to the welcome page
        $_SESSION['loggedin']=true;
        $_SESSION['name']=$row['name'];
        $_SESSION['email']=$e_Email;
        header("location: welcome.php");
        exit;
      }
    }
	// if Entered password is wrong
      $_SESSION['loggedin']=false;
      $passwordError=true;
  }

  //  If User dont exist
  else{
    $InavlidUser=true;
  }

}?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">	
	<link rel="stylesheet" href="./css/login_signup.css">
	<title>Document</title>
</head>
<style>
	.msg{
		z-index: 10;
	}

	form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
    	display: block;
    	width: 100%;
    	box-sizing: border-box;
    	border-radius: 8px;
    	border: 1px solid #c4c4c4;
    	padding: 8px;
    	margin-bottom: 1rem;
    	font-size: 0.875rem;
    }
</style>
<body>

<!-- Part for just Debugging logining works with bootstrap well -->
<?php 
        if($passwordError)
        {
          echo'<div class="msg fixed-top fixed alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Invalid Password!</strong> Please Enter Correct Password.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }

        if($InavlidUser)
        {
          echo'<div class="msg fixed-top fixed alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Invalid Usename ! </strong> No Such User Name Found.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
	    }
    ?>

<!-- Ends Here -->

	<!-- Main Container ? Holds Both left and right division   -->
	<div class="split-screen">
		
		<!-- ? Left Container / Left side Image And welcome content is here******************************************** -->
		<div class="left">

			<!--  Welcome -->
			<section class="sec">
				<h1 class="left-text">Welcome </h1>
				<p class="left-text">Wanna Know Your Knowledge! Sign Up And Test Your Knowledge Now</p>
			</section>

		</div>
		
		<!-- ? Right Container/ Right Form Content Is here****************************************************************  -->
		<div class="right">

			<!--  Login Form  -->
			<form action="index.php" method="post">

				<!--  Section For Header And Already Have an Ac  -->
				<section class="sec">
					<img src="img/undraw_profile_pic_ic5t.png" alt="" class="imgs">
					<h2>Log In</h2>
					<div class="account-exist">
						<p>Don't have an account?<a href="signUp.php"><Strong>Sign Up</Strong></a></p>
					</div>
				</section>

				<!-- User Mail And password Start Here  -->

				<div class="input-container email">
					<label for="email">Email</label>
					<input id= "email" name="email" type="email" placeholder="email" required>
				</div>

				<div class="input-container password">
					<label for="password">Password</label>
					<input id= "password" name="Password" type="password" placeholder="Password" 
					minlength="4" maxlength="20" required>
				</div>

				<div class="showPass">
                    <input type="checkbox" id="showpassword" > Show Password
                </div>

                <!-- ?  Button for sign up and sign in  -->
				<button class="signup-btn" type="submit">Sign In</button>

			</form>

		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="./js/showPassword.js"></script>
</body>
</html>