<?php
/**
 * Dica do PHP quando for declarar um atributo/variavel, da proxima vez que for usar ele coloca-se
 *  o $this->
 * Pois se vc colocar '$servidor' ja estando declarado la em cima ele pode interpretar como uma
 * variavel sendo criada novamente
*/
/**
 * Classe Abstrata ConectaBanco
 * serve para conectar ao banco de dados
 * ela não poderá ser instanciada só as classes do Model irão acessar ela
 */
abstract class ConectaBanco
{   
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "db_listacontatos";
    private $con;
    protected $st_query;

    protected function conectar()
    {
        try
        {
            $this->con = new PDO("mysql:host=$this->servidor;dbname=$this->banco",$this->usuario,$this->senha);
            return $this->con;
        }
        catch(PDOException $error)
        {
            echo "ERROR: Conexão falhou <br>" . $error->getMessage();
        }
    }
}

?>