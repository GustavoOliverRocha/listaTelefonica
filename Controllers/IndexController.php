<?php

class IndexController
{
    public function indexRedirect()
    {
        session_start();
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
            header("Location: ?controle=contato&metodo=listarContatos");
        else
            header("Location: ?controle=usuario&metodo=logarUsuario");
    }
}

?>