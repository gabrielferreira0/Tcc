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
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            echo $loadClass->update();
            break;
        case 'delete':
            require_once 'controllerUsuario.php';
            $loadClass = new controllerUsuario();
            $loadClass->delete();
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
    }
}
