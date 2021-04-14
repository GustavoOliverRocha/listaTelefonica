<?php
if(file_exists("Lib/Validador.php"))
    require_once "Lib/Validador.php";

class Application
{
    //Atributo terá o nome do Controller
    protected $rotaController;

    //E esse o nome do metodo
    protected $rotaMetodo;

    /**
     * servirá para capturar o nome do Controller e o Metodo que serão passados na URL
     * via GET
     */
    private function rota()
    {
        /**
         * Operador ternario- condição ?(então) coisa :(senão) outra coisa
         * Se a variavel $_REQUEST['controle'] for setada pela URL(true)
         * então ela será igual a $_REQUEST['controle'] senão será igual a 'index'
         */
        $this->rotaController = isset($_REQUEST['controle']) ? $_REQUEST['controle'] : 'index';
        $this->rotaMetodo = isset($_REQUEST['metodo']) ? $_REQUEST['metodo'] : 'indexRedirect';
    }

    /**
     * Metodo responsavel por "renderizar" o controller da respectiva classe
     * acessando as classes Controllers e acionando seus metodos
     * Tudo isso através da URL
     */
    public function importarController()
    {
        $this->rota();
        $controllerFile = 'Controllers/'.ucfirst($this->rotaController)."Controller.php";
        $classe = $this->rotaController."Controller";
        $metodo = $this->rotaMetodo;

        if(file_exists($controllerFile))
            require_once $controllerFile;
        else   
            $this->err404("Arquivo $controllerFile não encontrado ou existente.");//throw new Exception("Arquivo $controllerFile não encontrado ou existente.");

        if(class_exists($classe))
            $c = new $classe;
        else   
            $this->err404("Classe $classe não encontrada ou existente.");//throw new Exception("Classe $classe não encontrada ou existente.  ");
        
        if(method_exists($classe,$metodo))
            $c->$metodo();
        else
            $this->err404("Metodo $metodo não encontrado ou existente.");//throw new Exception("Metodo $metodo não encontrado ou existente.");

    }
    
    public function err404($msg)
    {
        if(file_exists("./Lib/View.php"))
            require_once "./Lib/View.php";
        $v = new View("Views/pagina404.phtml");
        echo $msg;
        $v->mostrarPagina();
    }

    public function redirecionar($url)
    {
        header("Location: $url");
    }
}
?>