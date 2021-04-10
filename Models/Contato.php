<?php
require_once "ConectaBanco.php";
class Contato extends ConectaBanco
{
    /**
     * Atributos
     */
    private $id_contato;
    private $st_nome;
    private $st_email;
    private $usuario_id;

    function __construct()
    {

    }
    /**
     * Metodos Especiais
     */
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

    /**
     * save(): Servirá para inserir ou alterar os dados do contato
     * se caso o atributo $id for nulo ele irá fazer uma inserção
     * caso contrario ele fará uma alteração ja que o metodo sabe quem é
     */
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
            /**
             * A função exec() alem de executar o comando SQL ela também retorna o numero de linhas afetadas
             * Assim pode-se usar isso para verificar se realmente houve inserção no banco
             */
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
    /**
     * Metodo listar(param)
     * serve para mostrar os Contatos de acordo com o id do Usuario
     * Retornará um array contendo um objeto para cada linha do banco que foi retornada
     * Então o Id,Nome e Email(juntos) de cada contato estarão tudo em cada vetor
     */
    public function listar($id)
    {
        //Vetor Usuarios
        $v_contatos = [];
        $st_query = "SELECT * FROM tb_contato WHERE fk_cd_usuario = $id"; 

        try
        {
            /**
             * O fetchObject() ele retorna os dados do banco como objeto
             * Recebendo os dados do banco como objeto
             * caso não haja nada na requisição ele retornará false
             */
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

    /**
     * loadById(param)
     * essa função vai servir para carregar os dados de um contato em especifico
     * muito util para fazer deletes e...
     */
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
                return true;
        }
        //echo "ERROR: 87 HG 55F 2DS";
        return false;
    }


}
?>