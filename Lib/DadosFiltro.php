<?php
class DadosFiltro
{
    static function semPontos($dados)
    {
        $st = preg_replace("([[:punct:]]| )",'',$dados);
        return $st;
    }


    static function numerico( $dados )
	{
		$st = preg_replace("([[:punct:]]|[[:alpha:]]| )",'',$dados);
		return $st;	
	}

    static function semTag($dados)
    {
        return addcslashes(strip_tags($dados));
    }
}

?>