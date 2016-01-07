<?php
include_once("inc/conn.php"); 
$feedback_text = $_POST["feedback_text"];
$nickname = $_POST["nickname"];
$email = $_POST["email"];
//echo $feedback_text;
$sql="insert into ct_feedback(nickname,email,feedback) values('".$nickname."', '".$email."', '".$feedback_text."')";
$result = mysql_query($sql);
//echo mysql_result($result, 0);
?>