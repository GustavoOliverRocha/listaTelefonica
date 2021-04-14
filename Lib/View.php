<?php
/**
 * Classe Responsavel por renderizar o HTML/Front-end/interface
 */
class View
{
    private $conteudo;
    private $htmlFile;
    private $dados;

    /**
     * O construtor receberá o nome do arquivo HTML a ser renderizado
     * que atribuirá ao atributos $htmlFile
     */
    function __construct($html = null)
    {
        if($html != null)
            $this->setHtmlFile($html);
    }

    /**
     * getConteudo() vai ser aquele que vai retonar literalmente o HTML como uma string nele
     * 
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
        else if(file_exists("Views/pagina404.phtml"))
            $this->htmlFile = "Views/pagina404.phtml"; 
        else
            throw new Exception("ERROR: Arquivo: $html não foi encontrado ou não existe.");
            
    }
    /**
     * getDados() vai conter os dados(array/vetor) enviados pelo Controller
     */
    public function getDados()
    {
        return $this->dados;
    }
    /**
     * Será setado o Array contendo os objetos
     */
    public function setDados(Array $v_dados)
    {
        $this->dados = $v_dados;
    }
    /**
     * Função onde a pagina será finalmente renderizada
     */
    public function mostrarPagina()
    {
        echo $this->getConteudo();
        exit;
    }

}
?>