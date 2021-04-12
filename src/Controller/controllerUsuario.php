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

    public function setUser()
    {
        $this->username = $_POST["username"];
        $this->senha = $_POST["senha"];
        $this->email = $_POST["email"];
        $this->CPF = $_POST["CPF"];
        $this->telefone = $_POST["telefone"];
        $this->foto = $_FILES['foto'];

        //Gerando um nome unico para a imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $this->foto['name'], $ext);

        //URL da pasta para salvar a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        $caminho_imagem = '../imagens/' . $nome_imagem;
        move_uploaded_file($this->foto['tmp_name'], $caminho_imagem);

//        if ($this->username == '' || $this->senha == '' || $this->email || $this->CPF || $this->telefone == '' || $this->foto == '') {
//            return false;
//        }

        $modelUsuario = new modelUsuario($this->username,$this->senha,$this->email,$this->telefone,$nome_imagem,$this->CPF);
        if ($modelUsuario->verificarUser() && $this->validarCPF($this->CPF)) {
            $result = $modelUsuario->inserirUser();
            if ($result) {
               echo 'sucesso';
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


}