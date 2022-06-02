<?php 
require_once 'dbconnect.php';
session_start();

$quizname=$_SESSION['quizName'];
$quizID=$_SESSION['quiz_id'];
$sql="SELECT `answer` FROM `questions` WHERE `quiz_id`='$quizID'";
$res=mysqli_query($conn,$sql);
$row[]='0';

while( $data=mysqli_fetch_assoc($res) ){
    $row[]=$data;
}

$score=0;
$attemptedQ=0;
$total_questions=count($row)-1;


for($i=1;$i<=10;$i++){
if( array_key_exists($i,$_POST)){
    if(trim($row[$i]['answer'])==trim($_POST[$i]) )
    {
        $score++;
    }
    $attemptedQ++;
}
}

$wrongAns=($attemptedQ-$score);
?>

