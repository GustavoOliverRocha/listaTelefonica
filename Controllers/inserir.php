<?php
require "../Models/Usuario.php";
$u = new Usuario($_POST['nome'],null,null);
$u->loadById($u->getId());
?>

<html>

</html>