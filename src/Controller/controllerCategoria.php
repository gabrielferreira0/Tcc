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

    public function tableServicos($categoriaNome, $servicoID = null, $UF = null)
    {


        $modelCategoria = new modelCategoria();
        $result = $modelCategoria->tableServicos($categoriaNome, $servicoID, $UF);


        $table = "<table id='table-Services' class='table table' style=' border:1px solid white; color: white'>
                    <thead style='background: #f50a31;'>
                        <tr>
                            <th scope='col'>Profissional</th>
                            <th scope='col'>Preço</th>
                            <th scope='col'>Nota:</th>
                            <th scope='col'>Serviço:</th>
                            <th scope='col'>Cidade:</th>
                            <th scope='col'>Selecionar:</th>
                        </tr>
                     </thead>
                     <tbody>
";

        if ($result) {

            foreach ($result as $value) {
                $table .= " <tr>
                                <th scope='row'>{$value['nome_profissional']}</th>
                                <th scope='row'>R$ {$value['preco']}</th>
                                <th scope='row'>{$value['nota']}<i style='color: #fac303' class='fas fa-star'></i></th>
                                <th scope='row'>{$value['sernome']}</th >
                                <th scope='row'>{$value['cidade']}</th >
                            ";
                if (isset($_SESSION['CPF'])) {
                    $table .= "<th >
                            <a href='../View/pedidoServico.php?servico={$value['servico_profissional_id']}'>
                                <button    
                                  type='button' class='btn btn-success'><i class='fas fa-handshake'></i>
                                </button>   
                            </a>                     
                            </th >
                        </tr > ";
                } else {
                    $table .= "<th >
                                <button  onclick='loginOFF();' type='button' class='btn btn-success'><i class='fas fa-handshake'></i>
                                </button>                        
                            </th >
                        </tr > ";
                }

            }

        } else {
            $table .= "<tr>
                    <tr><td  class='text-center' colspan='6'>Nenhum serviço disponível no momento</td></tr>
                </tr>";
        }

        $table .= "</tbody>";
        $table .= "</table>";

        return $table;

    }


    public function carregarServicos()
    {
        $idCategoria = $_POST["idCategoria"];
        $modelCategoria = new modelCategoria();
        return json_encode($modelCategoria->getServicos($idCategoria));
    }

    public function servico_profissional()
    {
        $usuid = intval($_SESSION['id']);
        $idServico = intval($_POST["idServico"]);
        $precoServico = floatval($_POST["precoServico"]);


        $modelCategoria = new modelCategoria();
        return json_encode($modelCategoria->servico_profissional($usuid, $idServico, $precoServico));
    }

}
