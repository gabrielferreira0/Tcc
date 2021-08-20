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


<script>
    $('#Conteudo').on('click', '#adicionarservicos', function () {
        let inputServices = '\<div class="services d-flex justify-content-center ">\
            <div class="d-flex align-items-center d-flex justify-content-center  col-8 col-md-8"\
                 title="Categoria">\
                <div class=" d-flex justify-content-center input-group ">\
                    <div class="input-group-prepend">\
                        <span class="input-group-text arredondar"> <i class="fas fa-briefcase"></i></span>\
                    </div>\
                    <input type="text" class="form-control arredondar" name="nomeservicos" placeholder="Serviços"\
                           maxlength="20" required="">\
                </div>\
                <div class="error help-block with-errors"></div>\
            </div>\
    </div>';
        $("#container-services").append(inputServices);
    });

    function block(id) {
        let url = '../../src/Controller/index.php';
        $.ajax({
            type: "POST",
            dataType: 'text',
            url: url,
            async: true,
            data: {
                rq: 'block',
                idUser:id,
            },
            success: function (rs) {
                console.log(rs);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Cadastro bloqueado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500,
                })
                setTimeout(function () {
                    location.reload();
                }, 1700);
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });
    }
</script>

<div class="container-fluid ">
    <div class="d-flex justify-content-center geral">
        <div class="card cardFormulario">
            <div class="card-header">
                <h3 class="text-center titulo"> Painel <i class="fas fa-cogs"></i></h3>
                <ul class="nav nav-tabs card-header-tabs d-flex justify-content-center">
                    <li class="nav-item">
                        <span class="nav-link painel" href="#" id="Categoria" tabindex="-1">Adicionar categoria</span>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link painel" href="#" id="listarCat" tabindex="-1"> Listar categorias</span>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link painel" href="#" id="listarUsers" tabindex="-1"> Listar usuários</span>
                    </li>
                </ul>
            </div>

            <div id="formCategoria" class="card-body">
                <form id="formulario" class="formulario" data-toggle="validator" enctype="multipart/form-data">


                    <div class="d-flex justify-content-center">
                        <div class="d-flex align-items-center d-flex justify-content-center col-8 col-md-8"
                             title="Categoria">
                            <div class=" d-flex justify-content-center input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-tools"></i></span>
                                </div>
                                <input type="text" class="form-control arredondar" id="nomeCategoria"
                                       placeholder="Categoria" maxlength="20" required="">

                                <div class="input-group-append">
                                    <button title="Clique para adicionar serviços" id="adicionarservicos" type="button"
                                            class="btn btn-success"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>


                            <div class="error help-block with-errors"></div>
                        </div>

                    </div>

                    <div id="container-services">
                        <div class="services d-flex justify-content-center ">
                            <div class="d-flex align-items-center d-flex justify-content-center  col-8 col-md-8"
                                 title="Categoria">
                                <div class=" d-flex justify-content-center input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-briefcase"></i></span>
                                    </div>
                                    <input type="text" class="form-control arredondar" name="nomeservicos"
                                           placeholder="Serviços" maxlength="20" required="">
                                </div>


                                <div class="error help-block with-errors"></div>
                            </div>

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

            <div class="table-responsive" id="listaCat" style="display: none">
                <table class="table table" style=" border:1px solid white; color: white">
                    <thead style="background: #f50a31;">
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
                            <td><?php echo $value['catstatus2'] ?></td>

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
                                <button data-toggle="modal" data-idCat="<?php echo $value['id'] ?>"
                                        data-image="<?php echo $value['catfoto'] ?>"
                                        data-nomeC="<?php echo $value['catnome'] ?>"
                                        data-target="#modalInfo" type="button"
                                        class="btn btn-primary"><i class="far fa-edit"></i></button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive" id="listaUsers" style="display: none">
                <table id="table-Users" class="table table" style=" border:1px solid white; color: white">
                    <thead style="background: #f50a31;">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Lixo</th>
                        <th scope="col">Ver</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    require_once '../Model/modelUsuario.php';
                    $usuarios = new modelUsuario();
                    $usuarios = $usuarios->getAllUsers();

                    foreach ($usuarios as $key => $value) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $value['id'] ?></th>
                            <th scope="row"><?php echo $value['usunome'] ?></th>
                            <th scope="row"><?php echo $value['usublock'] ?></th>
                            <th scope="row"><?php echo $value['usucpf'] ?></th>
                            <th scope="row"><?php echo $value['usutelefone'] ?></th>
                            <th scope="row"><?php echo $value['usutipo'] ?></th>
                            <th scope="row"><?php echo $value['usustatus2'] ?></th>


                            <?php
                            if ($value['usustatus'] == 'true'|| $value['usublock'] == 'f' ) {
                                echo '<th>
                                        <input type="hidden" value="' . $value["id"] . '">
                                        <button  onclick="block('.$value["id"].')" value="False" title="Desativar" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                       </th>';

                            } elseif ($value['usustatus'] == 'false'|| $value['usublock'] == 't' ) {
                                echo ' <th>
                                        <input type="hidden" value="' . $value["id"] . '">
                                        <button  value="True" title="Ativar" type="button" class="btn btn-success"><i class="fas fa-check"></i></button>
                                        </th>';
                            }
                            ?>

                            <td>
                                <button data-toggle="modal" data-idUser="<?php echo $value['id'] ?>"
                                        data-idUser="<?php echo $value['id'] ?>"
                                        data-nameUser="<?php echo $value['usunome'] ?>"
                                        data-telefoneUser="<?php echo $value['usutelefone'] ?>"
                                        data-emailUser="<?php echo $value['usuemail'] ?>"
                                        data-cpfUser="<?php echo $value['usucpf'] ?>"
                                        data-fotoUser="<?php echo $value['usufoto'] ?>"
                                        data-target="#modalInfoUsers" type="button"
                                        class="btn btn-primary"><i class="fas fa-eye"></i></button>
                            </td>

                        </tr>

                        <?php
                    }
                    ?>
                    </tbody>
                    </tbody>
                </table>
            </div>


        </div>

    </div>

</div>

<?php
include('Footer.php');
?>

</body>
<!-- MODAL-->
<?php
include('modalUsers.php');
include('modalPainel.php');
?>


<script>
    $(document).ready(function () {
        $("#table-Users").dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>

<!-- MODAL-->
