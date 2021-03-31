<?php
require_once "../Models/ConectaBanco.php";
class Contato extends ConectaBanco
{
    private $id_contato;
    private $st_nome;
    private $st_email;
    private $usuario_id;

    function __construct()
    {

    }

    public function getId()
    {
        return $this->id_contato;
    }
    public function setId($id)
    {
        $this->id_contato = $id;
    }

    public function getNome()
    {
        return $this->st_nome;
    }
    public function setNome($nm)
    {
        $this->st_nome = $nm;
    }

    public function getEmail()
    {
        return $this->st_email;
    }
    public function setEmail($em)
    {
        $this->st_email = $em;
    }

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }
    public function setUsuarioId($u_id)
    {
        $this->usuario_id = $u_id;
    }

    public function save()
    {
        if(is_null($this->id_contato))
        {
            $st_query = "INSERT INTO tb_contato(nm_contato,nm_email,fk_cd_usuario)VALUES('$this->st_nome','$this->st_email',$this->usuario_id);";
        }
        else
        {
            $st_query = "UPDATE tb_contato SET nm_contato = '$this->st_nome',nm_email = '".$this->st_email."' WHERE cd_contato = $this->id_contato;";
        }
        try
        {
            //A função exec alem de executar comando SQL ela também retorna o numero de linhas afetadas
            //Assim pode ser usar isso para verificar se realmente houve inserção no banco
            if($this->conectar()->exec($st_query) > 0)
            {
                echo "Criação/Atualização do Contato Sucesso";
                return true;
            }
            else
            {
                echo "ERROR: <br>0H 59 44 23 47 77";
                return false;
            }
            
        }
        catch(PDOException $e)
        {
            echo "ERROR: <br>".$e->getMessage();
        } 
        return false;
    }

    public function listarContatos()
    {
        //Vetor Usuarios
        $v_contatos = [];
        if(is_null($this->id_contato))
            $st_query = "SELECT * FROM tb_contato;";
        else 
            $st_query = "SELECT * FROM tb_contato WHERE cd_contato = $this->id_contato"; 

        try
        {
            //Pegando o retorno do bando
            $dados = $this->conectar()->query($st_query);
            while($retorno = $dados->fetchObject())
            {
                $c = new Contato();
                $c->setId($retorno->cd_contato);
                $c->setNome($retorno->nm_contato);
                $c->setEmail($retorno->nm_email);
                array_push($v_contatos,$c);
            }   
        }
        catch(PDOException $error)
		{}
        return $v_contatos;
    }

    public function loadById($id)
    {
        //$v_contatos = [];
        $st_query = "SELECT * FROM tb_contato WHERE cd_contato = $id";
        try
        {
            $dados = $this->conectar()->query($st_query);
            $retorno = $dados->fetchObject();
            $this->setId($retorno->cd_contato);
            $this->setNome($retorno->nm_contato);
            $this->setEmail($retorno->nm_email);
            return $this; 
        }
        catch(PDOException $error)
		{
            echo "ERROR: ";
        }
        return false;
    }


    public function deletar()
    {
        if(!is_null($this->id_contato))
        {
            
            $st_query = "DELETE FROM tb_contato WHERE cd_contato = $this->id_contato;";
            if($this->conectar()->exec($st_query) > 0)
                echo "Deletação completa";
        }
        echo "ERROR: 87 HG 55F 2DS";
        return false;
    }


}
?>