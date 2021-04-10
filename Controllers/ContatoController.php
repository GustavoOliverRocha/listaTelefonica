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
 
            if(sizeof($vetor_con) > 0)
            {
                $v->setDados(array("contatos" => $vetor_con));
                $v->mostrarPagina();
            }
            else
                echo "Não há contatos registrados";

        }
        else
        {
            echo "ERROR: Você não está logado fi";
        }
    } 

    public function manterContatos()
    {   $c= new Contato();
        if(isset($_POST['nome_con'],$_POST['email_con']))
        {
            if(isset($_REQUEST['id_con']))
                $c->loadById($_REQUEST['id_con']);
            $c->setNome($_POST['nome_con']);
            $c->setEmail($_POST['email_con']);
            if($c->save())
                Application::redirecionar("?controle=contato&metodo=listarContatos");
            
        }
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