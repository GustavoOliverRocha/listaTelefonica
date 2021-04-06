<?php
require_once './Models/Usuario.php';
class UsuarioController
{
    public function logarUsuario()
    {
        if(isset($_POST['login'],$_POST['senha']))
        {
            $u = new Usuario();
            $dados = $u->loadByLogin($_POST['login'],$_POST['senha']);
            if($dados)
            {
                session_start();
            //  array_push($regis,$dados->getNome());
            //  array_push($regis,$dados->getSenha());
                echo "Login Serto ".$u->getSenha()." ".$u->getId();
                echo "Bem Viado ".$u->getNome();
                
                $_SESSION['id'] = $u->getId();
                $_SESSION['usuario'] = $u->getNome();
                $_SESSION['senha'] = $u->getSenha();
                
                echo $_SESSION['id'];
            }      
            else
            var_dump($_POST['login']);
            var_dump($_POST['senha']);
                echo "Login errado";  
        }
        else
            echo "ERROR:";
            
    }

    public function deslogar()
    {
        if(!is_null($_SESSION['usuario']) && !is_null($_SESSION['senha']))
        {
            session_unset();
            session_destroy();
        }
        else
            echo "ERROR";
    }

    public function cadastrarUsuario()
    {
        
        if(isset($_POST['login'], $_POST['senha']))
        {
            $u = new Usuario();
            if(!$u->loadByUsuario($_POST['login']))
            {
                $u->setNome($_POST['login']);
                $u->setSenha($_POST['senha']);
                $u->save(); 
            }
            else
            {
                echo "<h1>ERROR:</h1><br>Nome de Usuario Já existente";
            }
        }
    }
}
?>