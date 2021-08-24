<head>
    <title>Cadastro parceiro</title>
    <?php
    include('Head.php');
    ?>
</head>

<script>
    function etapa1() {
        $("#etapa1").hide();
        $("#etapa2").show();
    }

    function voltar1() {
        $("#etapa1").show();
        $("#etapa2").hide();
    }

</script>


<body id="Conteudo">

<!-- navbar-->
<div class="navbar  navbar-expand-sm  navbar-dark  mb-4 " role="navigation" style="background: #202020;">


    <a style="text-decoration:none;" href=" ../index.php">
        <img class="logo" src="../imagens/logo.png" alt="logo">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse menu" id="navbarCollapse">

        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link arredondar" href="../View/parceiroForm.php" target="_blank"><i
                            class="fas fa-handshake"></i> Seja um parceiro!</a>
            </li>
            <li class="nav-item">
                <a style="cursor:pointer" class="nav-link arredondar" href="../index.php#sobre"><i
                            class="fas fa-building"></i> Sobre Nós</a>
            </li>
            <li class="nav-item">
                <a style="cursor:pointer" class="nav-link arredondar" href="../index.php#suporte">
                    <img style="height: 1.7rem" src="../imagens/svg/icone-suporte-azul.svg" alt="">Suporte</a>
            </li>

            <?php
            session_start();
            if (isset($_SESSION['CPF'])) {
                echo '<li class="nav-item">
                        <a class="nav-link arredondar" href="../View/Perfil.php"><i class="fas fa-user-circle"></i> Perfil</a>
                       </li>';
            }
            if (isset($_SESSION['CPF']) && $_SESSION['Tipo'] == '1') {
                echo '<li class="nav-item">
                        <a class="nav-link arredondar" href="../View/Painel.php"><i class="fas fa-cogs"></i> Painel</a>
                       </li>';
            }
            ?>
        </ul>

        <div class="d-flex justify-content-center align-items-center">
            <?php

            if (isset($_SESSION['CPF']) && $_SESSION['Foto'] != 'false') {
                echo '<span style="color: lightgray" class="nav-link arredondar" href="View/Perfil.php">' . $_SESSION['User'] . '</span>';
                echo '<a href="View/Perfil.php"> <img  class = "avatar" src="../imagens/usuarios/' . $_SESSION['Foto'] . '" > </a>';
            } elseif (isset($_SESSION['CPF']) && $_SESSION['Foto'] == 'false') {
                echo '<span style="color: lightgray" class="nav-link arredondar" href="View/Perfil.php">' . $_SESSION['User'] . '</span>';
                echo '<span class="fa fa-user-circle photo text-center"></span>';
            }
            ?>

        </div>
        <?php
        if (isset($_SESSION['CPF'])) {
            echo '
            <a class="nav-link text-center Deslogar" id="Deslogar2">Sair</a>';
        } else {
            echo '<a class="nav-link  text-center loginInput" href="../index.php" style="color: white">Login</a>
            <a class="nav-link text-center Registrar" href="../index.php" style="color: white">Cadastrar</a>';
        }
        ?>
    </div>
</div>
<!-- FIM navbar-->

<div class="container parceiro col-12 col-md-11">
    <div class="text-center" style="margin-bottom: 2rem">
        <h1 style="font-family: 'Oswald', sans-serif;" class="text-center ">Realize seu cadastro e consiga mais
            clientes</h1>
    </div>
    <div style="margin:0" class="row text-center col-12">
        <div class="col-md-5 col-12">
            <img src="../imagens/svg/Business%20deal-pana.svg" alt="logo-profissional">
        </div>

        <div class="col-md-6">
            <!-- FORM Cadastro-->
            <div style="display:block;background: transparent" class="card" id="etapa1">
                <!--            inicia aqui-->
                <div class="card-body">
                    <form id="formEtapa1" class="formulario" data-toggle="validator"
                          enctype="multipart/form-data">

                        <div class="d-flex justify-content-center">
                            <h3>Foto perfil:</h3>
                        </div>
                        <div class="d-flex justify-content-center galeria">

                            <div class="d-flex align-items-center d-flex justify-content-center col-4 col-md-4"
                                 id="foto"
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
                                        <span class="input-group-text arredondar"> <i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar" id="Username"
                                           placeholder="Usuario"
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
                                    <input type="password" class="form-control arredondar" id="Senha"
                                           placeholder="Senha"
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
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-id-card-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar" id="CPF"
                                           placeholder="123.123.123-00"
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


                        <div class="row">
                            <div class="col-12 col-md-12 -row">
                                <button onclick="etapa1()" type="button" class="btn btn-success">Avançar</button>
                            </div>
                        </div>

                        <span style="border-bottom: 1px solid white"> Etapa 1 de 3.</span>

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
            <div style=" display:none;background: transparent" class="card" id="etapa2">
                <!--            inicia aqui-->
                <div class="card-body">
                    <h3 class="text-center titulo"> Cadastro <i class="fas fa-address-card"></i></h3>
                    <form id="formEtapa2" class="formulario" data-toggle="validator"
                          enctype="multipart/form-data">

                        <div class="form-row">
                            <div class="form-group col-xl-6">
                                <label for="CPF">CEP:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <label for="CEP"></label>
                                    <input type="text" class="form-control arredondar" onblur="carregarCEP()" id="CEP"
                                           placeholder="12.123-123" data-error="Por favor, informe um CEP correto."
                                           required="">
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>

                            <div class="form-group col-xl-6">
                                <label for="CPF">Logradouro:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <label for="Logradouro"></label>
                                    <input type="text" class="form-control arredondar" id="Logradouro"
                                           data-error="Por favor, informe um Logradouro correto." required="">
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-6">
                                <label for="CPF">Complemento:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <label for="Complemento"></label>
                                    <input type="text" class="form-control arredondar" id="Complemento"
                                           data-error="Por favor, informe um Complemento correto." required="">
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="CPF">Bairro:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <label for="Bairro"></label>
                                    <input type="text" class="form-control arredondar" id="Bairro"
                                           data-error="Por favor, informe um Bairro correto." required="">
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-8">
                                <label for="Cidade">Cidade:</label>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-city"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="Cidade" placeholder="Brasilia-DF"
                                           required="">
                                    <div class="input-group-append">
                                        <label for="UF"></label>
                                        <select class="form-control " id="UF" required="">
                                            <option value="">UF</option>
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

                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 btn-row">
                                <button id="" onclick="voltar1()" type="button" class="btn btn-info">Voltar</button>
                                <button id="" type="button" class="btn btn-success">Avançar</button>
                            </div>
                        </div>

                        <span style="border-bottom: 1px solid white"> Etapa 2 de 3.</span>
                    </form>
                </div>
                <!--            termina aqui-->
            </div>
            <!-- FIM FORM Cadastro-->
        </div>

    </div>
</div>

<?php
include('Footer.php');
?>

</body>