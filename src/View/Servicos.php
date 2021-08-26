<?php
session_start();
include('../Controller/verificarLogin.php')
?>

<head>
    <title>Meus serviços</title>
    <?php
    include('Head.php');
    ?>
</head>


<script>
    $(document).ready(function () {
        $('#Conteudo').on('click', '#teste', function () {
            $("#formservico").show();
        });
    });
</script>


<body id="Conteudo">

<?php
include('Navbar.php');
?>

<div class="container-fluid ">
    <div class="d-flex justify-content-center geral">
        <div class="card cardFormulario">
            <div class="card-header">
                <h3 class="text-center titulo"> Serviços <i class="fas fa-clipboard-list"></i></h3>
                <ul class="nav nav-tabs card-header-tabs d-flex justify-content-center">
                    <li class="nav-item">
                        <span class="nav-link painel" href="#" id="" tabindex="-1">Listar meus serviços</span>
                    </li>

                    <?php
                    if (isset($_SESSION['CPF']) && $_SESSION['Tipo'] == '3') {
                        echo '<li class="nav-item">
                        <span class="nav-link painel" href="#" id="teste" tabindex="-1">Adicionar serviço</span>
                    </li>';
                    }
                    ?>

                </ul>
            </div>

            <div style="display: none" id="formservico" class="card-body">
                <form id="formulario" class="formulario" data-toggle="validator" enctype="multipart/form-data">

                    <div class="d-flex justify-content-center">
                        <div class="d-flex align-items-center d-flex justify-content-center col-12 col-md-12"
                             title="Categoria">
                            <div class=" d-flex justify-content-center input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-tools"></i></span>
                                </div>


                                    <select class="form-control arredondar" placeholder="Categoria" id="UF" required>
                                        <option value="">Categoria</option>
                                    </select>


                            </div>


                            <div class="error help-block with-errors"></div>
                        </div>

                    </div>

                    <div id="container-services">
                        <div class="services d-flex justify-content-center ">
                            <div class="d-flex align-items-center d-flex justify-content-center  col-12 col-md-12"
                                 title="Categoria">
                                <div class=" d-flex justify-content-center input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-briefcase"></i></span>
                                    </div>

                                    <select class="form-control arredondar" placeholder="Categoria"  required>
                                        <option value="">Serviços</option>
                                    </select>

                                </div>

                                <div class="error help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="form-group" style="display: flex; justify-content:center;">
                    <button style="margin:3px;" id="" type="button" class="btn btn-primary">Salvar</button>
                </div>

                <div class="alert alert-success testando text-center" id="catSucesso" role="alert"
                     style="display: none;">
                    <strong>Aviso! </strong> Serviço adicionada com <strong>sucesso!</strong>
                </div>

                <div class="alert alert-danger testando text-center" id="catFalha" role="alert" style="display: none;">
                    <strong>Erro! </strong> Serviço não foi <strong>adicionada!</strong>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
include('Footer.php');
?>

</body>