<?php 
$username=$_SESSION['name'];
$quizName=$_SESSION['quizName'];

// finding user_id
$uSql="SELECT `user_id` FROM `users` WHERE `Email`='$email';";
$qSql="SELECT `quiz_id` FROM `quizlist` WHERE `quiz_name`='$quizName';";
$uRes=mysqli_query($conn,$uSql);
$qRes=mysqli_query($conn,$qSql);

$row=mysqli_fetch_assoc($uRes);
$user_id=$row['user_id'];

$row=mysqli_fetch_assoc($qRes);
$quiz_id=$row['quiz_id'];

$SQL="INSERT INTO `ranks`(`sr_no`, `user_id`, `quiz_id`, `score`) VALUES ('','$user_id','$quiz_id','$score');";
$res=mysqli_query($conn,$SQL);

?>