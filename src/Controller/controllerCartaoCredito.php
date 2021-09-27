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
        $this->payment_method = 'credit_card';
        $this->holder_name = $_POST["cartaoNome"];
        $this->number = $_POST["cartaoNumero"];
        $this->expiration_date = $_POST["cartaoData"];
        $this->cvv = $_POST["CVV"];
        $this->amount = $_POST["preco"];
    }

    public function pagamento()
    {


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
}