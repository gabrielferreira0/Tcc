<head>
    <title>Cadastro parceiro</title>
    <?php
    session_start();
    include('Head.php');
    ?>
</head>

<script>
    let username;
    let senha;
    let email;
    let foto;
    let fotoStatus;
    let CPF;
    let telefone;
    let CEP;
    let logradouro;
    let complemento;
    let bairro;
    let cidade;
    let UF;
    let banco;
    let agencia;
    let conta;


    function etapa1() {

        username = $("#Username").val();
        senha = $("#Senha").val();
        email = $("#Email").val();
        foto = $('#addFotoGaleria')[0].files[0];
        fotoStatus;
        CPF = $("#CPF").val().replace(/[^\d]+/g, '')
        telefone = $("#Telefone").val().replace('-', '')


        if (username == "" || senha == "" || email == "" || CPF == "" || telefone == "") {
            $("#alerta6").show().fadeOut(4000);
        } else {
            $("#etapa1").hide();
            $("#etapa2").show();
        }
    }

    function etapa2() {
        CEP = $("#CEP").val().replace(/[^\d]+/g, '');
        logradouro = $("#Logradouro").val();
        complemento = $("#Complemento").val();
        bairro = $("#Bairro").val();
        cidade = $("#Cidade").val();
        UF = $("#UF").val();


        if (CEP == "" || logradouro == "" || bairro == "" || cidade == "" || UF == "") {
            $("#alerta6").show().fadeOut(4000);
        } else {
            $("#etapa2").hide();
            $("#etapa3").show();
        }


    }

    function voltar1() {
        $("#etapa1").show();
        $("#etapa2").hide();
    }

    function voltar2() {
        $("#etapa2").show();
        $("#etapa3").hide();
    }

    function cadastrarParceiro() {
        banco = $("#banco").val();
        agencia = $("#agencia").val();
        conta = $("#conta").val();

        if (banco == "" || agencia == "" || conta == "") {
            $("#alerta6").show().fadeOut(4000);
        } else {
            let formData = new FormData();
            if (!foto) {
                fotoStatus = 'false'
            } else {
                fotoStatus = 'true'
            }
            formData.append('username', username);
            formData.append('senha', senha);
            formData.append('email', email);
            formData.append('CPF', CPF);
            formData.append('foto', foto);
            formData.append('fotoStatus', fotoStatus);
            formData.append('telefone', telefone);
            formData.append('CEP', CEP);
            formData.append('logradouro', logradouro);
            formData.append('complemento', complemento);
            formData.append('bairro', bairro);
            formData.append('cidade', cidade);
            formData.append('UF', UF);
            formData.append('banco', banco);
            formData.append('agencia', agencia);
            formData.append('conta', conta);
            formData.append('rq', 'cadastrarParceiro');
            let url = '../Controller/index.php';
            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                contentType: false,
                processData: false,
                data: formData,
                success: function (rs) {
                    switch (rs) {
                        case 'nomeC':
                            $("#alerta3").show().fadeOut(4000);
                            break;
                        case 'emailC':
                            $("#alerta4").show().fadeOut(4000);
                            break;
                            s
                        case 'cpfC':
                            $("#alerta5").show().fadeOut(4000);
                            break;
                        case 'CPFinvalido':
                            $("#alerta7").show().fadeOut(4000);
                            break;
                        case 'sucesso':
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Cadastro realizado com sucesso!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#Email").val("");
                            $("#Username").val("");
                            $("#CPF").val("");
                            $("#Senha").val("");
                            $("#Telefone").val("");
                            break;
                    }

                },
                error: function (e) {
                    bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
                }
            });
        }

    };


</script>

