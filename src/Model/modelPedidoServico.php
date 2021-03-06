<?php
require_once 'DBconexao.php';

class modelPedidoServico extends DBconexao
{
    private $id_cliente;
    private $servico_profissionalid;
    private $cep_servico;
    private $bairro_servico;
    private $logradouro_servico;
    private $complemento_servico;
    private $numero_servico;
    private $cidade_servico;
    private $uf_servico;
    private $data_servico;
    private $avaliacao_servico;
    private $id_pagamento;
    private $status;


    public function setPedido($id_cliente, $servico_profissionalid, $cep_servico, $bairro_servico, $logradouro_servico, $complemento_servico
        ,                     $numero_servico, $cidade_servico, $uf_servico, $data_servico, $id_pagamento, $status)
    {
        $this->id_cliente = $id_cliente;
        $this->servico_profissionalid = $servico_profissionalid;
        $this->cep_servico = $cep_servico;
        $this->bairro_servico = $bairro_servico;
        $this->logradouro_servico = $logradouro_servico;
        $this->complemento_servico = $complemento_servico;
        $this->numero_servico = $numero_servico;
        $this->cidade_servico = $cidade_servico;
        $this->uf_servico = $uf_servico;
        $this->data_servico = $data_servico;
        $this->id_pagamento = $id_pagamento;
        $this->status = $status;


        $sql = "INSERT INTO  cliente_servico_profissional
    (id_cliente, servico_profissionalID, cep_servico, bairro_servico, logradouro_servico, complemento_servico,numero_servico, 
     cidade_servico, UF_servico, data_servico,id_pagamento, status) 
    VALUES
       ($this->id_cliente,$this->servico_profissionalid,'$this->cep_servico','$this->bairro_servico','$this->logradouro_servico',
       '$this->complemento_servico',$this->numero_servico,'$this->cidade_servico','$this->uf_servico','$this->data_servico', $this->id_pagamento,'$this->status');";

        $result = pg_query($this->open(), $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function getPedidos($usuid = null)
    {

        if ($usuid) {
            $usuid = "where CSP.id_cliente = $usuid or sp.usuid = $usuid";
        }

        $sql = "
    select usu.usunome nome_profissional,pag.valor servico_preco,pag.id pagamento_id,
       sernome as nome_servico,catnome as nome_categoria,
       CSP.status pedido_status, CSP.id  pedido_id
    from cliente_servico_profissional CSP
        inner join servico_profissional sp on sp.id = CSP.servico_profissionalID
        inner join usuarios usu on usu.id = sp.usuid
        inner join servicos ser on ser.id = sp.serid
        inner join categorias cat on cat.id = ser.catid
        inner join pagamento_servico pag on pag.id = CSP.id_pagamento "
            . $usuid . ";";


        $result = pg_query($this->open(), $sql);
        $dados = pg_fetch_all($result);

        if ($dados) {
            return $dados;
        } else {
            return false;
        }
    }


    public function getPedido($pedidoID)
    {
        $sql = "select  catnome, sernome,usuid id_profissional,usunome,CSP.id_cliente, usutelefone,usuemail,usufoto,
       PAG.id as  pagamento_id,PAG.valor as preco,CSP.cep_servico,bairro_servico,logradouro_servico,complemento_servico,
       numero_servico,cidade_servico,UF_servico,data_servico,CSP.status as status_pedido,
    case
        when trunc(avg(avaliacao_servico),1) is null then 0
        else trunc(avg(avaliacao_servico),1)
    end as nota
from cliente_servico_profissional CSP
    inner join servico_profissional SP on SP.ID = CSP.servico_profissionalID
    inner join  servicos SER on SER.ID = SP.serid
    inner join categorias CAT on CAT.ID = SER.catid
    inner join usuarios USU on USU.ID = SP.usuid
    inner join pagamento_servico PAG on PAG.id = CSP.id_pagamento
where csp.id = {$pedidoID} and USU.usutipo = 3
group by catnome, sernome, usuid, usunome, CSP.id_cliente, usutelefone, usuemail, usufoto, PAG.id, PAG.valor,
         CSP.cep_servico, bairro_servico, logradouro_servico, complemento_servico, numero_servico, cidade_servico,
         UF_servico, data_servico, CSP.status";


        $result = pg_query($this->open(), $sql);

        if ($result) {
            $dados = pg_fetch_all($result);
            return $dados;
        } else {
            return 'N??o foi possivel realizar a consulta';
        }
    }

    public function cancelarPedido($pedido_ID)
    {
        $sql = "update cliente_servico_profissional set status = 'Cancelado' where id = {$pedido_ID};";
        $result = pg_query($this->open(), $sql);
        return $result;
    }

    public function aceitarPedido($pedido_ID)
    {
        $sql = "update cliente_servico_profissional set status = 'Andamento' where id = {$pedido_ID};";
        $result = pg_query($this->open(), $sql);

        if ($result) {
            return 'sucesso';
        } else {
            return 'erro';
        }
    }

    public function finalizarPedido($pedido_ID, $avaliacao_servico)
    {
        $sql = "update cliente_servico_profissional set status = 'Finalizado',avaliacao_servico = {$avaliacao_servico} where id = {$pedido_ID};";
        $result = pg_query($this->open(), $sql);

        if ($result) {
            return 'sucesso';
        } else {
            return 'erro';
        }
    }

    public function buscarProfissionalPedido($pedido_ID)
    {
        $sql = "select recipient_ID,bank_account_id,CSP.id_pagamento
from cliente_servico_profissional  CSP
  inner join  servico_profissional sp on CSP.servico_profissionalID = sp.id
  inner join conta_profissional conta on conta.usuid = SP.usuid
where CSP.id={$pedido_ID};";

        $result = pg_query($this->open(), $sql);
        $dados = pg_fetch_array($result, 0, PGSQL_NUM);;

        if ($dados) {
            return $dados;
        } else {
            return false;
        }
    }

}