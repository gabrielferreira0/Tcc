<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro teste</title>
    <link href="View/docs/fonts/fontawesome/5.12.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="View/docs/plugins/bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <script src="View/docs/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="View/docs/plugins/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    <script src="View/docs/plugins/bootstrap-4.1.3-dist/js/popper.min.js"></script>
    <script src="View/docs/plugins/jquery/jquery.mask.js"></script>
    <script src="View/docs/plugins/bootbox/bootbox.all.min.js"></script>
    <script src="View/docs/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="View/docs/js/script.js"></script>
    <link rel="stylesheet" href="View/docs/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <script src="View/docs/plugins/bootstrap-4.1.3-dist/js/validator.min.js"></script>
</head>

<body id="Conteudo">

<div class="navbar  navbar-expand-sm  navbar-dark bg-dark mb-4 menu " role="navigation">
    <i class="fas fa-user-astronaut nasa"></i>
    <a class="navbar-brand arredondar " href="">Treinando</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse menu" id="navbarCollapse">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link arredondar" href="" target="_blank">Contato</a>
            </li>
            <li class="nav-item">
                <a class="nav-link arredondar" href="" target="_blank">Sobre Nós</a>
            </li>
            <?php
            session_start();
            if (isset ($_SESSION['CPF'])) {
                echo '<li class="nav-item">
                        <a class="nav-link arredondar" href="Perfil.php">Perfil</a>
                       </li>';
            }
            ?>
        </ul>

        <?php

        if (isset ($_SESSION['CPF'])) {
            echo '<div class="d-flex justify-content-center">
                    <span style="color: lightgray" class="nav-link arredondar" href="Perfil.php">Bem vindo ,  ' . $_SESSION['User'] . '</span>
                   </div>';
        }
        ?>

        <?php
        if (isset ($_SESSION['CPF'])) {
            echo '<div class="d-flex justify-content-center">
            <a class="nav-link text-center Registrar" id="Deslogar">Sair</a>
        </div>';
        } else {
            echo '  <div class="d-flex justify-content-center">
            <a class="nav-link  text-center loginInput" id="Login">Login</a>
            <a class="nav-link text-center Registrar" id="Registrar">Cadastrar</a>
        </div>';
        }
        ?>

        <div class="d-flex align-items-center ">
            <input class="form-control mr-sm-2 " type="text" placeholder="Pesquisar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
        </div>
    </div>
</div>


<div class="container-fluid ">
    <div class="d-flex justify-content-center geral">
        <div class="card cardFormulario">
            <div class="container">
                <div class="row">
                    <div class="card col-md-4 cardFormulario">
                        <img class="card-img-top"
                             src="https://i.pinimg.com/564x/d3/82/f1/d382f1287cfd6bfc7b7c2bd57f04184d.jpg"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">Eletricista</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <div class="form-group" style="display: flex; justify-content:flex-end;">
                                <button type="button" class="Entrar btn btn btn arredondar">Acessar</button>
                            </div>

                        </div>
                    </div>

                    <div class="card col-md-4  cardFormulario">
                        <img class="card-img-top"
                             src="https://i.pinimg.com/564x/49/bc/4b/49bc4ba9caadf877ce63528634371d91.jpg"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">Encanador</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <div class="form-group" style="display: flex; justify-content:flex-end;">
                                <button type="button" class="Entrar btn btn btn arredondar">Acessar</button>
                            </div>

                        </div>
                    </div>

                    <div class="card col-md-4  cardFormulario">
                        <img class="card-img-top"
                             src="https://i.pinimg.com/564x/3b/75/27/3b75276562539e2fc3b073bc2cc83009.jpg"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">Soldador</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <div class="form-group" style="display: flex; justify-content:flex-end;">
                                <button type="button" class="Entrar btn btn btn arredondar">Acessar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="bg-dark ">
    <!-- Copyright -->
    <div style="color:aliceblue;" class="footer-copyright text-center py-3">© 2020 desenvolvido por:
        <a> @Gabrovsski </a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
</body>