<!DOCTYPE HTML>
<html>
<body>

<canvas id="myCanvas" width="200" height="100" style="border:1px solid #c3c3c3;">
Your browser does not support the canvas element.
</canvas>

<script type="text/javascript">

var c=document.getElementById("myCanvas");
var cxt=c.getContext("2d");
cxt.fillStyle="#FF0000";
cxt.fillRect(30,30,100,100);

// cObj.fillStyle = "rgba(200,0,0,0.5)"


</script>
<?php
$a = array("a", "b", "c");
$b = "abc";

echo end($a);
echo substr($b, -1);
?>
</body>
</html>
