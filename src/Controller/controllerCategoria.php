<?php

require_once '../Model/modelCategoria.php';

class controllerCategoria
{
    private $categoria;
    private $fotoCategoria;
    private $status;


    public function setCategoria()
    {
        $this->categoria = $_POST["categoria"];
        $this->fotoCategoria = $_FILES['fotoCategoria'];
        $this->status = "True";
        $modelCategoria = new modelCategoria();

        if ($this->categoria == '' || $this->fotoCategoria == '') {
            return false;
        } else {
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $this->fotoCategoria['name'], $ext);
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
            $caminho_imagem = '../imagens/categoria/' . $nome_imagem;

            $result = $modelCategoria->setCategoria($this->categoria, $nome_imagem, $this->status);

            return $result;
        }
    }
}
