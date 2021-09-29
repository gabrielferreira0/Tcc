<?php

require __DIR__ . "../../vendor/autoload.php";

if (isset($_POST["rq"])) {
    session_start();
    $request = $_POST["rq"];
    switch ($request) {
        case 'cadastrar':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            echo $loadClass->setUser();
            break;
        case 'login':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            echo $loadClass->logar();
            break;
        case 'update':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            echo $loadClass->update();
            break;
        case 'delete':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            $loadClass->delete();
            break;
        case 'block':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            $loadClass->block($_POST["idUser"]);
            break;
        case 'deslogar':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            echo $loadClass->deslogar();
            break;
        case 'setStatusCat':
            require_once 'controllerCategoria.php';
            $loadClass = new controllerCategoria();
            echo $loadClass->setStatusCat();
            break;
        case 'salvarCat':
            require_once 'controllerCategoria.php';
            $loadClass = new controllerCategoria();
            echo $loadClass->setCategoria();
            break;
        case 'updateCat':
            require_once 'controllerCategoria.php';
            $loadClass = new controllerCategoria();
            echo $loadClass->updateCat();
            break;
        case 'recuperar':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            echo $loadClass->recuperar();
            break;
        case 'suporte':
            require_once 'controllerEmail.php';
            $loadClass = new controllerEmail();
            echo $loadClass->suporte();
            break;
        case 'cadastrarParceiro':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            echo $loadClass->setParceiro();
            break;
        case 'carregarServicos':
            require_once 'controllerCategoria.php';
            $loadClass = new controllerCategoria();
            echo $loadClass->carregarServicos();
            break;
        case 'salvarServico':
            require_once 'controllerCategoria.php';
            $loadClass = new controllerCategoria();
            echo $loadClass->servico_profissional();
            break;
        case 'servicos_ID':
            require_once 'controllerCategoria.php';
            $servicoID = $_POST["servicoID"];
            $UF = $_POST["UF"];
            $categoriaNome = $_POST["categoriaNome"];
            $loadClass = new controllerCategoria();
            echo $loadClass->tableServicos($categoriaNome, $servicoID, $UF);
            break;
        case 'pedido':
            require_once 'controllerCartaoCredito.php';
            require_once 'controllerPedidoServico.php';
            $pagamento = new  controllerCartaoCredito();
            $id_pagamento = $pagamento->pagamento();

            if ($id_pagamento) {
                $pedido = new controllerPedidoServico($id_pagamento);
                echo $pedido->setPedido();
            } else {
                echo 'Error';
            }
            break;
        case 'cancelarPedido':
            require_once '../Model/modelPedidoServico.php';
            require_once 'controllerCartaoCredito.php';
            $pedido = new modelPedidoServico();
            $pedido->cancelarPedido($_POST["pedido_id"]);
            $pagamento = new controllerCartaoCredito();
            echo $pagamento->estorno($_POST["pagamento_id"]);
        case 'aceitarPedido':
            require_once '../Model/modelPedidoServico.php';
            $pedido = new modelPedidoServico();
            echo $pedido->aceitarPedido($_POST["pedido_id"]);

    }
}
