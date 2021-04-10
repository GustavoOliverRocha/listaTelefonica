<?php
require_once './Models/Usuario.php';
require_once "./Lib/View.php";

class UsuarioController
{

    public function logarUsuario()
    {
        $o_view = new View("Views/logarUsuario.phtml");
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
                    Application::redirecionar("?controle=contato&metodo=listarContatos");
                }      
                else
                    echo "Login errado";
     
            }
            else
            {
                echo "Campo não pode ficar vazio.";
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
        $o_view = new View("Views/cadastroUsuario.phtml");
        if(isset($_POST['nm_usuario'], $_POST['senha_usuario'], $_POST['senha_confi']))
        {
            $u = new Usuario();
            
            if(isset($_REQUEST['id']))
                $u->setId($_REQUEST['id']);

            if(!$u->loadByUsuario($_POST['nm_usuario']))
            {
                $u->setNome($_POST['nm_usuario']);
                $u->setSenha($_POST['senha_usuario']);
                if($u->save())
                    Application::redirecionar("?controle=usuario&metodo=logarUsuario"); 
            } 
            else
            {
                echo "<h1>ERROR:</h1><br>Nome de Usuario Já existente";
            }
        }
        $o_view->mostrarPagina();
    }

    /*public verificarLogin()
    {
        //if(isset($_REQUEST[]))
    }*/
}
?>