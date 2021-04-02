<?php
require_once './Models/Usuario.php';
class UsuarioController
{
    public function logarUsuario()
    {   $login = $_POST['login'];
        $senha = $_POST['senha'];
        $regis =[];
        $u = new Usuario();
        $dados = $u->loadByLogin($login,$senha);
        if($dados)
        {
            array_push($regis,$dados->getNome());
            array_push($regis,$dados->getSenha());
            echo "Login Serto";
            echo "Bem Viado ".$regis[0];
        }      
        else
            echo "Login errado";  
    }
}
?>