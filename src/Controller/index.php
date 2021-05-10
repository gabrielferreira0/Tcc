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
        case 'salvarCat':
            require_once 'controllerCategoria.php';
            $loadClass = new controllerCategoria();
            echo $loadClass->setCategoria();
            break;
    }
}
