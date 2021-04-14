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
        if(Validador::isLogado())
            Application::redirecionar("?controle=contato&metodo=listarContatos");
        else
        {
            session_unset();
            session_destroy();
            Application::redirecionar("?controle=usuario&metodo=logarUsuario");
        }

    }
}

?>