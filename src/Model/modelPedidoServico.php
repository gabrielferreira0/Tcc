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


    public function __construct($id_cliente, $servico_profissionalid, $cep_servico, $bairro_servico, $logradouro_servico, $complemento_servico
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
    }

    public function setPedido()
    {
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

}