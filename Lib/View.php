<?php
class View
{
    private $conteudo;
    private $htmlFile;
    private $dados;

    function __construct($html = null/*, $v_dados = null*/)
    {
        if($html != null)
            $this->setHtmlFile($html);
        //$this->dados = $v_dados;
    }
    /**
     * ob_start() meio que impede que as coisas que você requeriu apareçam na tela
     * ob_get_contents() vai capturar todo o conteudo durante o ob_start()
    */
    public function getConteudo()
    {
        ob_start();
        if(isset($this->htmlFile))
            require_once $this->htmlFile;
        $this->conteudo = ob_get_contents();
        ob_end_clean();
        return $this->conteudo;
        
    }

    public function getHtmlFile()
    {
        return $this->htmlFile();
    }

    public function setHtmlFile($html)
    {
        if(file_exists($html))
            $this->htmlFile = $html;
        else   
            throw new Exception("Arquivo: $html não foi encontrado ou não existe.");
            
    }
    /**
     * Aqui ele vai receber os dados do Controller para exibir na pagina
     */
    public function getDados()
    {
        return $this->dados;
    }
    public function setDados(Array $v_dados)
    {
        $this->dados = $v_dados;
    }

    public function mostrarPagina()
    {
        echo $this->getConteudo();
        exit;
    }

}
?>