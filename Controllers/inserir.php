<?php
require_once "../Models/Usuario.php";
require_once "../Models/Contato.php";
require_once "../Models/Telefone.php";
$u = new Usuario();
$c = new Contato();
$t = new Telefone();
/**
 * Teste do CRUD das classes no banco
 */
switch($_GET['asuna'])
{
case 0:
    //$u->setId(12);
    $u->setNome($_POST['nome']);
    $u->setSenha($_POST['senha']);
    $u->save();
break;
case 1:
    //$c->setId(11);
    $c->setNome($_POST['nome']);
    $c->setEmail($_POST['email']);
    $c->setUsuarioId($_POST['id']);
    $c->save();
break;
case 2://Eu não coloquei Auto_increment na tabela telefone pois queria tentar com o SELECT MAX()
    //$t->setId(8);
    $t->setDdd($_POST['ddd']);
    $t->setNum($_POST['tel']);
    $t->setTipo($_POST['tipo']);
    $t->setContatoId($_POST['id']);
    $t->save();
break;
default: "ERROR";
}
/*$t = new Telefone();
$t->loadById(9);
$t->deletar();*/
/*foreach($v_tel as $t)
{
    $t->deletar();
}
$c->loadById(1);
$c->deletar();*/
/*array_push($value,$c->loadById(1)->getId());
array_push($value,$c->loadById(1)->getNome());
array_push($value,$c->loadById(1)->getEmail());
foreach($value as $v_tel)
{
    echo $v_tel;
}*/
//var_dump($c->loadById(1));




?>

<html>

</html>