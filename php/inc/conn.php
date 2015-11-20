<?php 
$dbhost = 'localhost'; 
$dbuser = 'root'; //mysql 
$dbpass = '123'; //mysql 
//$dbuser = 's430088db0'; //mysql 
//$dbpass = 'sun415liu220'; //mysql 
$dbname = 's430088db0'; //mysql 
$connect = mysql_connect($dbhost,$dbuser,$dbpass); 
mysql_query("SET NAMES 'UTF8'");
mysql_select_db($dbname, $connect);
/*$sql="select * from rd_user";
$result = mysql_query($sql);
while ( $row = mysql_fetch_array($result) ) {
  echo("<P>" . $row["user_account"] . "</P>");
}
if ($connect) { 
echo "成功"; 
} else { 
echo "1"; 
}*/
?> 