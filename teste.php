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
if($_GET['asuna'] == 1)
    $uc->logarUsuario();
else if($_GET['asuna'] == 2)
    $uc->cadastrarUsuario();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="../">Deslogar</a>
</body>
</html>