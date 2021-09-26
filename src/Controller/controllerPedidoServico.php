<?php
require_once '../Model/modelPedidoServico.php';

class controllerPedidoServico
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


    public function __construct($id_pagamento)
    {
        $this->id_cliente = $_SESSION['id'];
        $this->servico_profissionalid = $_POST["idServico"];
        $this->cep_servico = $_POST["CEP"];
        $this->bairro_servico = $_POST["bairro"];
        $this->logradouro_servico = $_POST["logradouro"];
        $this->complemento_servico = $_POST["complemento"];
        $this->cidade_servico = $_POST["cidade"];
        $this->uf_servico = $_POST["UF"];
        $this->data_servico = $_POST["data"];
        $this->id_pagamento = $id_pagamento;
        $this->status = 'Analise';
    }

    public function setPedido()
    {

        $modelPedido = new modelPedidoServico($this->id_cliente, $this->servico_profissionalid, $this->cep_servico, $this->bairro_servico,
            $this->logradouro_servico, $this->complemento_servico, $this->cidade_servico, $this->uf_servico, $this->data_servico, $this->id_pagamento, $this->status);
        $result =$modelPedido->setPedido();
        if ($result) {
            return 'sucesso';
        } else {
            return 'Error';
        }

    }
}