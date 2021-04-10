<?php


class controllerUsuario
{

    private $username;
    private $senha;
    private $email;
    private $telefone;
    private $foto;

    public function setUser()
    {
        $this->username = $_POST["username"];
        $this->senha = $_POST["senha"];
        $this->email = $_POST["email"];
        $this->CPF = $_POST["CPF"];
        $this->telefone = $_POST["telefone"];
        $this->foto = $_FILES['foto'];

        //Gerando um nome unico para a imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",$this->foto['name'], $ext);

        //URL da pasta para salvar a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        $caminho_imagem =  '../imagens/'. $nome_imagem;
        move_uploaded_file($this->foto['tmp_name'], $caminho_imagem);
        
        echo 'você parou no upload da foto';
    }


}