<?php
// bancos brasileiros
$bancos = array(
    array('code' => '001', 'name' => 'Banco do Brasil'),
    array('code' => '003', 'name' => 'Banco da Amazônia'),
    array('code' => '004', 'name' => 'Banco do Nordeste'),
    array('code' => '021', 'name' => 'Banestes'),
    array('code' => '025', 'name' => 'Banco Alfa'),
    array('code' => '027', 'name' => 'Besc'),
    array('code' => '029', 'name' => 'Banerj'),
    array('code' => '031', 'name' => 'Banco Beg'),
    array('code' => '033', 'name' => 'Banco Santander Banespa'),
    array('code' => '036', 'name' => 'Banco Bem'),
    array('code' => '037', 'name' => 'Banpará'),
    array('code' => '038', 'name' => 'Banestado'),
    array('code' => '039', 'name' => 'BEP'),
    array('code' => '040', 'name' => 'Banco Cargill'),
    array('code' => '041', 'name' => 'Banrisul'),
    array('code' => '044', 'name' => 'BVA'),
    array('code' => '045', 'name' => 'Banco Opportunity'),
    array('code' => '047', 'name' => 'Banese'),
    array('code' => '062', 'name' => 'Hipercard'),
    array('code' => '063', 'name' => 'Ibibank'),
    array('code' => '065', 'name' => 'Lemon Bank'),
    array('code' => '066', 'name' => 'Banco Morgan Stanley Dean Witter'),
    array('code' => '069', 'name' => 'BPN Brasil'),
    array('code' => '070', 'name' => 'Banco de Brasília - BRB'),
    array('code' => '072', 'name' => 'Banco Rural'),
    array('code' => '073', 'name' => 'Banco Popular'),
    array('code' => '074', 'name' => 'Banco J. Safra'),
    array('code' => '075', 'name' => 'Banco CR2'),
    array('code' => '076', 'name' => 'Banco KDB'),
    array('code' => '096', 'name' => 'Banco BMF'),
    array('code' => '104', 'name' => 'Caixa Econômica Federal'),
    array('code' => '107', 'name' => 'Banco BBM'),
    array('code' => '116', 'name' => 'Banco Único'),
    array('code' => '151', 'name' => 'Nossa Caixa'),
    array('code' => '175', 'name' => 'Banco Finasa'),
    array('code' => '184', 'name' => 'Banco Itaú BBA'),
    array('code' => '204', 'name' => 'American Express Bank'),
    array('code' => '208', 'name' => 'Banco Pactual'),
    array('code' => '212', 'name' => 'Banco Matone'),
    array('code' => '213', 'name' => 'Banco Arbi'),
    array('code' => '214', 'name' => 'Banco Dibens'),
    array('code' => '217', 'name' => 'Banco Joh Deere'),
    array('code' => '218', 'name' => 'Banco Bonsucesso'),
    array('code' => '222', 'name' => 'Banco Calyon Brasil'),
    array('code' => '224', 'name' => 'Banco Fibra'),
    array('code' => '225', 'name' => 'Banco Brascan'),
    array('code' => '229', 'name' => 'Banco Cruzeiro'),
    array('code' => '230', 'name' => 'Unicard'),
    array('code' => '233', 'name' => 'Banco GE Capital'),
    array('code' => '237', 'name' => 'Bradesco'),
    array('code' => '241', 'name' => 'Banco Clássico'),
    array('code' => '243', 'name' => 'Banco Stock Máxima'),
    array('code' => '246', 'name' => 'Banco ABC Brasil'),
    array('code' => '248', 'name' => 'Banco Boavista Interatlântico'),
    array('code' => '249', 'name' => 'Investcred Unibanco'),
    array('code' => '250', 'name' => 'Banco Schahin'),
    array('code' => '252', 'name' => 'Fininvest'),
    array('code' => '254', 'name' => 'Paraná Banco'),
    array('code' => '263', 'name' => 'Banco Cacique'),
    array('code' => '265', 'name' => 'Banco Fator'),
    array('code' => '266', 'name' => 'Banco Cédula'),
    array('code' => '300', 'name' => 'Banco de la Nación Argentina'),
    array('code' => '318', 'name' => 'Banco BMG'),
    array('code' => '320', 'name' => 'Banco Industrial e Comercial'),
    array('code' => '356', 'name' => 'ABN Amro Real'),
    array('code' => '341', 'name' => 'Itau'),
    array('code' => '347', 'name' => 'Sudameris'),
    array('code' => '351', 'name' => 'Banco Santander'),
    array('code' => '353', 'name' => 'Banco Santander Brasil'),
    array('code' => '366', 'name' => 'Banco Societe Generale Brasil'),
    array('code' => '370', 'name' => 'Banco WestLB'),
    array('code' => '376', 'name' => 'JP Morgan'),
    array('code' => '389', 'name' => 'Banco Mercantil do Brasil'),
    array('code' => '394', 'name' => 'Banco Mercantil de Crédito'),
    array('code' => '399', 'name' => 'HSBC'),
    array('code' => '409', 'name' => 'Unibanco'),
    array('code' => '412', 'name' => 'Banco Capital'),
    array('code' => '422', 'name' => 'Banco Safra'),
    array('code' => '453', 'name' => 'Banco Rural'),
    array('code' => '456', 'name' => 'Banco Tokyo Mitsubishi UFJ'),
    array('code' => '464', 'name' => 'Banco Sumitomo Mitsui Brasileiro'),
    array('code' => '477', 'name' => 'Citibank'),
    array('code' => '479', 'name' => 'Itaubank (antigo Bank Boston)'),
    array('code' => '487', 'name' => 'Deutsche Bank'),
    array('code' => '488', 'name' => 'Garantia do Banco Morgan'),
    array('code' => '492', 'name' => 'Banco NMB Postbank'),
    array('code' => '494', 'name' => 'Banco la República Oriental del Uruguay'),
    array('code' => '495', 'name' => 'Banco La Provincia de Buenos Aires'),
    array('code' => '505', 'name' => 'Banco Credit Suisse'),
    array('code' => '600', 'name' => 'Banco Luso Brasileiro'),
    array('code' => '604', 'name' => 'Banco Industrial'),
    array('code' => '610', 'name' => 'Banco VR'),
    array('code' => '611', 'name' => 'Banco Paulista'),
    array('code' => '612', 'name' => 'Banco Guanabara'),
    array('code' => '613', 'name' => 'Banco Pecunia'),
    array('code' => '623', 'name' => 'Banco Panamericano'),
    array('code' => '626', 'name' => 'Banco Ficsa'),
    array('code' => '630', 'name' => 'Banco Intercap'),
    array('code' => '633', 'name' => 'Banco Rendimento'),
    array('code' => '634', 'name' => 'Banco Triângulo'),
    array('code' => '637', 'name' => 'Banco Sofisa'),
    array('code' => '638', 'name' => 'Banco Prosper'),
    array('code' => '643', 'name' => 'Banco Pine'),
    array('code' => '652', 'name' => 'Itaú Holding Financeira'),
    array('code' => '653', 'name' => 'Banco Indusval'),
    array('code' => '654', 'name' => 'Banco AJ Renner'),
    array('code' => '655', 'name' => 'Banco Votorantim'),
    array('code' => '707', 'name' => 'Banco Daycoval'),
    array('code' => '719', 'name' => 'Banif'),
    array('code' => '721', 'name' => 'Banco Credibel'),
    array('code' => '734', 'name' => 'Banco Gerdau'),
    array('code' => '735', 'name' => 'Banco Pottencial'),
    array('code' => '738', 'name' => 'Banco Morada'),
    array('code' => '739', 'name' => 'Banco Galvão de Negócios'),
    array('code' => '740', 'name' => 'Banco Barclays'),
    array('code' => '741', 'name' => 'BRP'),
    array('code' => '743', 'name' => 'Banco Semear'),
    array('code' => '745', 'name' => 'Banco Citibank'),
    array('code' => '746', 'name' => 'Banco Modal'),
    array('code' => '747', 'name' => 'Banco Rabobank International'),
    array('code' => '748', 'name' => 'Banco Cooperativo Sicredi'),
    array('code' => '749', 'name' => 'Banco Simples'),
    array('code' => '751', 'name' => 'Dresdner Bank'),
    array('code' => '752', 'name' => 'BNP Paribas'),
    array('code' => '753', 'name' => 'Banco Comercial Uruguai'),
    array('code' => '755', 'name' => 'Banco Merrill Lynch'),
    array('code' => '756', 'name' => 'Banco Cooperativo do Brasil'),
    array('code' => '757', 'name' => 'KEB'),
);
?>


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
            if (isset($_SESSION['CPF'])) {
                echo '<li class="nav-item">
                        <a class="nav-link arredondar" href="../View/Perfil.php"><i class="fas fa-user-circle"></i> Perfil</a>
                       </li>';

                echo '<li class="nav-item">
                        <a class="nav-link arredondar" href="MeusServicos.php"><i class="fas fa-briefcase"></i> Meus serviços</a>
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
                echo '<span class="fa fa-user-circle photo text-center iconeNavBar"></span>';
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

        <div class="col-md-5  offset-md-1">
            <!-- FORM Cadastro-->
            <div style="display:block;background: transparent" class="card" id="etapa1">
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
                                <label for="Senha">Usuario*:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar" id="Username"
                                           placeholder="Usuario"
                                           maxlength="20" required>
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Senha">Senha*:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control arredondar" id="Senha"
                                           placeholder="Senha"
                                           maxlength="20" required>
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="email">Email*:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-envelope"></i></span>
                                </div>
                                <label for="Email"></label>
                                <input type="email" class="form-control arredondar" id="Email"
                                       placeholder="nome@exemplo.com" data-error="Por favor, informe um email valido."
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-6">
                                <label for="CPF">CPF*:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-id-card-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar" id="CPF"
                                           placeholder="123.123.123-00"
                                           data-error="Por favor, informe um CPF correto." required>
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="Telefone">Telefone*:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar phone-mask" id="Telefone"
                                           placeholder="(DD) 0000-0000" required>
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


                    </form>
                </div>
            </div>
            <div style=" display:none;background: transparent" class="card" id="etapa2">
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
                                <button onclick="voltar1()" type="button" class="btn btn-info">Voltar</button>
                                <button onclick="etapa2()" type="button" class="btn btn-success">Avançar</button>
                            </div>
                        </div>

                        <span style="border-bottom: 1px solid white"> Etapa 2 de 3.</span>
                    </form>
                </div>
            </div>
            <div style=" display:none;background: transparent" class="card" id="etapa3">
                <div class="card-body">
                    <h3 class="text-center titulo"> Cadastro <i class="fas fa-address-card"></i></h3>
                    <form id="formEtapa3" class="formulario" data-toggle="validator"
                          enctype="multipart/form-data">

                        <div class="form-group col-xl-10">
                            <label for="Banco">Banco:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-university"></i></span>
                                </div>

                                <select class="form-control" id="banco" required>
                                    <?php
                                    foreach ($bancos as $banco) {
                                        echo "<option value='{$banco['code']}'> {$banco['name']} </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-xl-6">
                                <label for="agencia">Agência:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-piggy-bank"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar" id="agencia"
                                           data-error="Por favor, informe uma Agência correta." required>
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="conta">Conta:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-piggy-bank"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar" id="conta"
                                           data-error="Por favor, informe uma conta correta." required>
                                </div>
                                <div class="error help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 btn-row">
                                <button onclick="voltar2()" type="button" class="btn btn-info">Voltar</button>
                                <button type="button" onclick="cadastrarParceiro()" class="btn btn-success">Finalizar</button>
                            </div>
                        </div>

                        <span style="border-bottom: 1px solid white"> Etapa 3 de 3.</span>
                    </form>
                </div>
            </div>

            <!--            alertas-->
            <div class="alert alert-danger text-center" id="alerta2" role="alert"
                 style="display: none;">
                <strong>Erro! </strong> Seu cadastro <strong>não foi realizado!</strong>
            </div>
            <div class="alert alert-danger text-center" id="alerta3" role="alert"
                 style="display: none;">
                <strong>Erro! </strong> Username <strong>já cadastrado!</strong>
            </div>
            <div class="alert alert-danger text-center" id="alerta4" role="alert"
                 style="display: none;">
                <strong>Erro! </strong> Email <strong>já cadastrado!</strong>
            </div>
            <div class="alert alert-danger text-center" id="alerta5" role="alert"
                 style="display: none;">
                <strong>Erro! </strong> CPF <strong>já cadastrado!</strong>
            </div>
            <div class="alert alert-danger text-center" id="alerta6" role="alert"
                 style="display: none; justify-content: flex-start;">
                <strong>Erro! </strong> Preencha <strong> todos os campos! </strong>
            </div>
            <div class="alert alert-danger text-center" id="alerta7" role="alert"
                 style="display: none; justify-content: flex-start;">
                <strong>Erro! </strong> CPF <strong> Inválido !</strong>
            </div>

            <!--          FIM    alertas-->
            <!-- FIM FORM Cadastro-->
        </div>

    </div>
</div>

<?php
include('Footer.php');
?>

</body>