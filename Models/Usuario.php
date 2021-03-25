<?php 
class Usuario
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

}
?>