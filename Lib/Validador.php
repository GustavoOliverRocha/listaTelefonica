<?php
class Validador
{
    static function isLogado()
    {
        if(isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
            return true;
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
        if(strlen($_POST['ddd_tel']) > 0 && strlen($_POST['ddd_tel']) > 0 && strlen($_POST['tp_tel']) > 0)
            return true;
        return false;
    }
    
    static function postCon()
    {
        if(strlen($_POST['nm_con']) > 0 && strlen($_POST['email_con']) > 0)
            return true;
        return false;
    }

    static function manterInput($key,Array $vetor)
    {
        if(array_key_exists($key, $vetor))
                return $vetor[$key];
    }
}
?>