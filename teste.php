<?php
/*require_once "Models/ConectaBanco.php";

$chars = [["Yuuna","Mami","Sonoko"],["Rei","Shinji"]];
foreach($chars as $test)
{
    echo $test;
}

$c = new ConectaBanco();
$e = $c->conectar()->query("SELECT * FROM tb_contato;");
$regis = $e->fetchAll();
foreach($regis[$key] as $yui)
{
    echo $yui;
}*/
require_once "Controllers/UsuarioController.php";
$uc = new UsuarioController();
$uc->logarUsuario();
?>