<?php
require_once "./Models/Telefone.php";
require_once "./Models/Contato.php";
require_once "./Lib/View.php";
//session_start();

class TelefoneController
{
    function __construct()
    {
        if(!Validador::isLogado())
            exit("ERROR: Você não está logado fi ".$_GET['metodo']);
    }
    public function listarTelefones()
    { 
        if(isset($_REQUEST['id_con']))
        {  
            $c = new Contato();
            $t = new Telefone();
            $v = new View("Views/listarTelefones.phtml");

            if(!$c->loadById($_REQUEST['id_con'],$_SESSION['id']))
                exit("ERROR: Tentado ver Telefones que não são seus, no metodo ".$_GET['metodo']);

            $v->setDados(array("telefones" => $t->listar($_REQUEST['id_con']),'contato' => $c));
        }
        else
            exit("ERROR: Sem id do contato ".$_GET['metodo']);
        $v->mostrarPagina();
    } 

    public function manterTelefone()
    {   
        $t = new Telefone();
        $c = new Contato();
        $v= new View("Views/registrarTelefones.phtml");
        
        if(isset($_REQUEST['id_con']))
            if(!$c->loadById($_REQUEST['id_con'],$_SESSION['id']))
                exit("ERROR: Tentado \"Manter\" algo que não é seu, no metodo ".$_GET['metodo']);
            
        if(isset($_REQUEST['id_tel']))
            $t->loadById($_REQUEST['id_tel'],$_REQUEST['id_con']);

        if(Validador::isLogado())
        {
            if(count($_POST) > 0)
            {   
                if(Validador::postTel())
                {
                    $t->setDdd(DadosFiltro::numerico($_POST['ddd_tel']));
                    $t->setNum(DadosFiltro::numerico($_POST['nr_tel']));
                    $t->setTipo($_POST['tp_tel']);
                    $t->setContatoId($_REQUEST['id_con']);
                    if($t->save())
                        Application::redirecionar("?controle=telefone&metodo=listarTelefones&id_con=".$_REQUEST['id_con']);
                    else    
                        exit("ERROR: no metodo ".$_GET['metodo']);
                }
                else
                    $v->setError("Campo não pode ficar vazio");
                
            }
        }
        $v->setDados(array("telefone" => $t,"contato" => $c));
        $v->mostrarPagina();
    }

    public function deletarTelefone()
    {
        $t= new Telefone();
        if(isset($_REQUEST['id_tel']))
        {
            if(!$t->loadById($_REQUEST['id_tel'],$_REQUEST['id_con']))
                exit("ERROR: Tentando deletar um telefone que não é seu, no metodo ".$_GET['metodo']);
            if($t->deletar())
                Application::redirecionar("?controle=telefone&metodo=listarTelefones&id_con=".$_REQUEST['id_con']);
            else    
                exit("ERROR: no metodo ".$_GET['metodo']);
        }
    }
}


?>