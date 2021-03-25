<?php
class Contato
{
    private $id_contato;
    private $st_nome;
    private $st_email;
    private $usuario_id;

    function __construct($i,$n,$e,$ui)
    {
        $this->id_contato = $i;
        $this->st_nome = $n;
        $this->st_email = $e;
        $this->usuario_id = $ui;
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
}
?>