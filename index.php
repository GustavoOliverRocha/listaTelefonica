<?php
require "Models/Usuario.php";
require "Models/Contato.php";
require "Models/Telefone.php";

$u1 = new Usuario(0,"Yuuna","Gouenji456");
$u2 = new Usuario(1,"Tougou","MonmonmonPokemonmon");

echo "<h1>".$u1->getId()."</h1>";
echo "<h1>".$u1->getNome()."</h1>";
echo "<h1>".$u1->getSenha()."</h1>";

echo "<h1>".$u2->getId()."</h1>";
echo "<h1>".$u2->getNome()."</h1>";
echo "<h1>".$u2->getSenha()."</h1>";

$c1 = new Contato(0,"Madoka","noreply@orkut.gov.com",1);
$c2 = new Contato(1,"Homura","yesreply@brazil.br.com",1);
echo "<h2>".$c1->getId()."</h2>";
echo "<h2>".$c1->getNome()."</h2>";
echo "<h2>".$c1->getEmail()."</h2>";
echo "<h2>".$c1->getUsuarioId()."</h2>";


echo "<h2>".$c2->getId()."</h2>";
echo "<h2>".$c2->getNome()."</h2>";
echo "<h2>".$c2->getEmail()."</h2>";
echo "<h2>".$c2->getUsuarioId()."</h2>";

$t1 = new Telefone(8,13,35671475,"Fixo",0);
$t2 = new Telefone(444,999,998745125,"Celular",1);
echo "<h2>".$t1->getId()."</h2>";
echo "<h2>".$t1->getDdd()."</h2>";
echo "<h2>".$t1->getNum()."</h2>";
echo "<h2>".$t1->getTipo()."</h2>";
echo "<h2>".$t1->getContatoId()."</h2>";


echo "<h2>".$t2->getId()."</h2>";
echo "<h2>".$t2->getDdd()."</h2>";
echo "<h2>".$t2->getNum()."</h2>";
echo "<h2>".$t2->getTipo()."</h2>";
echo "<h2>".$t2->getContatoId()."</h2>";

?>