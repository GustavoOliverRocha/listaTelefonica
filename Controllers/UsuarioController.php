<?php
require_once './Models/Usuario.php';
require_once "./Lib/View.php";

class UsuarioController
{
    private $erros;
    function __construct()
    {
        $this->erros = false;
    }
    public function logarUsuario()
    {
        $o_view = new View("login.php");
        if(session_status() == 2)
        {
            session_start();
            if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
                Application::redirecionar("?controle=contato&metodo=listarContatos");
            else
                deslogar();
        }

        else if(isset($_POST['login'],$_POST['senha']))
        {
            if(strlen($_POST['login']) > 0 && strlen($_POST['senha']) > 0)
            {
                $u = new Usuario();
                $dados = $u->loadByLogin($_POST['login'],$_POST['senha']);
                if($dados)
                {   
                    session_start();
                    $_SESSION['id'] = $u->getId();
                    $_SESSION['usuario'] = $u->getNome();
                    $_SESSION['senha'] = $u->getSenha();
                    //header("Location: ?controle=contato&metodo=listarContatos");
                    Application::redirecionar("?controle=contato&metodo=listarContatos");
                    /*echo "Bem Viado ".$_SESSION['usuario']."<br>";
                    echo "Seu Id é: ".$_SESSION['id']."<br>";
                    echo "E sua senha é: ".$_SESSION['senha']."<br>";
                    return true;*/
                }      
                else
                {
                   /*var_dump($_POST['login']);
                    var_dump($_POST['senha']);
                    echo "SESSÕES: ".isset($_SESSION['login']);*/
                    echo "Login errado";
                    //$o_view->mostrarPagina(); 
                    
                }
     
            }
            else
            {
                unset($_POST);
                echo "Campo não pode ficar vazio.";
                $o_view->mostrarPagina(); 
            }
        }
        $o_view->mostrarPagina(); 
    }
    /**
     * Dica: sempre que for destruir uma sessão sempre inicia ela pois caso o contrario ele poderá destruir uma
     * sessão que nem existe
     */
    public function deslogar()
    {
        session_start();
        session_unset();
        session_destroy();
        session_register_shutdown ( );
        if(!isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']) && session_status()==1)
        {
            Application::redirecionar("index.php");
        }
        else    
            echo "ERROR: não deslogou as sessões estão".isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id'])."<br>".var_dump(session_status());
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

    /*public verificarLogin()
    {
        //if(isset($_REQUEST[]))
    }*/
}
?>