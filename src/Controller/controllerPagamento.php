<?php


class controllerPagamento
{
    public $key = 'ak_test_7B84xXxvddaWErUUVeNEmIhwGocFOR';
    public $payment_method;
    public $amount;
    public $nome;
    public $cpf;
    public $recipient_id;


    public function __construct()
    {
        $this->key = 'ak_test_7B84xXxvddaWErUUVeNEmIhwGocFOR';
        $this->recipient_id = 're_cku2qgdez003q0p9tp3ypdvlz';
    }


    public function montar_dashboard()
    {
        $dashBoard['saldo'] = $this->saldoConta();
        $dashBoard['totalTransacoes'] = $this->totalTransacoes();
        $dashBoard['bandeiras'] = $this->cartaoBandeiras();
        $dashBoard['Volume_transacionado'] = $this->Volume_transacionado();

        return $dashBoard;

    }


    public function Volume_transacionado()
    {
        $pagarme = new PagarMe\Client($this->key);
        $transactions = $pagarme->transactions()->getList([
            'count' => '1000',
            'status' => 'paid'
        ]);

        $volume_transicionado = 0;
        foreach ($transactions as $transacoes) {
            $volume_transicionado += $transacoes->amount / 100;
        }

        return $volume_transicionado;

    }

    public function saldoConta()
    {
        $pagarme = new PagarMe\Client($this->key);
        $recipientBalance = $pagarme->recipients()->getBalance([
            'recipient_id' => $this->recipient_id,
        ]);

        $saldo = number_format($recipientBalance->waiting_funds->amount / 100, 2, '.', '');

        return $saldo;
    }


    public function totalTransacoes()
    {
        $pagarme = new PagarMe\Client($this->key);
        $transactions = $pagarme->transactions()->getList([
            'count' => '1000'
        ]);
        $totalTransacoes = count($transactions);
        return $totalTransacoes;
    }

    public function cartaoBandeiras()
    {
        $pagarme = new PagarMe\Client($this->key);
        $transactions = $pagarme->transactions()->getList([
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
}