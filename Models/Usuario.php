<?php 
require_once "ConectaBanco.php";
class Usuario extends ConectaBanco
{
    private $id_usuario;
    private $st_nome;
    private $st_senha;

    function __construct($id,$nm,$se)
    {
        $this->id_usuario = $id;
        $this->st_nome = $nm;
        $this->st_senha = $se;
    }

    public function getId()
    {
        return $this->id_usuario;           
    }
    public function setId($id)
    {
        $this->id_usuario = $id;
    }

    public function getNome()
    {
        return $this->st_nome;
    }
    public function setNome($nm)
    {
        $this->st_nome = $nm;       
    }

    public function getSenha()
    {
        return $this->st_senha;
    }
    public function setSenha($s)
    {
        $this->st_senha = $s;
    }
    
    public function save()
    {
        $st_query = "insert into tb_usuario(nm_usuario,pw_usuario)values('".$this->st_nome."','".$this->st_senha."')";
        try
        {
            //A função exec alem de executar comando SQL ela também retorna o numero de linhas afetadas
            //Assim pode ser usar isso para verificar se realmente houve inserção no banco
            if($this->conectar()->exec($st_query) > 0)
            {
                echo "inserção com Sucesso";
            }
            else
            {
                echo "ERROR: <br>0H 59 44 23 47 77";
            }
            
        }
        catch(PDOException $e)
        {
            echo "ERROR: <br>".$e->getMessage();
        } 

            
        
    }
}
?>