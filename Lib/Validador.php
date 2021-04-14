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

    static function temPost($st)
    {
        if(isset($_POST[$st]))
            if(strlen($_POST[$st]) > 0)
                return true;
        return false;
    }
}
?>