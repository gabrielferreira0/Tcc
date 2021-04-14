<?php

require_once '../Model/modelUsuario.php';

class controllerUsuario
{
    private $username;
    private $senha;
    private $email;
    private $telefone;
    private $foto;
    private $CPF;
    private $status;


    public function setUser()
    {
        $this->username = $_POST["username"];
        $this->senha = $_POST["senha"];
        $this->email = $_POST["email"];
        $this->CPF = $_POST["CPF"];
        $this->telefone = $_POST["telefone"];
        $this->status = 'True';

        if ($_POST["fotoStatus"] == 'false') {
            $nome_imagem = 'false';
        } elseif ($_POST["fotoStatus"] == 'true') {
            $this->foto = $_FILES['foto'];
            //Gerando um nome unico para a imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $this->foto['name'], $ext);

            //URL da pasta para salvar a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
            $caminho_imagem = '../imagens/' . $nome_imagem;
        }

        if ($this->username == '' || $this->senha == '' || $this->email == '' || $this->telefone == '') {
            return 'null';
        } else {

            $modelUsuario = new modelUsuario();

            if ($modelUsuario->verificarUser() && $this->validarCPF($this->CPF)) {
                $result = $modelUsuario->inserirUser($this->username, $this->senha, $this->email, $this->telefone, $nome_imagem,$this->CPF,$this->status);

                if ($result) {
                    if ($_POST["fotoStatus"] == 'true'){
                        move_uploaded_file($this->foto['tmp_name'], $caminho_imagem);
                    }
                    echo 'sucesso';
                }
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

        $resultado =$modelUsuario->login($CPFlogin,$senhaLogin);

        if (pg_num_rows($resultado[0]) > 0) {
            $_SESSION['id'] = $resultado[1][0];
            $_SESSION['User'] = $resultado[1][1];
            $_SESSION['Password'] = $resultado[1][2];
            $_SESSION['Email'] = $resultado[1][3];
            $_SESSION['CPF'] = $resultado[1][4];
            $_SESSION['Telefone'] = $resultado[1][5];
            $_SESSION['Foto'] = $resultado[1][6];
            //header('location:../Perfil.php');
            echo 'true';
        } else {
            echo 'false';
        }
    }


}