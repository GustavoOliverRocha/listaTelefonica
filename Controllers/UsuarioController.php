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

    public function login_google(){
function http_post($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function http_get($url, $data) {
    $url = $url . '?' . http_build_query($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

        // Configurações
        $client_id = '679388257467-hgt6d8kaaiug7n523u4g8qt4vcs89mrb.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = DadosFiltro::get_baseurl().'/?controle=usuario&metodo=login_google';
        $auth_url = 'https://accounts.google.com/o/oauth2/auth';
        $token_url = 'https://accounts.google.com/o/oauth2/token';
        $user_info_url = 'https://www.googleapis.com/oauth2/v1/userinfo';

        // Etapa 1: Redirecionar o usuário para o Google para autenticação
        if (!isset($_GET['code'])) {
            $auth_params = array(
                'response_type' => 'code',
                'client_id' => $client_id,
                'redirect_uri' => $redirect_uri,
                'scope' => 'https://www.googleapis.com/auth/userinfo.email',
                'approval_prompt' => 'force', // Forçar a autenticação novamente
                'access_type' => 'offline' // Solicitar um token de atualização
            );

            $auth_url = $auth_url . '?' . http_build_query($auth_params);
            header('Location: ' . $auth_url);
            exit;
        }

        // Etapa 2: Trocar o código de autorização por um token de acesso
        if (isset($_GET['code'])) {
            $token_params = array(
                'code' => $_GET['code'],
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri' => $redirect_uri,
                'grant_type' => 'authorization_code'
            );

            $token_response = http_post($token_url, $token_params);
            $token_data = json_decode($token_response, true);
            DadosFiltro::dump_data($token_response);
            if (isset($token_data['access_token'])) {
                // Etapa 3: Obter informações do perfil do usuário
                $user_info_response = http_get($user_info_url, array('access_token' => $token_data['access_token']));
                $user_info = json_decode($user_info_response, true);

                if (isset($user_info['email'])) {
                    // O usuário está autenticado com sucesso
                    echo 'ID: ' . $user_info['id'] . '<br>';
                    echo 'Nome: ' . $user_info['name'] . '<br>';
                    echo 'Email: ' . $user_info['email'] . '<br>';
                } else {
                    echo 'Falha ao obter informações do perfil do usuário.';
                }
            } else {
                echo 'Falha ao obter o token de acesso.';
            }
        }

    }

}
?>