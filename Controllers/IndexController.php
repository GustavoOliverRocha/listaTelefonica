<?php
/**
 * Essas classes ela servirá para redirecionar o usuario
 * caso não tiver nada na URL
 * Se o usuario ja estiver logado ele vai pra listagem de Contatos
 * senão ele vai pra tela de login
 */
class IndexController
{
    public function indexRedirect()
    {
        session_start();
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
            header("Location: ?controle=contato&metodo=listarContatos");
        else
        {
            session_unset();
            session_destroy();
            header("Location: ?controle=usuario&metodo=logarUsuario");
        }

    }
}

?>