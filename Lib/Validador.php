<?php
class Validador
{
    static function isLogado()
    {
        if(session_status() == 1)
            session_start();
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
            return true;
        session_unset();
        session_destroy();
        return false;
    }

    static function isNumeric($st)
    {
        $st = str_replace(",",'.',$st);
        if(!is_numeric($st))
            return false;    
        return true;
    }

    static function postTel()
    {
        if(strlen($_POST['ddd_tel']) > 0 && 
            strlen($_POST['nr_tel']) > 0 && 
            strlen($_POST['tp_tel']) > 0 && 
            !is_null($_POST['tp_tel']))
            return true;
        return false;
    }
    
    static function postCon()
    {
        if(strlen($_POST['nm_con']) > 0 && strlen($_POST['email_con']) > 0)
            return true;
        return false;
    }

    static function postUsuario()
    {
        if(strlen($_POST['u_nome']) > 0 && strlen($_POST['u_senha']) > 0 && strlen($_POST['c_senha']) > 0)
            return true;
    }

    static function manterInput($key,$obj)
    {
        if(array_key_exists($key, $_POST))
            return $_POST[$key];
        return $obj;
    }
}
?>