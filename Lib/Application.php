<?php

class Application
{
    protected $rotaController;
    protected $rotaMetodo;
    public function rota()
    {
        //Se a variavel $_REQUEST['controle'] for setada então ela será igual a $_REQUEST['controle'] senão será index
        $this->rotaController = isset($_REQUEST['controle']) ? $_REQUEST['controle'] : 'index';
        $this->rotaMetodo = isset($_REQUEST['metodo']) ? $_REQUEST['metodo'] : 'indexRedirect';
    }

    public function importarController()
    {
        $this->rota();
        $controllerFile = 'Controllers/'.ucfirst($this->rotaController)."Controller.php";
        $classe = $this->rotaController."Controller";
        $metodo = $this->rotaMetodo;

        if(file_exists($controllerFile))
            require_once $controllerFile;
        else   
            throw new Exception("Arquivo $controllerFile não encontrado ou existente.  ");

        if(class_exists($classe))
            $c = new $classe;
        else   
            throw new Exception("Classe $classe não encontrada ou existente.  ");
        
        if(method_exists($classe,$metodo))
            $c->$metodo();
        else
            throw new Exception("Metodo $metodo não encontrado ou existente.  ");

    }

    public function redirecionar($url)
    {
        header("Location: $url");
    }
}
?>