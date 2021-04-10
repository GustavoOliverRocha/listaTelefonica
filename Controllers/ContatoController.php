<?php
require_once "./Models/Contato.php";
require_once "./Lib/View.php";
/**
 * Tirando o UsuarioController todas as classes controllers
 * começarão com o session_start() para carregar os dados do login
 * pois afinal elas só estão disponiveis depois de logado
 */
session_start();
class ContatoController
{
    public function listarContatos()
    {  
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
        {
            $c = new Contato();
            $v = new View("op.php");
            $vetor_con = $c->listar($_SESSION['id']);
            $v->setDados(array("contatos" => $vetor_con));
            $v->mostrarPagina();
        }
        else
        {
            echo "ERROR: Você não está logado fi";
        }
    } 

    public function manterContato()
    { 
        $c= new Contato();
        $v= new View("Views/registrarContatos.phtml");
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
        {
            if(isset($_REQUEST['id_con']))
                $c->loadById($_REQUEST['id_con']);  
            if(isset($_POST['nm_con'],$_POST['email_con']))
            {
                $c->setNome($_POST['nm_con']);
                $c->setEmail($_POST['email_con']);
                $c->setUsuarioId($_SESSION['id']);
                if($c->save())
                    Application::redirecionar("?controle=contato&metodo=listarContatos");
            }
        }
        
        $v->setDados(array("contatos" => $c));
        $v->mostrarPagina();
    }

    public function deletarContato()
    {
        $c= new Contato();
        if(isset($_REQUEST['id_con']))
        {
            $c->loadById($_REQUEST['id_con']);
            if($c->deletar())
                Application::redirecionar("?controle=contato&metodo=listarContatos");
            else    
                echo "ERROR: 87 HG 55F 2DS";
        }

    }
}

?>