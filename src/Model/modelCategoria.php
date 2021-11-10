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

    public function tableServicos($categoria, $servicoID = null, $UF = null)
    {

        if ($servicoID) {
            $servicoID = " and ser.id = $servicoID";
        }
        if ($UF) {
            $UF = " and ep.uf = '$UF'";
        }

//        $sql = "select usu.usunome as nome_Profissional,usu.id as id_Profissional,
//       catid as id_Categoria,sp.serid as id_Servico , sp.id as servico_profissional_ID,
//       sp.preco,'5.0' as nota,ser.sernome,
//        ep.cidade as cidade, ep.uf as UFs
//from servico_profissional sp
//    inner join usuarios usu on sp.usuid = usu.id
//    inner join servicos ser on sp.serid = ser.id
//    inner join categorias cat on cat.id = ser.catid
//    inner join endereco_profissional ep on usu.id = ep.usuid
//where cat.catnome ilike '%$categoria%' and sp.status = true" . $servicoID . $UF . ";";


        $sql = "select distinct
       usu.usunome as nome_Profissional,usu.id as id_Profissional, catid as id_Categoria,sp.serid as id_Servico ,
       sp.id as servico_profissional_ID, sp.preco,ser.sernome, ep.cidade as cidade, ep.uf as UFs,
                case
        when trunc(avg(avaliacao_servico),1) is null then 0
        else trunc(avg(avaliacao_servico),1)
                end as nota
from servico_profissional sp
    inner join usuarios usu on sp.usuid = usu.id
    inner join servicos ser on sp.serid = ser.id
    inner join categorias cat on cat.id = ser.catid
    inner join endereco_profissional ep on usu.id = ep.usuid
    left join
	(select *
		from cliente_servico_profissional CSP
		where CSP.status = 'Finalizado') as CSP
	on CSP.servico_profissionalid = sp.id
where cat.catnome ilike '%$categoria%' and sp.status = true " . $servicoID . $UF . "
group by usu.usunome, usu.id, catid, sp.serid, sp.id, sp.preco, ser.sernome, ep.cidade, ep.uf;
";


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

    public function getServico_profissional($id)
    {

//        $sql = "select catnome,sernome,usunome,usutelefone,usuemail,sp.preco,usu.usufoto,ende.cidade,ende.UF
//        from servico_profissional  sp
//        inner join usuarios usu on usu.id = sp.usuid
//        inner join endereco_profissional ende on usu.id = ende.usuid
//        inner join servicos ser on ser.id = sp.serid
//        inner join categorias cat on cat.id = ser.catid
//    where sp.id = {$id};";


        $sql = "
                select catnome,sernome,usunome,usutelefone,usuemail,sp.preco,usu.usufoto,ende.cidade,ende.UF,
                case
                    when trunc(avg(avaliacao_servico),1) is null then 0
                    else trunc(avg(avaliacao_servico),1)
                end as nota
                from servico_profissional  sp
                    inner join usuarios usu on usu.id = sp.usuid
                    inner join endereco_profissional ende on usu.id = ende.usuid
                    inner join servicos ser on ser.id = sp.serid
                    inner join categorias cat on cat.id = ser.catid
                    left  join ( select * from cliente_servico_profissional csp where csp.status = 'Finalizado') as csp
                        on csp.servico_profissionalid = sp.id
                where sp.id = {$id}
                group by catnome,sernome,usunome,usutelefone,usuemail,sp.preco,usu.usufoto,ende.cidade,ende.UF;";


        $result = pg_query($this->open(), $sql);

        $dados = pg_fetch_all($result);

        if ($dados) {
            return $dados;
        } else {
            return false;
        }

    }

    public function graficoBarraCategorias()
    {
        $sql = "select distinct cat.catnome as categoria,count(servico_profissionalid) as quantidade
            from cliente_servico_profissional CSP
                inner join servico_profissional SP on SP.ID =  CSP.servico_profissionalid
                inner join servicos SER on SER.id =sp.serid
                right join  categorias CAT on CAT.id = SER.catid
            where cat.catstatus = 'True'
            group by  catnome;";

        $result = pg_query($this->open(), $sql);
        return $dados = pg_fetch_all($result);

    }

}
