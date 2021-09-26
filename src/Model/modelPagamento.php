<?php

require_once 'DBconexao.php';
class modelPagamento extends DBconexao
{

    private $id;
    private $status;
    private $valor;
    private $card_ultimos_digitos;
    private $card_bandeira;


    public function __construct($id,$status,$valor,$card_ultimos_digitos,$bard_bandeira)
    {
       $this->id = $id;
       $this->status = $status;
       $this->valor = $valor;
       $this->card_ultimos_digitos = $card_ultimos_digitos;
       $this->card_bandeira= $bard_bandeira;
    }



    public function setPagamento()
    {
        $sql = "INSERT INTO pagamento_servico (id,status,valor,card_ultimos_digitos,card_bandeira) 
                VALUES ($this->id,'$this->status',$this->valor,$this->card_ultimos_digitos,'$this->card_bandeira');";
        $result = pg_query($this->open(), $sql);

        if ($result) {
            return $this->id;
        }
        else {
            return false;
        }

    }

}