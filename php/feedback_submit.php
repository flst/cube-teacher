<?php
include_once("inc/conn.php"); 
$feedback_text = $_POST["feedback_text"];
//echo $feedback_text;
$sql="insert into ct_feedback(nickname,email,feedback) values('', '', '".$feedback_text."')";
$result = mysql_query($sql);
//echo mysql_result($result, 0);

?>