<?php

require_once 'controllerPagamento.php';
require_once '../Model/modelPagamento.php';

class controllerCartaoCredito extends controllerPagamento
{

    private $holder_name;
    private $number;
    private $expiration_date;
    private $cvv;
    private $cardID;

    public function __construct()
    {
    }

    public function pagamento()
    {

        $this->payment_method = 'credit_card';
        $this->holder_name = $_POST["cartaoNome"];
        $this->number = $_POST["cartaoNumero"];
        $this->expiration_date = $_POST["cartaoData"];
        $this->cvv = $_POST["CVV"];
        $this->amount = $_POST["preco"];


        try {
            $pagarme = new PagarMe\Client($this->key);
            $card = $pagarme->cards()->create([
                'holder_name' => $this->holder_name,
                'number' => $this->number,
                'expiration_date' => $this->expiration_date,
                'cvv' => $this->cvv
            ]);
            $this->cardID = $card->id;

            $phone_numbers = preg_replace('/[^0-9]/', '', $_SESSION['Telefone']);

            $transaction = $pagarme->transactions()->create([
                'amount' => $this->amount * 100,
                'card_id' => $this->cardID,
                'capture' => 'false',
                'payment_method' => $this->payment_method,
                'postback_url' => 'http://requestb.in/pkt7pgpk',
                'customer' => [
                    'external_id' => '0001',
                    'name' => $_SESSION['User'],
                    'email' => $_SESSION['Email'],
                    'type' => 'individual',
                    'country' => 'br',
                    'documents' => [
                        [
                            'type' => 'cpf',
                            'number' => $_SESSION['CPF']
                        ]
                    ],
                    'phone_numbers' => ['+55' . $phone_numbers]
                ],
                'billing' => [
                    'name' => $_SESSION['User'],
                    'address' => [
                        'country' => 'br',
                        'street' => $_POST["logradouro"],
                        'street_number' => $_POST["numero"],
                        'state' => $_POST["UF"],
                        'city' => $_POST["cidade"],
                        'neighborhood' => $_POST["bairro"],
                        'zipcode' => $_POST["CEP"]
                    ]
                ],
                'shipping' => [
                    'name' => 'WeDo Services',
                    'fee' => 1020,
                    'delivery_date' => '2018-09-22',
                    'expedited' => false,
                    'address' => [
                        'country' => 'br',
                        'street' => 'Avenida Brigadeiro Faria Lima',
                        'street_number' => '1811',
                        'state' => 'sp',
                        'city' => 'Sao Paulo',
                        'neighborhood' => 'Jardim Paulistano',
                        'zipcode' => '01451001'
                    ]
                ],
                'items' => [
                    [
                        'id' => $_POST["idServico"],
                        'title' => $_POST["nomeServico"],
                        'unit_price' => $this->amount,
                        'quantity' => 1,
                        'tangible' => true
                    ]
                ]
            ]);

            $transacaoId = $transaction->id;
            $transacaoStatus = $transaction->status;
            $transacaoValor = floatval($this->amount);
            $card_ultimos_digitos = intval($transaction->card_last_digits);
            $card_bandeira = $transaction->card_brand;

            $modelPagamento = new modelPagamento($transacaoId, $transacaoStatus, $transacaoValor, $card_ultimos_digitos, $card_bandeira);
            return $pagamento = $modelPagamento->setPagamento();

        } catch (Exception $e) {
            echo "ERROR:" . $e;
        }

    }

    public function getPagamento($idPagamento)
    {
        require __DIR__ . "../../vendor/autoload.php";
        try {
            $pagarme = new PagarMe\Client($this->key);
            $transactions = $pagarme->transactions()->get([
                'id' => $idPagamento
            ]);


            $result[0] = $transactions->card_last_digits;
            $result[1] = $transactions->card_brand;
            return $result;

        } catch (Exception $e) {
            echo "ERROR:" . $e;
        }


    }


    public function estorno($pagamento_id)
    {
        $pagarme = new PagarMe\Client($this->key);
        $refundedTransaction = $pagarme->transactions()->refund([
            'id' => $pagamento_id,
        ]);

        if ($refundedTransaction->status == 'authorized') {
            return 'sucesso';
        } else {
            return 'erro';
        }
    }

    public function capturar($recipient_id_profissional,$pagamento_id)
    {
        $recipient_id_profissional = trim($recipient_id_profissional);

        $pagarme = new PagarMe\Client($this->key);
        $capturedTransaction = $pagarme->transactions()->capture([
            'id' => $pagamento_id,
            'split_rules' => [
                [
                    'percentage' => '10',
                    'recipient_id' => 're_cku2qgdez003q0p9tp3ypdvlz',
                    'charge_processing_fee' => 'true',
                    'liable' => true
                ],
                [
                    'percentage' => '90',
                    'recipient_id' => $recipient_id_profissional,
                    'liable' => true
                ]
            ]
        ]);
        if ($capturedTransaction->status =='authorized') {
            return 'sucesso';
        } else {
            return 'erro';
        }
    }
}