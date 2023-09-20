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

    static function dump_data($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit;
    }

    static function get_baseurl() {
        $protocol = 'http';
        
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            if (strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
                $protocol = 'https';
            }
        } elseif (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $protocol = 'https';
        }
        
        $host = $_SERVER['HTTP_HOST'];
        
        // Obter o caminho da pasta atual
        $currentPath = dirname($_SERVER['PHP_SELF']);
        
        // Concatenar o caminho da pasta com a URL base
        $baseUrl = $protocol . '://' . $host . $currentPath;
        
        return $baseUrl;
    }


}

?>