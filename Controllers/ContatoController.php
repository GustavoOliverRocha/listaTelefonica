<?php
require_once "./Models/Contato.php";
require_once "./Lib/View.php";

class ContatoController
{
    public function listarContatos()
    {   
        session_start();
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
        {
            $c = new Contato();
            $v = new View("op.php");
            $vetor_con = $c->listar($_SESSION['id']);
 
            if(sizeof($vetor_con) > 0)
            {
                /*foreach($vetor_con as $i)
                {
                    echo "ID: ".$i->getId()." Nome:&nbsp&nbsp&nbsp".$i->getNome()." E-mail:&nbsp&nbsp&nbsp".$i->getEmail()."<br>";
                }*/
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
}

?>