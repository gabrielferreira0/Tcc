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
                        <span class="nav-link painel" href="#" id="Categoria" tabindex="-1">Adicionar categoria</span>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link painel" href="#" id="listarCat" tabindex="-1"> Listar categorias</span>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link painel" href="#" tabindex="-1"> Listar usuários</span>
                    </li>
                </ul>
            </div>

            <!--            inicia aqui-->
            <div id="formCategoria" class="card-body">
                <form id="formulario" class="formulario" data-toggle="validator" enctype="multipart/form-data">

                    <div class="d-flex justify-content-center">
                        <div class="d-flex align-items-center d-flex justify-content-center col-8 col-md-8"
                             title="Categoria">
                            <div class=" d-flex justify-content-center input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-tools"></i></span>
                                </div>
                                <input type="text" class="form-control arredondar" id="Categoria"
                                       placeholder="Categoria" maxlength="20" required="">
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <label class="text-center" for="addFotoGaleria"> Imagem da categoria:</label>
                    </div>

                    <div id="dmo" class="d-flex justify-content-center">
                        <div class="d-flex align-items-center d-flex justify-content-center col-8 col-md-8"
                             id="imgCategoria" title="Foto da categoria">
                            <span style="font-size: 6rem" class="far fa-image"></span>
                        </div>
                    </div>

                    <div style="display: none">
                        <input type="file" id="addFotoCat" accept="image/x-png,image/gif,image/jpeg">
                    </div>

                </form>
                <div class="form-group" style="display: flex; justify-content:center;">
                    <button style="margin:3px;" id="salvarCat" type="button" class="btn btn-primary">Salvar</button>
                </div>

                <div class="alert alert-success testando text-center" id="catSucesso" role="alert"
                     style="display: none;">
                    <strong>Aviso! </strong> Categoria adicionada com <strong>sucesso!</strong>
                </div>

                <div class="alert alert-danger testando text-center" id="catFalha" role="alert" style="display: none;">
                    <strong>Erro! </strong> Categoria não foi <strong>adicionada!</strong>
                </div>
            </div>


            <div class="container" id="listaCat" style="display: none">


                <table class="table table" style="color: white">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Status</th>
                        <th scope="col">Excluir</th>
                        <th scope="col">Editar</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    require_once '../Model/modelCategoria.php';
                    $categoria = new modelCategoria();
                    $categorias = $categoria->getAllCategoria();

                    foreach ($categorias as $key => $value) {

                        ?>
                        <tr>
                            <th scope="row"><?php echo $value['id'] ?></th>
                            <td><?php echo $value['catnome'] ?></td>
                            <td><?php echo $value['catstatus'] ?></td>

                            <?php
                            if ($value['catstatus'] == 'True') {
                                echo '<td>
                                        <input type="hidden" value="' . $value["id"] . '">
                                        <button  value="False" title="Desativar" type="button" class="btn btn-danger setStatusCat"><i class="far fa-trash-alt"></i></button>
                                       </td>';

                            } else {
                                echo ' <td>
                                        <input type="hidden" value="' . $value["id"] . '">
                                        <button  value="True" title="Ativar" type="button" class="btn btn-success setStatusCat"><i class="fas fa-check"></i></button>
                                        </td>';
                            }
                            ?>
                            <td>
                                <button data-toggle="modal" data-nomeC="<?php echo $value['catnome'] ?>"
                                        data-target="#modalInfo" type="button"
                                        class="btn btn-primary"><i class="far fa-edit"></i></button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <!-- MODAL-->
                <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div style="background: #202020" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLabel">Informações da Categoria</h5>
                                <button style="color: white" type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <div class="modal-body">
                                <div class=" d-flex justify-content-center input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i class="fas fa-tools"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar" id="categoriaUPD"
                                           value="" maxlength="20" required="">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL-->
            </div>

            <!--            termina aqui-->
        </div>
    </div>
</div>

<?php
include('Footer.php');
?>
</body>