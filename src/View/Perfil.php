<?php
session_start();
include ('class/verificar_login.php')
?>

<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro teste</title>
    <link href="docs/fonts/fontawesome/5.12.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="docs/plugins/bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <script src="docs/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="docs/plugins/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    <script src="docs/plugins/bootstrap-4.1.3-dist/js/popper.min.js"></script>
    <script src="docs/plugins/jquery/jquery.mask.js"></script>
    <script src="docs/plugins/bootbox/bootbox.all.min.js"></script>
    <script src="docs/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="docs/js/script.js"></script>
    <link rel="stylesheet" href="docs/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <script src="docs/plugins/bootstrap-4.1.3-dist/js/validator.min.js"></script>
</head>

<body id="Conteudo">
<div class="navbar  navbar-expand-sm  navbar-dark bg-dark mb-4 menu " role="navigation">
    <i class="fas fa-user-astronaut nasa"></i>
    <a class="navbar-brand arredondar " href="index.php">Treinando </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse menu" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link arredondar" href="" >Contato</a>
            </li>
            <li class="nav-item">
                <a class="nav-link arredondar" href="" target="_blank">Sobre Nós</a>
            </li>

            <li class="nav-item">
                <a class="nav-link arredondar selected" href="Perfil.php">Perfil</a>
            </li>

        </ul>

        <div class="d-flex justify-content-center">
            <span  id ='Welcome' style="color: lightgray" class="nav-link arredondar" href="Perfil.php">Bem vindo, <?php echo $_SESSION['User']; ?></span>
        </div>

        <div class="d-flex justify-content-center">
            <!--            <a class="nav-link  text-center loginInput" id='Login'>Login</a>-->
            <a class="nav-link text-center Registrar" id='Deslogar'>Sair</a>
        </div>

        <div class="d-flex align-items-center ">
            <input class="form-control mr-sm-2 " type="text" placeholder="Pesquisar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
        </div>
    </div>
</div>
<div class="container-fluid ">
    <div class="d-flex justify-content-center geral">
        <div class="card cardFormulario">
            <!--            inicia aqui-->
            <div class="card-body">
                <h3 class="text-center titulo"> Perfil <i class="fas fa-address-card"></i></h3>
                <form id="formulario" class="formulario" data-toggle="validator">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Username">Usuario:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-user"></i></span>
                                </div>
                                <input  value="<?php echo $_SESSION['User']; ?>"  type="text" class="form-control arredondar" id="Username" placeholder="Usuario"
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Senha">Senha:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-lock"></i></span>
                                </div>
                                <input value="<?php echo $_SESSION['Password']; ?>" type="text" class="form-control arredondar" id="Senha" placeholder="Senha"
                                       maxlength="20" required>
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
                            <input  value="<?php echo $_SESSION['Email']; ?>" type="email" class="form-control arredondar" id="Email"
                                   placeholder="nome@exemplo.com" data-error="Por favor, informe um email valido."
                                   disabled>
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
                                <input  value="<?php echo $_SESSION['CPF']; ?>" type="text" class="form-control arredondar" id="CPF" placeholder="123.123.123-00"
                                       data-error="Por favor, informe um CPF correto." disabled>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>

                        <div class="form-group col-xl-6">
                            <label for="dt-nascimento">Data de nascimento:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i
                                                class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input  value="<?php echo $_SESSION['Nascimento']; ?>"  type="date" class="form-control arredondar" id="dt-nascimento"
                                       placeholder="Nascimento" required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xl-6">
                            <label for="Cidade">Cidade:</label>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-city"></i></span>
                                </div>

                                <input  value="<?php echo $_SESSION['Cidade']; ?>" type="text" class="form-control" id="Cidade"
                                       placeholder="Brasilia-DF" required>
                                <div class="input-group-append">
                                    <select class="form-control " id="UF" required>
                                        <option id="UF2" value="<?php echo $_SESSION['UF']; ?>"><?php echo $_SESSION['UF']; ?></option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="Telefone">Telefone:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-phone"></i></span>
                                </div>
                                <input   value="<?php echo $_SESSION['Telefone']; ?>" type="text" class="form-control arredondar phone-mask" id="Telefone"
                                       placeholder="(DD) 0000-0000" required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; justify-content:flex-end;">
                        <button  style="margin:3px;"  id="Excluir"  type="button" class="btn btn-danger">Excluir</button>
                        <button  style="margin:3px;"  id="Alterar"  type="button" class="btn btn-primary">Alterar</button>
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