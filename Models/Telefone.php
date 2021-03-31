<?php
require_once "../Models/ConectaBanco.php";
class Telefone extends ConectaBanco
{
    private $id_tel;
    private $int_ddd;
    private $int_num;
    private $st_tipo;
    private $contato_id;

    function __construct()
    {
    }

    public function getId()
    {
        return $this->id_tel;
    }
    public function setId($id)
    {
        $this->id_tel = $id;
    }

    public function getDdd()
    {
        return $this->int_ddd;
    }
    public function setDdd($ddd)
    {
        $this->int_ddd = $ddd;
    }

    public function getNum()
    {
        return $this->int_num;
    }
    public function setNum($nr)
    {   
        $this->int_num = $nr;
    }

    public function getTipo()
    {
        return $this->st_tipo;
    }
    public function setTipo($tp)
    {
        $this->st_tipo = $tp;
    }

    public function getContatoId()
    {
        return $this->contato_id;
    }
    public function setContatoId($c_id)
    {
        $this->contato_id = $c_id;
    }

    public function save()
    {
        if(is_null($this->id_tel)) 
            $st_query = "INSERT INTO tb_tel(ddd_tel,nr_tel,tp_tel,fk_cd_contato)VALUES($this->int_ddd,$this->int_num,'$this->st_tipo',$this->contato_id);";
        else
            $st_query = "UPDATE tb_tel set ddd_tel = $this->int_ddd, nr_tel = $this->int_num, tp_tel = '$this->st_tipo' WHERE cd_tel = $this->id_tel;";
        try
        {
            if($this->conectar()->exec($st_query)>0)
            {
                echo "Telefone salvo com Sucesso";
                return true;
            }
            else
            {
                echo "ERR";
                return false;
            }
        }
        catch(PDOException $error)
        {
            echo "ERROR: 8H 4G 5F 66 47 RR";
            return false;
        }
    }

    public function listarTelefone($id_contato)
    {
        if(is_null($id_contato))
            $st_query = "SELECT * FROM tb_tel;";
        else 
            $st_query = "SELECT * FROM tb_tel WHERE fk_cd_contato = $id_contato;"; 
        //Vetor Usuarios
        $v_tel = [];
        try
        {
            //Pegando o retorno do bando
            $dados = $this->conectar()->query($st_query);
            while($retorno = $dados->fetchObject())
            {
                $t = new Telefone();
                $t->setId($retorno->cd_tel);
                $t->setDdd($retorno->ddd_tel);
                $t->setNum($retorno->nr_tel);
                $t->setTipo($retorno->tp_tel);
                $t->setContatoId($retorno->fk_cd_contato);
                array_push($v_tel,$t);
            }  
        }
        catch(PDOException $error)
		{}
        return $v_tel;
    }

    public function loadById($id)
    {
        $st_query = "SELECT * FROM tb_tel WHERE cd_tel = $id";
        try
        {
            $dados = $this->conectar()->query($st_query);
            $retorno = $dados->fetchObject();
            $this->setId($retorno->cd_tel);
            $this->setDdd($retorno->ddd_tel);
            $this->setNum($retorno->nr_tel);
            $this->setTipo($retorno->tp_tel);
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
        if(!is_null($this->id_tel))
        {
            $st_query = "DELETE FROM tb_tel WHERE cd_tel = $this->id_tel;";
            if($this->conectar()->exec($st_query) > 0)
            {
                echo "Deletação completa";
                return true;
            }

        }
        echo "ERROR: 87 HG 55F 2DS";
        return false;
    }

}
?>