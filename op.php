<?php
var_dump(session_status());
$v_dados = $this->getDados();
$v_contatos = $v_dados['contatos'];
foreach($v_contatos as $i)
{
    echo $i->getNome();
    echo $i->getEmail();
    echo "<a href=\"index.php?controle=contato&metodo=deletar&id_con=".$i->getId()."\">Deletar</a><br><br>";
}

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
    <a href="index.php?controle=usuario&metodo=deslogar">Sair</a>
    <a href="index.php?controle=usuario&metodo=deslogar">Inserir</a>
</body>
</html>