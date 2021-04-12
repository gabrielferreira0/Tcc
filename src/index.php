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
    <i class="fas fa-toolbox logo"></i>
    <a class="navbar-brand arredondar " href=""> Treinando</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse menu" id="navbarCollapse">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link arredondar" href="" target="_blank">Trabalhe Conosco</a>
            </li>
            <li class="nav-item">
                <a class="nav-link arredondar" href="#sobre">Sobre Nós</a>
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
        <div class="d-flex justify-content-start ">

            <?php

            if (isset ($_SESSION['CPF'])) {
                echo '<div class="d-flex justify-content-center">
                    <span style="color: lightgray" class="nav-link arredondar" href="Perfil.php">Bem vindo ,  ' . $_SESSION['User'] . '</span>
                   </div>';
            }
            ?>

            <?php
            if (isset ($_SESSION['CPF'])) {
                echo '<div class="d-flex justify-content-start">
            <a class="nav-link text-center Registrar" id="Deslogar">Sair</a>
        </div>';
            } else {
                echo '  <div class="d-flex justify-content-md-center ">
            <a class="nav-link  text-center loginInput" id="Login">Login</a>
            <a class="nav-link text-center Registrar" id="Registrar">Cadastrar</a>
        </div>';
            }
            ?>


        </div>
    </div>
</div>


<div class="container-fluid ">
    <div class="d-flex justify-content-center geral">
        <div class="card cardFormulario" id="cardCadastro" style="display: none;">
            <!--            inicia aqui-->
            <div class="card-body">
                <h3 class="text-center titulo"> Cadastro <i class="fas fa-address-card"></i></h3>
                <form id="formularioCadastro" class="formulario" data-toggle="validator" enctype="multipart/form-data">

                    <div class="d-flex justify-content-center galeria">
                        <div class="d-flex align-items-center d-flex justify-content-center col-4 col-md-4" id="foto"
                             title="Foto de perfil">
                            <h1 class="fas fa-user"></h1>
                        </div>
                    </div>
                    <div style="display: none">
                        <input type="file" multiple id="addFotoGaleria" accept="image/x-png,image/gif,image/jpeg">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Senha">Usuario:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-lock"></i></span>
                                </div>
                                <input type="text" class="form-control arredondar" id="Username" placeholder="Usuario"
                                       maxlength="20" required="">
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Senha">Senha:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control arredondar" id="Senha" placeholder="Senha"
                                       maxlength="20" required="">
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-envelope"></i></span>
                            </div>
                            <label for="Email"></label>
                            <input type="email" class="form-control arredondar" id="Email"
                                   placeholder="nome@exemplo.com" data-error="Por favor, informe um email valido."
                                   required="">
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xl-6">
                            <label for="CPF">CPF:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-id-card-alt"></i></span>
                                </div>
                                <input type="text" class="form-control arredondar" id="CPF" placeholder="123.123.123-00"
                                       data-error="Por favor, informe um CPF correto." required="">
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="Telefone">Telefone:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control arredondar phone-mask" id="Telefone"
                                       placeholder="(DD) 0000-0000" required="">
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>

