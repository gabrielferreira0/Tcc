<?php


class controllerPagamento
{
    public $key = 'ak_test_7B84xXxvddaWErUUVeNEmIhwGocFOR';
    public $payment_method;
    public $amount;
    public $nome;
    public $cpf;
    public $recipient_id;
    private $pagarme;

    public function __construct()
    {
        $this->key = 'ak_test_7B84xXxvddaWErUUVeNEmIhwGocFOR';
        $this->recipient_id = 're_cku2qgdez003q0p9tp3ypdvlz';
        $this->pagarme = new PagarMe\Client($this->key);;
    }


    public function montar_dashboard()
    {



        $dashBoard['saldo'] = $this->saldoConta();
        $transacoes = $this->total_status_transacoes();
        $dashBoard['totalTransacoes'] = $transacoes['totalTransacoes'];
        $dashBoard['bandeiras'] = $this->cartaoBandeiras();
        $dashBoard['volume_transacionado'] = $this->Volume_transacionado();
        $dashBoard['ticket_medio'] = $this->ticket_medio($dashBoard['totalTransacoes']);
        $dashBoard['statusTransacoes'] = $transacoes['statusTransacoes'];
        $dashBoard['dataTransacoes'] = $this->data_transacoes();

        return $dashBoard;
    }


    public function ticket_medio($totalTransacoes)
    {
        $transactions = $this->pagarme->transactions()->getList([
            'count' => '1000',
            'status' => 'paid'
        ]);

        $volume_transicionado = 0;
        foreach ($transactions as $transacoes) {
            $volume_transicionado += $transacoes->amount / 100;
        }

        return number_format($volume_transicionado / $totalTransacoes, 2, ',', '.');

    }

    public function Volume_transacionado()
    {
        $transactions = $this->pagarme->transactions()->getList([
            'count' => '1000',
            'status' => 'paid'
        ]);

        $volume_transicionado = 0;
        foreach ($transactions as $transacoes) {
            $volume_transicionado += $transacoes->amount / 100;
        }

        return number_format($volume_transicionado, 2, ',', '.');

    }

    public function saldoConta()
    {
        $recipientBalance = $this->pagarme->recipients()->getBalance([
            'recipient_id' => $this->recipient_id,
        ]);

        $saldo = number_format($recipientBalance->waiting_funds->amount / 100, 2, ',', '.');

        return $saldo;
    }


    public function total_status_transacoes()
    {
        $pagas = 0;
        $autorizadas = 0;
        $estornadas = 0;
        $recusadas = 0;
        $resultado = [];

        $transactions = $this->pagarme->transactions()->getList([
            'count' => '1000'
        ]);
        $totalTransacoes = count($transactions);

        foreach ($transactions as $transacoes) {
            switch ($transacoes->status) {
                case "paid":
                    $pagas++;
                    break;
                case "authorized":
                    $autorizadas++;
                    break;
                case "refused":
                    $recusadas++;
                    break;
                case "refunded":
                    $estornadas++;
                    break;
            }
        }

        $statusTransacoes['pagas'] = $pagas;
        $statusTransacoes['autorizadas'] = $autorizadas;
        $statusTransacoes['estornadas'] = $estornadas;
        $statusTransacoes['recusadas'] = $recusadas;

        $resultado['totalTransacoes'] = $totalTransacoes;
        $resultado['statusTransacoes'] = $statusTransacoes;

        return $resultado;
    }

    public function cartaoBandeiras()
    {
        $transactions = $this->pagarme->transactions()->getList([
            'count' => '1000'
        ]);
        $totalTransacoes = count($transactions);

        $bandeiras['visa'] = 0;
        $bandeiras['mastercard'] = 0;

        foreach ($transactions as $transacoes) {
            if ($transacoes->card_brand == 'visa') {
                $bandeiras['visa']++;
            } elseif ($transacoes->card_brand == 'mastercard') {
                $bandeiras['mastercard']++;
            }
        }

        $bandeiras['visa'] = number_format($bandeiras['visa'] / $totalTransacoes * 100, 1, '.', '');
        $bandeiras['mastercard'] = number_format($bandeiras['mastercard'] / $totalTransacoes * 100, 1, '.', '');

        return $bandeiras;

    }


    public function data_transacoes()
    {
        $transactions = $this->pagarme->transactions()->getList([
            'count' => '1000'
        ]);

        foreach ($transactions as $transacao) {
            $quantidade[] = date('M', strtotime($transacao->date_created));
        }
         return array_count_values($quantidade);

    }

}