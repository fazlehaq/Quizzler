<!-- Sign up Page -->

<?php
session_start();
// destroying session if it is still logged in 
if(isset($_SESSION['loggedin'])|| !isset($_SESSION['loggedin'])){
	session_unset();
    session_destroy();
	session_start();
}

$login=false;
$PassMatchError=false;
$userExist=false;

// runs when user click the signup button
if($_SERVER["REQUEST_METHOD"]=="POST"){

    // connecting to database
    include_once 'partials/dbconnect.php';
    
    // retreiving data from form
    $name=$_POST['name'];
    $email=$_POST['email'];
    $Password=$_POST['Password'];
    $cPassword=$_POST['cPassword'];

    // checking if username already exist or not
    $existSql="SELECT * FROM `users` WHERE `email`='$email';";
    $res=mysqli_query($conn,$existSql);

    // checking the number of users
    $userExistNum=mysqli_num_rows($res);
    if($userExistNum>0)
    {
        $userExist=true;
    }

    else{
        if($Password!=$cPassword){
            $PassMatchError=true;
        }

        else{
            // making variable true
            $login=true;

            // hashing the entered password
            $hash=password_hash($Password,PASSWORD_DEFAULT);

            // storing user login data in db
            $sql="INSERT INTO `users`(`user_id`,  `name`, `Email`, `Password`) VALUES ('','$name','$email','$hash')";
            mysqli_query($conn,$sql);

            // starting a session and initializing a variables
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            // redirecting user to the home / welcome page
            header("location: welcome.php");
            exit;
        }
    }
    
}

?>

<!-- html begins -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">	
	<link rel="stylesheet" href="css/login_signup.css">
	<title>Document</title>
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
</head>
<body>
<?php 
        if($userExist){
          
            echo '<div class="msg fixed-top fixed alert alert-warning alert-dismissible fade show" role="alert">
            <strong>User Already Exist! </strong> Try With Some Other Username !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

        if($PassMatchError==true)
        {
            echo '<div class=" msg fixed-top fixed alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Passwords Do Not Match ! </strong> Check Your Passwords
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

        if($login)
        {
            echo '<div class=" msg fixed-top fixed alert alert-success alert-dismissible fade show" role="alert">
            <strong>Excellent ! </strong>Congratulations Your Account Has Been Signed Up.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    ?>

		<!-- ? Main Container ? Holds Both left and right division*****************************************************   -->
	<div class="split-screen">
		
		<!-- ? Left Container / Left side Image And welcome content is here******************************************** -->
		<div class="left">

			<!--  Welcome -->
			<section class="sec">
				<h1 class="left-text">Welcome </h1>
				<p class="left-text">Wanna Know Your Knowledge! Sign Up And Test Your Skills Now</p>
			</section>

		</div>
		<!-- ? Right Container/ Right From Content Is here**********************************************************************  -->
		<div class="right">

			<!--  Sign Up Form  -->
			<form action="signUp.php" method="POST">

				<!--  Section For Header And Already Have an Ac  -->
				<section class="sec">
					<img src="img/undraw_profile_pic_ic5t.png" alt="" class="imgs">
					<h2>Sign Up</h2>
					<div class="account-exist">
						<p>Already have an account?<a href="index.php"><Strong>Log In</Strong></a></p>
					</div>
				</section>

				<!--  User Mail And password Start Here  -->
        <div class="input-container name">
					<label for="name">Name</label>
					<input id= "name" name="name" type="text" placeholder="name" required >
				</div>

        <div class="input-container name">
					<label for="username">Email</label>
					<input id= "username" name="email" type="email" placeholder="Email" required>
				</div>

				<div class="input-container password">
					<label for="password">Password</label>
					<input id= "password" name="Password" type="password" placeholder="Password" minlength="4" maxlength="20" required>
				</div>

				<div class="input-container password">
					<label for="cPassword">Password</label>
					<input id= "cPassword" name="cPassword" type="password" placeholder=" Confirm Password Here " minlength="4" maxlength="20" required>
				</div>

        <div class="showPass">
          <input type="checkbox" id="showpassword" > Show Password
        </div>

				<!-- ?  Button for sign up and sign in  -->
				<button class="signup-btn" type="submit">Sign Up</button>

			</form>

		</div>
	</div>
  <!-- script for show password checkbox -->
  <script src="./js/showPassword.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>