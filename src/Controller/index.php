<?php
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
            require_once 'Atualizar.php';
            $loadClass = new Atualizar();
            echo $loadClass->update();
            break;
        case 'delete':
            require_once 'Deletar.php';
            $loadClass = new Deletar();
            echo $loadClass->delete();
            break;
        case 'deslogar':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            echo $loadClass->deslogar();
            break;
    }
}
?>