<?php
session_start();
include('../Controller/verificarLoginADM.php')
?>

<head>
    <title>Perfil</title>
    <?php
    include('Head.php');
    ?>
</head>

<body id="Conteudo">

<?php
include('Navbar.php');
?>

<div class="container-fluid ">
    <div class="d-flex justify-content-center geral">
        <div class="card cardFormulario">
            <div class="card-header">
                <h3 class="text-center titulo"> Painel <i class="fas fa-cogs"></i></h3>
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <span class="nav-link painel" href="#" tabindex="-1">Adicionar categoria</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link painel" href="#" tabindex="-1"> Listar usuários</span>
                    </li>
                </ul>
            </div>

            <!--            inicia aqui-->
            <div class="card-body">
                <form id="formulario" class="formulario" data-toggle="validator" enctype="multipart/form-data">

                    <div class="form-group col-md-12">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-tools"></i></span>
                            </div>
                            <input type="text" class="form-control arredondar" id="Categoria" placeholder="Categoria"
                                   maxlength="20" required="">
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <label  class="text-center" for="addFotoGaleria"> Imagem da categoria:</label>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="d-flex align-items-center d-flex justify-content-center col-8 col-md-8"
                             id="imgCategoria"
                             title="Foto da categoria">
                            <span style="font-size: 6rem" class="far fa-image"></span>
                        </div>
                    </div>


                    <div style="display: none">
                        <input type="file" multiple id="addFotoGaleria" accept="image/x-png,image/gif,image/jpeg">
                    </div>

                </form>
                <div class="form-group" style="display: flex; justify-content:center;">
                    <button style="margin:3px;" id="salvarCat" type="button" class="btn btn-primary">Salvar</button>
                </div>

            </div>

            <!--            termina aqui-->
        </div>
    </div>
</div>

<?php
include('Footer.php');
?>
</body>