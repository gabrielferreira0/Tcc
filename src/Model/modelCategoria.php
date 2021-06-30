<?php

require_once 'DBconexao.php';

class modelCategoria extends DBconexao
{
    private $categoria;
    private $fotoCategoria;
    private $status;
    private $banco;

    public function __construct()
    {
        $this->banco = new DBconexao();
    }


    public function setCategoria($categoria, $fotoCategoria, $status)
    {
        $this->categoria = $categoria;
        $this->fotoCategoria = $fotoCategoria;
        $this->status = $status;

        $sql = "insert into categorias(catnome,catfoto,catstatus) values ('$this->categoria','$this->fotoCategoria','$this->status');";
        $result = pg_query($this->banco->open(), $sql);
        return $result;

    }


    public function updateCategoria($idCategoria,$categoria,$fotoCategoria){

        $sql = "UPDATE categorias SET catnome = '{$categoria}',catfoto = '{$fotoCategoria}' WHERE id = {$idCategoria};";
        $result = pg_query($this->banco->open(), $sql);
        return $result;

    }

    public function getCategoria()
    {
        $sql = "select * from categorias where catstatus = 'True'order by id;";
        $result = pg_query($this->banco->open(), $sql);
        $dados = pg_fetch_all($result);

        return $dados;
    }

    public function setStatusCat($idCat, $status)
    {
        $sql = "UPDATE categorias SET catstatus = '{$status}' WHERE id = {$idCat};";
        $result = pg_query($this->banco->open(), $sql);
        return $result;
    }


    public function getAllCategoria()
    {
        $sql = "select *,
       (case
        when catstatus = 'True' then 'Ativo'
        when catstatus = 'False' then 'Desativado'
        end) as catstatus2
        from categorias  order by id;";
        $result = pg_query($this->banco->open(), $sql);
        $dados = pg_fetch_all($result);
        return $dados;
    }
}
