<?php
require_once './Models/Usuario.php';
require_once "./Lib/View.php";
class UsuarioController
{
    public function logarUsuario()
    {

        $o_view = new View("Views/logarUsuario.phtml");
        if(Validador::isLogado())
            Application::redirecionar("?controle=contato&metodo=listarContatos");
        
        $this->logar_com_cookie();

        if(count($_POST) > 0)
        {
            if(strlen($_POST['login']) > 0 && strlen($_POST['senha']) > 0)
            {
                $u = new Usuario();
                $dados = $u->loadByLogin($_POST['login'],$_POST['senha']);
                if($dados)
                {   
                    if(isset($_POST['lembre_se']) && $_POST['lembre_se']){
                        setcookie('__LISTA_TELEFONICA_LOGIN__',$_POST['login'],time() + (86400 * 365),'/');
                        setcookie('__LISTA_TELEFONICA_SENHA__',$_POST['senha'],time() + (86400 * 365),'/');
                    }else{
                        //('__LISTA_TELEFONICA_LOGIN__',$_POST['login'],time() + (86400 * 365),'/');
                        //setcookie('__LISTA_TELEFONICA_SENHA__',$_POST['senha'],time() + (86400 * 365),'/');                        
                    }
                    session_start();
                    $_SESSION['id'] = $u->getId();
                    $_SESSION['usuario'] = $u->getNome();
                    $_SESSION['senha'] = $u->getSenha();
                    Application::redirecionar("?controle=contato&metodo=listarContatos");
                }      
                else
                    $o_view->setError("Usuario ou Senha incorretos");
            }
            else
                $o_view->setError("Campo não pode ficar vazio.");
        }
        $o_view->mostrarPagina(); 
    }

    public function logar_com_cookie(){
        if(isset($_COOKIE['__LISTA_TELEFONICA_LOGIN__']) && strlen($_COOKIE['__LISTA_TELEFONICA_LOGIN__']) > 0 &&
            isset($_COOKIE['__LISTA_TELEFONICA_SENHA__']) && strlen($_COOKIE['__LISTA_TELEFONICA_SENHA__']) > 0
        ){
            $_POST['login'] = $_COOKIE['__LISTA_TELEFONICA_LOGIN__'];
            $_POST['senha'] = $_COOKIE['__LISTA_TELEFONICA_SENHA__'];
        }        
    } 
    /**
     * Dica: sempre que for destruir uma sessão sempre inicia ela pois caso o contrario ele poderá destruir uma
     * sessão que nem existe e dar erro
     */
    public function deslogar()
    {
        session_start();
        session_unset();
        session_destroy();
        session_register_shutdown();
        
        if(!Validador::isLogado() && session_status()==1)
            Application::redirecionar("index.php");
        else    
            exit("ERROR: não deslogou as sessões estão".isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id'])."<br>".var_dump(session_status()));
    }   

    public function cadastrarUsuario()
    {
        $o_view = new View("Views/cadastroUsuario.phtml");
        if(count($_POST) > 0)
        {
            if(Validador::postUsuario())
            {
                if(strcmp($_POST['u_senha'],$_POST['c_senha']) == 0)
                {
                    $u = new Usuario();
                    
                    if(!$u->loadByUsuario($_POST['u_nome']))
                    {
                        $u->setNome($_POST['u_nome']);
                        $u->setSenha($_POST['u_senha']);
                        if($u->save())
                            Application::redirecionar("?controle=usuario&metodo=logarUsuario"); 
                    } 
                    else
                        $o_view->setError("Nome de usuario ja cadastrado");
                }
                else
                    $o_view->setError("Senhas não batem");
            }
            else
                $o_view->setError("Campo não pode ficar vazio");
        }
        $o_view->mostrarPagina();
    }
}
?>