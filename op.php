<?php

$v_dados = $this->getDados();
$v_contatos = $v_dados['contatos'];
foreach($v_contatos as $i)
{
    echo $i->getNome();
}
?>