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

        $sql = "insert into categorias(catnome,catfoto,catstatus) values ('$this->categoria','$this->fotoCategoria','$this->status')  RETURNING id;";

        $result = pg_query($this->banco->open(), $sql);
        $id[0] = pg_fetch_row($result);


        return $id[0];

    }

    public function setServicos($id, $nome)
    {
        $sql = "insert into servicos (catid,sernome,serstatus) values ($id,'$nome',true);";
        $result = pg_query($this->banco->open(), $sql);
        return $id;
    }

    public function updateCategoria($idCategoria, $categoria, $fotoCategoria)
    {

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


    public function getServicos($idCategoria)
    {

        $usuid = intval($_SESSION['id']);
        $sql = "select ser.*
                from servicos ser
                inner join categorias cat on ser.catid = cat.id
                where catid = {$idCategoria} and serstatus = true and ser.id
                not in (select serid from servico_profissional where usuid = {$usuid});";


        $result = pg_query($this->banco->open(), $sql);

        if ($result) {
            $dados = pg_fetch_all($result);
            return $dados;
        } else {
            return 'Não foi possivel realizar a consulta';
        }

    }


    public function getAllServicos($nomeCategoria)
    {


        $sql = "select ser.*,catfoto
                from servicos ser 
                inner join categorias cat on cat.id = ser.catid 
                where  cat.catnome ilike '%$nomeCategoria%';";


        $result = pg_query($this->banco->open(), $sql);

        if ($result) {
            $dados = pg_fetch_all($result);
            return $dados;
        } else {
            return 'Não foi possivel realizar a consulta';
        }
    }

    public function tableServicos($categoria, $servicoID = null)
    {

if ($servicoID) {
    $servicoID = " and ser.id = $servicoID";
}

        $sql = "select usu.usunome as nome_Profissional,usuid as id_Profissional,
       catid as id_Categoria,sp.serid as id_Servico ,
       sp.id as servico_profissional_ID,
       sp.preco,'4.0' as nota,ser.sernome,
        (case
        when sp.status = 'True' then 'Ativo'
        when sp.status = 'False' then 'Desativado'
        end) as status
    from servico_profissional sp
    inner join  usuarios usu on sp.usuid = usu.id
    inner join  servicos ser on sp.serid = ser.id
    inner join categorias cat on cat.id = ser.catid
    where cat.catnome ilike '%$categoria%' and sp.status = true" . $servicoID .";";



        $result = pg_query($this->banco->open(), $sql);

        $result = pg_query($this->banco->open(), $sql);
        $dados = pg_fetch_all($result);


        if ($dados) {
            return $dados;
        } else {
            return false;
        }

    }


    public function servico_profissional($usuid, $idServico, $preco)
    {
        $sql = "insert into servico_profissional (usuid,serid,status,preco) values ($usuid,$idServico,true,$preco);";
        $result = pg_query($this->banco->open(), $sql);
        return $result;
    }
}
