<head>
    <title>Cadastro parceiro</title>
    <?php
    session_start();
    include('Head.php');

    ?>
</head>


<script>

    function pesquisarServicos() {
        let servicoID = $('#servicos').val();
        let UF = $('#UF').val();
        let categoriaNome = $('#pesquisarTable').attr('data-nomecategoria');

        let url = '../Controller/index.php';

        if (!servicoID || !categoriaNome) {
            $("#erro").show().fadeOut(4000);
            return
        }

        let formData = new FormData();
        formData.append('rq', 'servicos_ID');
        formData.append('servicoID', servicoID);
        formData.append('UF', UF);
        formData.append('categoriaNome', categoriaNome);

        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function (rs) {
                $('#table-services').html(rs);
                $("#table-Services").dataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                    }
                });
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });

    }

    function loginOFF() {
        Swal.fire('Você deve estar logado para contratar algum serviço')
    }

    $(document).ready(function () {
        $("#table-Services").dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            }
        });
    });
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

<div  style="margin:0" class=" row container text-center col-md-12 pesquisar_servico">

    <div class="col-md-3 arredondar">
        <?php
        require_once '../Model/modelCategoria.php';
        $categoria = new modelCategoria();
        $servicos = $categoria->getAllServicos($_GET['categoria']);
        ?>

        <h1 class="text-center"><?php echo $_GET['categoria']; ?></h1>

        <div style="margin: 1rem 0 2rem 0; border-radius: 10px; padding: 0" class="col-md-12">
            <img title="Clique para alterar" id="imageCatUPD" class="card-img-top"
                 src="../imagens/categoria/<?php echo $servicos[0]['catfoto'] ?>">
        </div>
        <label for="servicos">Selecione o serviço:*</label>

        <form action="" data-toggle="validator">

            <div class="form-group">
                <div class=" d-flex justify-content-center input-group ">

                    <div class="input-group-prepend">
                        <span class="input-group-text arredondar"> <i class="fas fa-tools"></i></span>
                    </div>

                    <select class="form-control arredondar" id="servicos" data-error="Por favor, selecione um serviço."
                            required>

                        <option value="">--Selecione--</option>
                        <?php
                        foreach ($servicos as $key => $value) {
                            echo "<option value='{$value['id']}'>{$value['sernome']}</option>";
                        }
                        ?>

                    </select>
                </div>

                <div class="error help-block with-errors"></div>
            </div>

            <div class="form-group">
                <div class=" d-flex justify-content-center input-group ">

                    <div class="input-group-prepend">
                        <span class="input-group-text arredondar"> <i class="fas fa-map-marked-alt"></i></span>
                    </div>

                    <select class="form-control arredondar" id="UF">
                        <option value="">--Selecione UF</option>
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

                <div class="error help-block with-errors"></div>
            </div>

            <div class="alert alert-danger text-center" id="erro" role="alert" style="display: none;">
                <strong>Erro! </strong>Não foi possivel realizar essa operação!
            </div>
            <div class="form-group" style="display: flex;justify-content:flex-end;">
                <button id="pesquisarTable" data-nomeCategoria="<?php echo $_GET['categoria']; ?>"
                        onclick="pesquisarServicos()"
                        type="button" class="btn pesquisarTable arredondar">Pesquisar
                    <i class="fas fa-search"></i>
                </button>


            </div>

        </form>
    </div>

    <div style="display: flex; align-items: center" class="col-md-9 arredondar">

        <div id="table-services" class="table-responsive" style="display:block">
            <?php
            require_once '../Controller/controllerCategoria.php';
            $categoria = new controllerCategoria();
            echo $tableServicos = $categoria->tableServicos($_GET['categoria']);
            ?>
        </div>
    </div>

</div>

<?php
include('Footer.php');
?>

</body>