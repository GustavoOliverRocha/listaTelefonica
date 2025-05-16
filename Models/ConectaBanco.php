<?php
/**
 * Realiza a conexão com o banco de dados, essa classe não poderá ser instanciada só as classes do Model irão acessar ela
 */
abstract class ConectaBanco
{   
    private string $servidor = DB_HOST;
    private string $banco = DB_NAME;
    private string $usuario = DB_USER;
    private string $senha = DB_PASSWORD;
    private $con;
    protected $st_query;

    protected function conectar()
    {
        try{
            $this->con = new PDO("mysql:host=$this->servidor;dbname=$this->banco",$this->usuario,$this->senha);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $this->con;
        } catch(PDOException $e){
            die('Falha na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    protected function query($sql)
    {
        $data = null;
        try{
            $res = $this->conectar()->prepare($sql);
            $res->execute();
            $data = $res->fetchAll(PDO::FETCH_OBJ);
        }
        catch(PDOException $error){
            echo "<pre>";
            echo 'SQL ERROR: '.$error->errorInfo[2].'<br>';
            print_r($error);exit;
            echo "ERROR: <br>".$error->getMessage();
        }
        return $data;
    }

}

?>