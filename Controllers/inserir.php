<?php
require "../Models/Usuario.php";
$u = new Usuario(0,$_POST['nome'],$_POST['senha']);
?>

<html>
<h1><?php $u->save(); ?><h1>

</html>