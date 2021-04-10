<?php
require_once "./Models/Telefone.php";
require_once "./Lib/View.php";
session_start();
class TelefoneController
{
    public function listarTelefones()
    {  
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
        {
            if(isset($_REQUEST['id_con']))
            {
                $t = new Telefone();
                $v = new View("Views/listarTelefones.phtml");
                $v->setDados(array("telefones" => $t->listar($_REQUEST['id_con'])));
            }
        }
        else
            echo "ERROR: Você não está logado fi";
        $v->mostrarPagina();
    } 

    public function manterTelefones()
    {   
        $t = new Telefone();
        $v= new View("Views/registrarTelefones.phtml");
        
        if(isset($_REQUEST['tel_id']))
            $c->loadById($_REQUEST['tel_id']);

        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
        {
            if(isset($_POST['nm_con'],$_POST['email_con']))
            {
                $c->setNome($_POST['nm_con']);
                $c->setEmail($_POST['email_con']);
                $c->setUsuarioId($_SESSION['id']);
                if($c->save())
                    Application::redirecionar("?controle=contato&metodo=listarContatos");
                else    
                    echo "ERROR";
            }
        }
        $v->setDados(array("telefone" => $t));
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