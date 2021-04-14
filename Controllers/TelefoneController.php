<?php
require_once "./Models/Telefone.php";
require_once "./Models/Contato.php";
require_once "./Lib/View.php";
session_start();
class TelefoneController
{
    public function listarTelefones()
    {  
        if(Validador::isLogado())
        {
            if(isset($_REQUEST['id_con']))
            {  
                $c = new Contato();
                $t = new Telefone();
                $v = new View("Views/listarTelefones.phtml");

                $c->loadById($_REQUEST['id_con'],$_SESSION['id']);
                $v->setDados(array("telefones" => $t->listar($_REQUEST['id_con']),'contato' => $c));
            }
        }
        else
            exit("ERROR: Você não está logado fi ".$_GET['metodo']);
        $v->mostrarPagina();
    } 

    public function manterTelefone()
    {   
        $t = new Telefone();
        $c = new Contato();
        $v= new View("Views/registrarTelefones.phtml");
        
        if(isset($_REQUEST['id_con']))
            $c->loadById($_REQUEST['id_con'],$_SESSION['id']);
        if(isset($_REQUEST['id_tel']))
            $t->loadById($_REQUEST['id_tel'],$_REQUEST['id_con']);

        if(Validador::isLogado())
        {
            if(count($_POST) > 0)
            {   
                if(strlen($_POST['ddd_tel']) > 0 && strlen($_POST['ddd_tel']) > 0 && strlen($_POST['tp_tel']) > 0)
                {
                    $t->setDdd($_POST['ddd_tel']);
                    $t->setNum($_POST['nr_tel']);
                    $t->setTipo($_POST['tp_tel']);
                    $t->setContatoId($_REQUEST['id_con']);
                    if($t->save())
                        Application::redirecionar("?controle=telefone&metodo=listarTelefones&id_con=".$_REQUEST['id_con']);
                    else    
                        exit("ERROR: no metodo ".$_GET['metodo']);
                }
                else
                    echo "Campo não pode ficar vazio";
                
            }
        }
        else
            exit("ERROR: Você não está logado fi ".$_GET['metodo']);
        $v->setDados(array("telefone" => $t,"contato" => $c));
        $v->mostrarPagina();
    }

    public function deletarTelefone()
    {
        $t= new Telefone();
        if(isset($_REQUEST['id_tel']))
        {
            $t->loadById($_REQUEST['id_tel'],$_REQUEST['id_con']);
            if($t->deletar())
                Application::redirecionar("?controle=telefone&metodo=listarTelefones&id_con=".$_REQUEST['id_con']);
            else    
                exit("ERROR: no metodo ".$_GET['metodo']);
        }

    }
}


?>