<?php
class Telefone
{
    private $id_tel;
    private $int_ddd;
    private $int_num;
    private $st_tipo;
    private $contato_id;

    function __construct($id,$ddd,$nr,$tp,$c_id)
    {
        $this->id_tel = $id;
        $this->int_ddd = $ddd;
        $this->int_num = $nr;
        $this->st_tipo = $tp;
        $this->contato_id = $c_id;
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
}
?>