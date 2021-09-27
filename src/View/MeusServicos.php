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
        $('#preco').mask("#,##0.00", {reverse: true});

        $('#Conteudo').on('click', '#teste', function () {
            $("#meusServicos").hide();
            $("#formservico").show();
        });

        $('#Conteudo').on('click', '#meus_Servicos', function () {
            $("#meusServicos").show();
            $("#formservico").hide();
        });

        $("#table-pedidos").dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            }
        });

    });

    function carregarServicos() {
        let idCategoria = $('#categoria').val();

        let formData = new FormData();
        formData.append('idCategoria', idCategoria)
        formData.append('rq', 'carregarServicos');
        let url = '../Controller/index.php';
        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function (rs) {
                rs = JSON.parse(rs);
                $("#container-services").show();
                $("#container-price").show();
                $("#servicos").html('<option value="">--Selecione--</option>');
                $.each(rs, function (index, value) {
                    let servico = '<option value="' + value['id'] + '">' + value['sernome'] + '</option>';
                    $("#servicos").append(servico);
                });

            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });

    }

    function salvarServicoUser() {
        let idServico = $('#servicos').val();
        let precoServico = $('#preco').val();
        if (idServico == '' || precoServico == '') {
            $("#falha").show().fadeOut(4000);
        } else {

            let formData = new FormData();
            formData.append('idServico', idServico)
            formData.append('precoServico', precoServico)
            formData.append('rq', 'salvarServico');
            let url = '../Controller/index.php';
            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                contentType: false,
                processData: false,
                data: formData,
                success: function (rs) {
                    $("#Sucesso").show().fadeOut(4000);
                },
                error: function (e) {
                    bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
                }
            });

        }

    }

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
                        <span class="nav-link painel" href="#" id="meus_Servicos"
                              tabindex="-1">Listar meus serviços</span>
                    </li>

                    <?php
                    if (isset($_SESSION['CPF']) && $_SESSION['Tipo'] != '2') {
                        echo '<li class="nav-item">
                        <span class="nav-link painel" href="#" id="teste" tabindex="-1">Adicionar serviço</span>
                    </li>';
                    }
                    ?>

                </ul>
            </div>


            <div class="table-responsive" id="meusServicos" style="display: block">
                <table id="table-pedidos" class="table table" style=" border:1px solid white; color: white">
                    <thead style="background: #f50a31;">
                    <tr>
                        <th scope="col">Nome Profissional</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Atividade</th>
                        <th scope="col">Serviço</th>
                        <th scope="col">Status</th>
                        <th scope="col">Detalhes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once '../Model/modelPedidoServico.php';
                    $pedidos = new modelPedidoServico();
                    $pedidos = $pedidos->getPedidos($_SESSION['id']);

                    if ($pedidos) {
                        foreach ($pedidos as $key => $value) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $value['nome_profissional'] ?></th>
                                <th scope="row">R$<?php echo $value['servico_preco'] ?></th>
                                <th scope="row"><?php echo $value['nome_categoria'] ?></th>
                                <th scope="row"><?php echo $value['nome_servico'] ?></th>
                                <th scope="row">
                                    <span class="<?php echo $value['pedido_status']?>"><?php echo $value['pedido_status']?></span>
                                </th>
                                <th>
                                    <a href='#'>
                                        <button
                                                type='button' class='btn btn-success'><i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                </th>

                            </tr>

                            <?php
                        }
                    } else {
                        ?>

                            <tr>
                                <td class='text-center' colspan='6'>Nenhum serviço disponível no momento</td>
                            </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
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


                                <select onchange="carregarServicos()" class="form-control arredondar"
                                        placeholder="Categoria" id="categoria" required>
                                    <option value="">--Selecione--</option>
                                    <?php
                                    require_once '../Model/modelCategoria.php';
                                    $categoria = new modelCategoria();
                                    $categorias = $categoria->getCategoria();

                                    foreach ($categorias as $key => $value) {
                                        echo "<option value='{$value["id"]}'>{$value["catnome"]}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>

                    </div>

                    <div id="container-services" style="display: none">
                        <div class="services d-flex justify-content-center ">
                            <div class="d-flex align-items-center d-flex justify-content-center  col-12 col-md-12"
                                 title="Categoria">
                                <div class=" d-flex justify-content-center input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-briefcase"></i></span>
                                    </div>

                                    <select id="servicos" class="form-control arredondar" placeholder="Categoria"
                                            required>

                                    </select>

                                </div>

                                <div class="error help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div id="container-price" style="display: none">
                        <div class="services d-flex justify-content-center ">
                            <div class="d-flex align-items-center d-flex justify-content-center  col-12 col-md-12"
                                 title="Categoria">
                                <div class=" d-flex justify-content-center input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text arredondar"> <i
                                                    class="fas fa-dollar-sign"></i></span>
                                    </div>

                                    <input id="preco" class="form-control arredondar" placeholder="Valor médio em R$"
                                           required>

                                </div>

                                <div class="error help-block with-errors"></div>
                            </div>
                        </div>
                    </div>


                </form>

                <div class="form-group" style="display: flex; justify-content:center;">
                    <button onclick="salvarServicoUser();" style="margin:3px;" id="" type="button"
                            class="btn btn-primary">Salvar
                    </button>
                </div>

                <div class="alert alert-success testando text-center" id="Sucesso" role="alert"
                     style="display: none;">
                    <strong>Aviso! </strong> Serviço adicionada com <strong>sucesso!</strong>
                </div>

                <div class="alert alert-danger testando text-center" id="falha" role="alert" style="display: none;">
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