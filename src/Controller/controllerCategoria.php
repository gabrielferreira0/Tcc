<?php

require_once '../Model/modelCategoria.php';

class controllerCategoria
{
    private $categoria;
    private $fotoCategoria;
    private $status;
    private $servicos = [];


    public function setCategoria()
    {

        $this->categoria = $_POST["categoria"];
        $this->fotoCategoria = $_FILES['fotoCategoria'];
        $this->status = "True";
        $this->servicos = json_decode($_POST['servicos']);


        $modelCategoria = new modelCategoria();

        if ($this->categoria == '' || $this->fotoCategoria == '' || $this->servicos == '') {
            return 'erro';
        } else {
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $this->fotoCategoria['name'], $ext);
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
            $caminho_imagem = '../imagens/categoria/' . $nome_imagem;

            $id = $modelCategoria->setCategoria($this->categoria, $nome_imagem, $this->status);
            $id = intval($id[0]);


            if ($id) {
                move_uploaded_file($this->fotoCategoria['tmp_name'], $caminho_imagem);

                foreach ($this->servicos as $key => $value) {
                    $modelCategoria->setServicos($id, $value);
                }

                return 'sucesso';
            } else {
                return 'erro';
            }
        }
    }

    public function setStatusCat()
    {
        $idCat = $_POST["idCat"];
        $status = $_POST["status"];
        $modelCategoria = new modelCategoria();
        $result = $modelCategoria->setStatusCat($idCat, $status);
    }


    public function updateCat()
    {
        $modelCategoria = new modelCategoria();
        $this->categoria = $_POST["categoriaUPD"];
        $idCategoria = $_POST["idCategoria"];


        if ($_POST["imagemUpdCat"] == 'true') {
            $this->fotoCategoria = $_FILES['novaImagemCat'];
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $this->fotoCategoria['name'], $ext);
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
            $caminho_imagem = '../imagens/categoria/' . $nome_imagem;

            move_uploaded_file($this->fotoCategoria['tmp_name'], $caminho_imagem);

        } else {
            $nome_imagem = $_POST['imagemCatAtual'];
        }

        $result = $modelCategoria->updateCategoria($idCategoria, $this->categoria, $nome_imagem);
        if ($result) {
            return 'sucesso';
        } else {
            return 'erro';
        }

    }
}
