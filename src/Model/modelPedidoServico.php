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
    private $cidade_servico;
    private $uf_servico;
    private $data_servico;
    private $avaliacao_servico;
    private $id_pagamento;
    private $status;


    public function setPedido($id_cliente, $servico_profissionalid, $cep_servico, $bairro_servico, $logradouro_servico, $complemento_servico
        , $cidade_servico, $uf_servico, $data_servico, $id_pagamento, $status)
    {
        $this->id_cliente = $id_cliente;
        $this->servico_profissionalid = $servico_profissionalid;
        $this->cep_servico = $cep_servico;
        $this->bairro_servico = $bairro_servico;
        $this->logradouro_servico = $logradouro_servico;
        $this->complemento_servico = $complemento_servico;
        $this->cidade_servico = $cidade_servico;
        $this->uf_servico = $uf_servico;
        $this->data_servico = $data_servico;
        $this->id_pagamento = $id_pagamento;
        $this->status = $status;


        $sql = "INSERT INTO  cliente_servico_profissional
    (id_cliente, servico_profissionalID, cep_servico, bairro_servico, logradouro_servico, complemento_servico, 
     cidade_servico, UF_servico, data_servico,id_pagamento, status) 
    VALUES
       ($this->id_cliente,$this->servico_profissionalid,'$this->cep_servico','$this->bairro_servico','$this->logradouro_servico',
       '$this->complemento_servico','$this->cidade_servico','$this->uf_servico','$this->data_servico', $this->id_pagamento,'$this->status');";

        $result = pg_query($this->open(), $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }

    }


    public function getPedidos($usuid)
    {

        $sql = "select usu.usunome nome_profissional,sp.preco servico_preco,
       sernome as nome_servico,catnome as nome_categoria,
       CSP.status pedido_status, CSP.id  pedido_id
from cliente_servico_profissional CSP
    inner join servico_profissional sp on sp.id = CSP.servico_profissionalID
    inner join usuarios usu on usu.id = sp.usuid
    inner join servicos ser on ser.id = sp.serid
    inner join categorias cat on cat.id = ser.catid
where CSP.id_cliente = {$usuid} or sp.usuid = {$usuid};";
        $result = pg_query($this->open(), $sql);
        $dados = pg_fetch_all($result);

        if ($dados) {
            return $dados;
        } else {
            return false;
        }


    }

}