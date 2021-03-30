<?php
require "../Models/Usuario.php";
$u = new Usuario();
//$u->loadById($u->getId());
$asuka;
// $asuka = $u->listarUsuarios()->getNome();
 //echo $asuka[0]->getNome();
 foreach($u->listarUsuarios() AS $asuka)
{
    echo $asuka->getId()."&nbsp&nbsp&nbsp";
    echo $asuka->getNome()."&nbsp&nbsp&nbsp";
    echo $asuka->getSenha()."<br>";
}
?>

<html>

</html>