<!--                    <div class="form-row">-->
<!--                        <div class="form-group col-xl-6">-->
<!--                            <label for="CPF">CEP:</label>-->
<!--                            <div class="input-group">-->
<!--                                <div class="input-group-prepend">-->
<!--                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>-->
<!--                                </div>-->
<!--                                <label for="CEP"></label>-->
<!--                                <input type="text" class="form-control arredondar" onblur="carregarCEP()" id="CEP"-->
<!--                                       placeholder="12.123-123" data-error="Por favor, informe um CEP correto."-->
<!--                                       required="">-->
<!--                            </div>-->
<!--                            <div class="error help-block with-errors"></div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group col-xl-6">-->
<!--                            <label for="CPF">Logradouro:</label>-->
<!--                            <div class="input-group">-->
<!--                                <div class="input-group-prepend">-->
<!--                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>-->
<!--                                </div>-->
<!--                                <label for="Logradouro"></label>-->
<!--                                <input type="text" class="form-control arredondar" id="Logradouro"-->
<!--                                       data-error="Por favor, informe um Logradouro correto." required="">-->
<!--                            </div>-->
<!--                            <div class="error help-block with-errors"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-row">-->
<!--                        <div class="form-group col-xl-6">-->
<!--                            <label for="CPF">Complemento:</label>-->
<!--                            <div class="input-group">-->
<!--                                <div class="input-group-prepend">-->
<!--                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>-->
<!--                                </div>-->
<!--                                <label for="Complemento"></label>-->
<!--                                <input type="text" class="form-control arredondar" id="Complemento"-->
<!--                                       data-error="Por favor, informe um Complemento correto." required="">-->
<!--                            </div>-->
<!--                            <div class="error help-block with-errors"></div>-->
<!--                        </div>-->
<!--                        <div class="form-group col-xl-6">-->
<!--                            <label for="CPF">Bairro:</label>-->
<!--                            <div class="input-group">-->
<!--                                <div class="input-group-prepend">-->
<!--                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>-->
<!--                                </div>-->
<!--                                <label for="Bairro"></label>-->
<!--                                <input type="text" class="form-control arredondar" id="Bairro"-->
<!--                                       data-error="Por favor, informe um Bairro correto." required="">-->
<!--                            </div>-->
<!--                            <div class="error help-block with-errors"></div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                    <div class="form-row">-->
<!--                        <div class="form-group col-xl-8">-->
<!--                            <label for="Cidade">Cidade:</label>-->
<!--                            <div class="input-group ">-->
<!--                                <div class="input-group-prepend">-->
<!--                                    <span class="input-group-text arredondar"> <i class="fas fa-city"></i></span>-->
<!--                                </div>-->
<!--                                <input type="text" class="form-control" id="Cidade" placeholder="Brasilia-DF"-->
<!--                                       required="">-->
<!--                                <div class="input-group-append">-->
<!--                                    <label for="UF"></label>-->
<!--                                    <select class="form-control " id="UF" required="">-->
<!--                                        <option value="">UF</option>-->
<!--                                        <option value="AC">AC</option>-->
<!--                                        <option value="AL">AL</option>-->
<!--                                        <option value="AP">AP</option>-->
<!--                                        <option value="AM">AM</option>-->
<!--                                        <option value="BA">BA</option>-->
<!--                                        <option value="CE">CE</option>-->
<!--                                        <option value="DF">DF</option>-->
<!--                                        <option value="ES">ES</option>-->
<!--                                        <option value="GO">GO</option>-->
<!--                                        <option value="MA">MA</option>-->
<!--                                        <option value="MT">MT</option>-->
<!--                                        <option value="MS">MS</option>-->
<!--                                        <option value="MG">MG</option>-->
<!--                                        <option value="PA">PA</option>-->
<!--                                        <option value="PB">PB</option>-->
<!--                                        <option value="PR">PR</option>-->
<!--                                        <option value="PE">PE</option>-->
<!--                                        <option value="PI">PI</option>-->
<!--                                        <option value="RJ">RJ</option>-->
<!--                                        <option value="RN">RN</option>-->
<!--                                        <option value="RS">RS</option>-->
<!--                                        <option value="RO">RO</option>-->
<!--                                        <option value="RR">RR</option>-->
<!--                                        <option value="SC">SC</option>-->
<!--                                        <option value="SP">SP</option>-->
<!--                                        <option value="SE">SE</option>-->
<!--                                        <option value="TO">TO</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="error help-block with-errors"></div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->

                    <div class="form-group" style="display: flex; justify-content:flex-end;">
                        <button id="cadastrar" type="button" class="btn btn-success">Cadastrar</button>
                    </div>

                    <div class="alert alert-danger testando text-center" id="alerta2" role="alert"
                         style="display: none;">
                        <strong>Erro! </strong> Seu cadastro <strong>não foi realizado!</strong>
                    </div>
                    <div class="alert alert-danger testando text-center" id="alerta3" role="alert"
                         style="display: none;">
                        <strong>Erro! </strong> Username <strong>já cadastrado!</strong>
                    </div>
                    <div class="alert alert-danger testando text-center" id="alerta4" role="alert"
                         style="display: none;">
                        <strong>Erro! </strong> Email <strong>já cadastrado!</strong>
                    </div>
                    <div class="alert alert-danger testando text-center" id="alerta5" role="alert"
                         style="display: none;">
                        <strong>Erro! </strong> CPF <strong>já cadastrado!</strong>
                    </div>

                    <div class="alert alert-danger testando text-center" id="alerta6" role="alert"
                         style="display: none; justify-content: flex-start;">
                        <strong>Erro! </strong> Preencha <strong> todos os campos! </strong>
                    </div>

                    <div class="alert alert-danger testando text-center" id="alerta7" role="alert"
                         style="display: none; justify-content: flex-start;">
                        <strong>Erro! </strong> CPF <strong> Inválido !</strong>
                    </div>
                </form>
            </div>
            <!--            termina aqui-->
        </div>
        <div class="card cardFormulario col-md-3" id="cardLogin" style="display: none">
            <div class="card-body" id="card-body">
                <h3 class="text-center titulo"> Login <i class="fas fa-users"></i></h3>
                <form id="formularioLogin" class="formulario" data-toggle="validator">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="CPF">CPF:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-id-card-alt"></i></span>
                                </div>
                                <input type="text" class="form-control arredondar" id="CPF-login"
                                       placeholder="123.123.123-00"
                                       max="11" data-error="Por favor, informe um CPF correto." required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Senha">Senha:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control arredondar" id="senha-login"
                                       placeholder="Senha"
                                       maxlength="20" required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>
                </form>
            </div>
            <button id="Logar" type="button" class="Entrar btn btn btn arredondar">Login</button>
            <a href="#!" class="login-card-footer-text">Esqueceu a senha?</a>
            <p class="login-card-footer-text">Não possui uma conta? <a href="index.php" class="login-card-footer-text">Cadastrar-se
                    aqui</a></p>
        </div>
            <div class="container"  id="cardServicos">

                <div class="card-deck">

                    <div class="card col-md-4 cardFormularioSrv">
                        <img class="card-img-top"
                             src="https://i.pinimg.com/564x/d3/82/f1/d382f1287cfd6bfc7b7c2bd57f04184d.jpg"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">Eletricista</h5>
                            <div class="form-group" style="display: flex; justify-content:center;">
                                <button type="button" class="Entrar btn btn btn arredondar">Acessar</button>
                            </div>

                        </div>
                    </div>

                    <div class="card col-md-4  cardFormularioSrv">
                        <img class="card-img-top"
                             src="https://i.pinimg.com/564x/49/bc/4b/49bc4ba9caadf877ce63528634371d91.jpg"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">Encanador</h5>
                            <div class="form-group" style="display: flex; justify-content:center;">
                                <button type="button" class="Entrar btn btn btn arredondar">Acessar</button>
                            </div>

                        </div>
                    </div>

                    <div class="card col-md-4  cardFormularioSrv">
                        <img class="card-img-top"
                             src="https://i.pinimg.com/564x/3b/75/27/3b75276562539e2fc3b073bc2cc83009.jpg"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">Soldador</h5>
                            <div class="form-group" style="display: flex; justify-content:center;">
                                <button type="button" class="Entrar btn btn btn arredondar">Acessar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>


<section class="page-section geral" id="sobre">
    <div class="container">
        <div class="text-center">
            <h1 class="text-center"> Sobre nós</h1>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-bullseye fa-stack-1x fa-inverse"></i>
                        </span>
                <h4 class="my-3">Missão</h4>
                <p>Proporcionar um ambiente onde as pessoas encontrarão os melhores profissionais de serviços de
                    pequenos reparos com base nas recomendações de seus clientes, permitindo que os melhores
                    profissionais mantenham a continuidade de seus trabalhos.</p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-eye fa-stack-1x fa-inverse"></i>
                        </span>
                <h4 class="my-3">Visão</h4>
                <p>Ser referência no mercado de pequenos reparos para quem busca ou presta esse serviço.</p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-handshake fa-stack-1x fa-inverse"></i>
                        </span>
                <h4 class="my-3">Valores</h4>
                <p>Nossos valores são transparência, confiança, responsabilidade nos serviços oferecidos para os
                    clientes e profissionais.</p>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark ">
    <!-- Copyright -->
    <div style="color:aliceblue;" class="footer-copyright text-center py-3">© 2020 desenvolvido por:
        <a> @Gabrovsski </a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
</body>
