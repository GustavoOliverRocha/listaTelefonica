<?php
require_once "./Models/Contato.php";
require_once "./Models/Telefone.php";
require_once "./Lib/View.php";

/**
 * Tirando o UsuarioController todas as classes controllers
 * começarão com o session_start() para carregar os dados do login
 * pois afinal elas só estão disponiveis depois de logado
 */
//session_start();
class ContatoController
{
    function __construct()
    {
        if(!Validador::isLogado())
            exit("ERROR: Você não está logado fii ".$_GET['metodo']);
    }

    public function listarContatos()
    {
        $c = new Contato();
        $v = new View("Views/listarContatos.phtml");
        $v->setDados(array("contatos" => $c->listar($_SESSION['id'])));      
        $v->mostrarPagina();
    } 

    public function manterContatos()
    {   
        $c = new Contato();
        $v = new View("Views/registrarContatos.phtml");
        if(isset($_REQUEST['id_con']))
            $c->loadById($_REQUEST['id_con'],$_SESSION['id']);

        if(Validador::isLogado())
        {
            if(count($_POST) > 0)
            {
                if(Validador::postCon())
                {
                    $c->setNome($_POST['nm_con']);
                    $c->setEmail($_POST['email_con']);
                    $c->setUsuarioId($_SESSION['id']);
                    if($c->save())
                        Application::redirecionar("?controle=contato&metodo=listarContatos");
                    else    
                        exit("ERROR: Contato não criado/atualizado no método ".$_GET['metodo']);
                }
                else
                    $v->setError("Campo não pode ficar vazio");
                    
            }
        }  
        $v->setDados(array("contatos" => $c));
        $v->mostrarPagina();
    }

    public function deletarContato()
    {
        $c = new Contato();
        $t = new Telefone();
        if(isset($_REQUEST['id_con']))
        {  
            if(!$c->loadById($_REQUEST['id_con'],$_SESSION['id']))
                exit("ERROR: Tentando deletar algo que não é seu, no método ".$_GET['metodo']);

            $v_tel = $t->listar($_REQUEST['id_con']);
            foreach($v_tel as $t)
                $t->deletar();

            if($c->deletar())
                Application::redirecionar("?controle=contato&metodo=listarContatos");
            else    
                exit("ERROR: Contato não deletado, no método ".$_GET['metodo']);
        }

    }
}

?>