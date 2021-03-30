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
        $this->setSenha($se);
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
        $this->st_senha =sha1($s,true);
    }
    /**
     * Metodo de Criar e Alterar
     * Caso a $id_usuario seja nula ele vai dar um insert no banco
     * caso tenha um id setado ele vai alterar
     */
    public function save()
    {
        if(is_null($this->id_usuario))
        {
            $st_query = "INSERT INTO tb_usuario(nm_usuario,pw_usuario)VALUES('".$this->st_nome."','".$this->getSenha()."')";
        }
        else
        {
            $st_query = "UPDATE tb_usuario SET nm_usuario = '$this->st_nome',pw_usuario = '".$this->getSenha()."' WHERE cd_usuario = $this->id_usuario;";
        }
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

    public function deletar()
    {
        if(!is_null($this->id_usuario))
        {
            $st_query = "DELETE FROM tb_usuario WHERE cd_usuario = $this->id_usuario";
            if($this->conectar()->exec($st_query) > 0)
                return true;
        }
        return false;
    }

    public function listarUsuarios()
    {
        //Vetor Usuarios
        $v_usuarios = [];
        $st_query = "SELECT * FROM tb_usuario;";
        try
        {
            $dados = $this->conectar()->query($st_query);
            while($retorno = $dados->fetchObject())
            {
                $u = new Usuario();
                $u->setId($retorno->cd_usuario);
                $u->setId($retorno->nm_usuario);
                $u->setId($retorno->pw_usuario);
                array_push($v_usuarios,$u);
            }   
        }
        catch(PDOException $error)
		{}
        return $v_usuarios;
    }

    public function loadById($id)
    {
        $st_query = "SELECT * FROM tb_contato WHERE fk_cd_usuario = $id";
        $dados = $this->conectar()->query($st_query);
        $retorno = $dados->fetchAll();
        var_dump($retorno);
    }
}
?>