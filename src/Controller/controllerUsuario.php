<?php

require_once '../Model/modelUsuario.php';
require_once 'controllerEmail.php';

class controllerUsuario
{
    private $username;
    private $senha;
    private $email;
    private $telefone;
    private $foto;
    private $CPF;
    private $status;
    private $tipo;
    private $dataCadastro;


    public function setParceiro($tipo = 3)
    {
        $pagarme = new PagarMe\Client('ak_test_qzaATUM7qtiv49tJNvmZuOLY2tDvAS');
        
        $this->username = $_POST["username"];
        $this->senha = $_POST["senha"];
        $this->senha = md5($this->senha);;
        $this->email = $_POST["email"];
        $this->CPF = $_POST["CPF"];
        $this->telefone = $_POST["telefone"];
        $this->tipo = $tipo;
        $this->status = 'True';
        $this->dataCadastro = date('Ymd');

        $CEP = $_POST["CEP"];
        $UF = $_POST["UF"];
        $cidade = $_POST["cidade"];
        $logradouro = $_POST["logradouro"];
        $complemento = $_POST["complemento"];
        $bairro = $_POST["bairro"];

        $banco = $_POST["banco"];
        $agencia = $_POST["agencia"];
        $conta = $_POST["conta"];

        $auxiliar = explode ("-",$conta);
        $conta_dv = $auxiliar[1];
        $contaAPI = $auxiliar[0];

        try {
            $recipient = $pagarme->recipients()->create([
                'anticipatable_volume_percentage' => '100',
                'automatic_anticipation_enabled' => 'true',
                'bank_account' => [
                    'bank_code' => $banco,
                    'agencia' => $agencia,
                    'conta' => $contaAPI,
                    'type' => 'conta_corrente',
                    'conta_dv' => $conta_dv,
                    'document_number' => $this->CPF,
                    'legal_name' => $this->username
                ],
                'transfer_day' => '5',
                'transfer_enabled' => 'true',
                'transfer_interval' => 'weekly'
            ]);

            $recipientID = $recipient->id;
            $bank_account_id = $recipient->bank_account->id;

            if ($_POST["fotoStatus"] == 'false') {
                $nome_imagem = 'false';
            } elseif ($_POST["fotoStatus"] == 'true') {
                $this->foto = $_FILES['foto'];
                //Gerando um nome unico para a imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $this->foto['name'], $ext);

                //URL da pasta para salvar a imagem
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
                $caminho_imagem = '../imagens/usuarios/' . $nome_imagem;
            }

            $modelUsuario = new modelUsuario();

            if ($modelUsuario->verificarUser($this->CPF, $this->email) && $this->validarCPF($this->CPF)) {
                $id = $modelUsuario->inserirUser($this->username, $this->senha, $this->email, $this->telefone, $nome_imagem, $this->CPF, $this->status, $this->tipo, $this->dataCadastro);
                $id = intval($id[0]);
                if ($id) {
                    if ($_POST["fotoStatus"] == 'true') {
                        move_uploaded_file($this->foto['tmp_name'], $caminho_imagem);
                    }
                    $modelUsuario->setEndereco($id,$CEP,$cidade,$UF,$logradouro,$complemento,$bairro);
                    $modelUsuario->setDadosBancarios($id,$banco,$agencia,$conta,$recipientID,$bank_account_id);
                    echo 'sucesso';
                }
            }
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }


    public function setUser($tipo = 2)
    {

        $this->username = $_POST["username"];
        $this->senha = $_POST["senha"];
        $this->senha = md5($this->senha);;
        $this->email = $_POST["email"];
        $this->CPF = $_POST["CPF"];
        $this->telefone = $_POST["telefone"];
        $this->tipo = $tipo;
        $this->status = 'True';
        $this->dataCadastro = date('Ymd');


        if ($_POST["fotoStatus"] == 'false') {
            $nome_imagem = 'false';
        } elseif ($_POST["fotoStatus"] == 'true') {
            $this->foto = $_FILES['foto'];
            //Gerando um nome unico para a imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $this->foto['name'], $ext);

            //URL da pasta para salvar a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
            $caminho_imagem = '../imagens/usuarios/' . $nome_imagem;
        }

        if ($this->username == '' || $this->senha == '' || $this->email == '' || $this->telefone == '') {
            return 'null';
        } else {
            $modelUsuario = new modelUsuario();

            if ($modelUsuario->verificarUser($this->CPF, $this->email) && $this->validarCPF($this->CPF)) {
                $result = $modelUsuario->inserirUser($this->username, $this->senha, $this->email, $this->telefone, $nome_imagem, $this->CPF, $this->status, $this->tipo, $this->dataCadastro);
                if ($result) {
                    if ($_POST["fotoStatus"] == 'true') {
                        move_uploaded_file($this->foto['tmp_name'], $caminho_imagem);
                    }
                    echo 'sucesso';
                }
            }
        }
    }


    public function update()
    {
        $id = $_SESSION['id'];
        $this->username = $_POST["username"];
        $this->telefone = $_POST["telefone"];


        if ($_POST["senhaStatus"] == 'true') {
            $this->senha = $_POST["senha"];
            $this->senha = md5($this->senha);;
        }

        if ($_POST["fotoStatusupd"] == 'false') {
            $nome_imagem = 'false';
        } elseif ($_POST["fotoStatusupd"] == 'true') {
            $this->foto = $_FILES['foto'];

            //Gerando um nome unico para a imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $this->foto['name'], $ext);

            //URL da pasta para salvar a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
            $caminho_imagem = '../imagens/usuarios/' . $nome_imagem;
        } elseif ($_POST["fotoStatusupd"] == 'jaTem') {
            $this->foto = $_POST['fotoAtual'];

            $nome_imagem = $this->foto;

        }

        if ($this->username == '' || $this->telefone == '') {
            return 'null';
        } else {
            $modelUsuario = new modelUsuario();
            if ($_POST["senhaStatus"] == 'true') {
                $result = $modelUsuario->updatecomSenha($id, $this->username, $this->senha, $this->telefone, $nome_imagem);
            } elseif ($_POST["senhaStatus"] == 'false') {
                $result = $modelUsuario->updateSemSenha($id, $this->username, $this->telefone, $nome_imagem);
            }

            if ($result) {
                $_SESSION['User'] = $this->username;
                $_SESSION['Password'] = $this->senha;
                $_SESSION['Telefone'] = $this->telefone;
                $_SESSION['Foto'] = $nome_imagem;

                if ($_POST["fotoStatusupd"] == 'true') {
                    move_uploaded_file($this->foto['tmp_name'], $caminho_imagem);
                }

                return 'sucesso';
            } else {
                return 'false';
            }
        }

    }


    public function validarCPF($CPF)
    {
        $validacao = preg_replace('/[^0-9]/is', '', $CPF);
        // pega somente a numeração
        if (strlen($validacao) != 11) {
            echo 'null';
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $validacao)) {
            echo 'CPFinvalido';
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $validacao[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($validacao[$c] != $d) {
                echo 'CPFinvalido';
                return false;
            }
        }
        return true;
    }

    public function logar()
    {
        $modelUsuario = new modelUsuario();
        //session_start();
        $CPFlogin = $_POST["CPFlogin"];
        $senhaLogin = $_POST["senhaLogin"];
        $senhaLogin = md5($senhaLogin);
        $resultado = $modelUsuario->login($CPFlogin, $senhaLogin);

        if (pg_num_rows($resultado[0]) > 0) {
            $_SESSION['id'] = $resultado[1][0];
            $_SESSION['User'] = $resultado[1][1];
            $_SESSION['Password'] = $resultado[1][2];
            $_SESSION['Email'] = $resultado[1][3];
            $_SESSION['CPF'] = $resultado[1][4];
            $_SESSION['Telefone'] = $resultado[1][5];
            $_SESSION['Foto'] = $resultado[1][6];
            $_SESSION['Tipo'] = $resultado[1][8];
            //header('location:../Perfil.php');
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function deslogar()
    {
        session_destroy();
        return 'true';
    }

    public function delete()
    {
        $id = $_SESSION['id'];
        $modelUsuario = new modelUsuario();
        $resultado = $modelUsuario->deletar($id);
        session_destroy();
    }


    public function block($id)
    {
        $modelUsuario = new modelUsuario();
        return $resultado = $modelUsuario->block($id);
    }


    public function recuperar()
    {
        $CPFrecuperar = $_POST["CPFrecuperar"];
        $modelUsuario = new modelUsuario();
        $resultado = $modelUsuario->recuperar($CPFrecuperar);


        if ($resultado[0]) {
            $assunto = 'Recuperação Conta';
            $nome = $resultado[0][1];
            $novaSenha = $resultado[0][2];
            $email = $resultado[0][3];
            $CPF = $resultado[0][4];
            $telefone = $resultado[0][5];


            require_once '../View/Layouts/recuperarSenha.php';


            $mail = new controllerEmail();
            return $resultadoEnvio = $mail->enviarEmail($email, $assunto, $conteudo);

        } else {
            return false;
        }
    }

}