<?php
require_once "Lib/DadosFiltro.php";
$teste = "3\;.567abtyu";
$tst = "";

if(isset($_POST['Sonic']))
	echo "Tem Post";
//session_start();
var_dump(session_status()); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<input type="text" name="Sonic">
		<button type="submit">ssss</button>
	</form>
</body>
</html>