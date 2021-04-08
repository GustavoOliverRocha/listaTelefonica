<?php
require_once './Models/Usuario.php';
require_once "./Lib/View.php";
class UsuarioController
{
    public function logarUsuario()
    {
        session_start();
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
            header("Location: ?controle=contato&metodo=listarContatos");
        else if(isset($_POST['login'],$_POST['senha']))
        {
            $u = new Usuario();
            $dados = $u->loadByLogin($_POST['login'],$_POST['senha']);
            if($dados)
            {   
                $_SESSION['id'] = $u->getId();
                $_SESSION['usuario'] = $u->getNome();
                $_SESSION['senha'] = $u->getSenha();
                header("Location: ?controle=contato&metodo=listarContatos");
                /*echo "Bem Viado ".$_SESSION['usuario']."<br>";
                echo "Seu Id é: ".$_SESSION['id']."<br>";
                echo "E sua senha é: ".$_SESSION['senha']."<br>";
                return true;*/
            }      
            else
            {
               var_dump($_POST['login']);
                var_dump($_POST['senha']);
                echo "Login errado"; 
                echo "SESSÕES: ".isset($_SESSION['login']);
            }
 
        }
            $o_view = new View("logar.php");
            $o_view->mostrarPagina(); 
    }
    /**
     * Dica: sempre que for destruir uma sessão sempre inicia ela pois caso o contrario ele poderá destruir uma
     * sessão que nem existe
     */
    public function deslogar()
    {   session_start();
        session_unset();
        session_destroy();
        if(!isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
            echo "Deslogado com Sucesso";
        else    
            echo "ERROR: não deslogou ".$_SESSION['usuario'].$_SESSION['senha'].$_SESSION['id'];
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