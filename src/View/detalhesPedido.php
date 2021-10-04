<?php
session_start();
include('../Controller/verificarLogin.php')
?>

<head>
    <title>Detalhes Pedido</title>
    <?php
    include('Head.php');
    ?>
</head>

<script>

    $(document).ready(function () {
        $('#Conteudo').on('click', '.expandir', function () {
            let classe = $(this).children().attr('class');
            if (classe === 'fas fa-caret-square-down') {
                $(this).children().removeClass().addClass('fas fa-caret-square-up')
            } else {
                $(this).children().removeClass().addClass('fas fa-caret-square-down')
            }
        });

        $('#Conteudo').on('click', '.estrela', function () {
            $(this).attr('id', 'avaliacao_servico');
            var onStar = parseInt($(this).attr('data-value'), 10); // The star currently selected
            var stars = $(this).parent().children('.estrela'); // lista das estrelas

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('star-active');
            }
            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('star-active');
            }
        });


        $('#Conteudo').on('click', '#cancelarPedido', function () {
            let pedido_id = $(this).attr('data-idpedido');
            let pagamento_id = $(this).attr('data-idpagamento');


            let formData = new FormData();
            formData.append('rq', 'cancelarPedido');
            formData.append('pedido_id', pedido_id);
            formData.append('pagamento_id', pagamento_id);

            let url = '../../src/Controller/index.php';

            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function () {
                    $('.modal').modal('show');
                },
                success: function (rs) {
                    console.log(rs);
                    $('.modal').modal('hide');
                    switch (rs) {
                        case 'sucesso':
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Pedido cancelado com sucesso!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            location.reload();
                            break;
                        default:
                            $("#alertaErro").show().fadeOut(4000);
                            break;
                    }
                },
                error: function (e) {
                    bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
                }
            });

        });

        $('#Conteudo').on('click', '#aceitarPedido', function () {
            let pedido_id = $(this).attr('data-idpedido');


            let formData = new FormData();
            formData.append('rq', 'aceitarPedido');
            formData.append('pedido_id', pedido_id);

            let url = '../../src/Controller/index.php';

            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function () {
                    $('#modal_loading').modal('show');
                },
                success: function (rs) {
                    console.log(rs);
                    $('#modal_loading').modal('hide');
                    switch (rs) {
                        case 'sucesso':
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Pedido aceito com sucesso!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            location.reload();
                            break;
                        default:
                            $("#alertaErro").show().fadeOut(4000);
                            break;
                    }
                },
                error: function (e) {
                    bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
                }
            });

        });


        $('#Conteudo').on('click', '#finalizarPedido', function () {

            let pedido_id = $(this).attr('data-idpedido');

            let avaliacao_servico = $('#avaliacao_servico').attr('data-value');



            if (!avaliacao_servico) {
                $("#erroReview").show().fadeOut(5000);
                return
            }


            let formData = new FormData();
            formData.append('rq', 'finalizarPedido');
            formData.append('pedido_id', pedido_id);
            formData.append('avaliacao_servico', avaliacao_servico);

            let url = '../../src/Controller/index.php';

            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function () {
                    $('.modal').modal('show');
                },
                success: function (rs) {
                    console.log(rs)
                    $('.modal').modal('hide');
                    switch (rs) {
                        case 'sucesso':
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Pedido realizado com sucesso!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            location.reload();
                            break;
                        default:
                            $("#alertaErro").show().fadeOut(4000);
                            break;
                    }
                },
                error: function (e) {
                    bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
                }
            });

        });
    })


</script>


<body id="Conteudo">

<?php
include('Navbar.php');
?>

<div class="container-fluid col-md-10 ">
    <div class="container-pedido arredondar">

        <h1 style="border-bottom: 1px solid white" class="text-center">
            Detalhes Pedido <i class="fas fa-money-check"></i>
        </h1>


        <?php
        require_once '../Model/modelPedidoServico.php';
        require_once '../Controller/controllerCartaoCredito.php';
        $pedido = new modelPedidoServico();
        $pedido = $pedido->getPedido($_GET['pedido']);
        $pagamento = new controllerCartaoCredito();
        $pagamento = $pagamento->getPagamento($pedido[0]['pagamento_id']);
        ?>
        <div style="margin: 0" class="container row">
            <div class="col-md-8 col-12 pl-5 pr-5 infoProfissional">

                <?php
                echo "<h3>{$pedido[0]['catnome']} / {$pedido[0]['sernome']}</h3>
                        <h4>Preço:<span style='font-weight:600;color: #28a745'>R$ {$pedido[0]['preco']} <i class='fas fa-money-bill-wave'></i></h4></span>
                        <span>Nome: {$pedido[0]['usunome']} </span> <br>
                        <span>Telefone: {$pedido[0]['usutelefone']}</span> <br>
                        <span>Email: {$pedido[0]['usuemail']}</span> <br>
                        <span class='{$pedido[0]['status_pedido']}'>Status: {$pedido[0]['status_pedido']}</span>"; ?>
            </div>
            <?php
            if ($pedido[0]['usufoto'] != 'false') {
                echo '
                <div class="col-12 col-md-2 ">
                
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <i style="color: #fac303" class="fas fa-star">4.0</i>
                </div>

                <div class="col-md-12 d-flex justify-content-center">
                    <img alt ="avatar-profissional" style="cursor:default;" class ="miniatura" src="../imagens/usuarios/' . $pedido[0]['usufoto'] . '">
                </div>
                 </div>';
            } else {
                echo '<div class="col-md-2 col-sm-offset-1">
                <div class="col-md-12 mb-3">
                
                <div style="cursor: default;"
                         class="d-flex align-items-center d-flex justify-content-center">
                       <i style="color: #fac303" class="fas fa-star">4.0</i>
                    </div>
                </div>

                <div class="col-md-12">
                    <div style="cursor: default;"
                         class=" d-flex justify-content-center ">
                        <h1  style="font-size: 4rem" class="fas fa-user"></h1>
                    </div>
                </div>
            </div>';
            }
            ?>
        </div>

        <div class="container col-md-12 col-12 pl-5">

            <?php
            if ($_SESSION['id'] == $pedido[0]['id_cliente'] || $_SESSION['Tipo'] == '1') {
                echo "
             <h1>Pagamento

                    <a title='expandir' class='btn btn-secondary expandir' data-toggle='collapse' href='#pagamento'
                       role='button' aria-expanded='false'>
                        <i style='cursor: pointer' class='fas fa-caret-square-down'></i>
                    </a>
                </h1>
                <p class='small texto-cinza'>informações sobre o Pagamento</p>
             <div id='pagamento' class='collapse'>
                    <div class='form-row texto-cinza'>
                        <div class='form-group col-md-2'>
                            <label for='Username'>Últimos dígitos cartão:</label>

                            <div class='input-group input-group-sm '>
                                <div class='input-group-prepend'>
                                    <span class='input-group-text arredondar'><i class='far fa-credit-card'></i></span>

                                </div>
                            <input  class='form-control arredondar' id='Logradouro'  value='{$pagamento[0]}' disabled>
                            </div>
                        </div>

                        <div class='form-group col-md-2'>
                            <label for='Username'>Bandeira do cartão:</label>
                            <div class='input-group input-group-sm'>
                                <div class='input-group-prepend'>
                                    <span class='input-group-text arredondar'>
                                        <i class='fab fa-cc-{$pagamento[1]}'></i>
                                    </span>
                                </div>
                                
                            <input  class='form-control arredondar' id='Logradouro'  value='{$pagamento[1]}' disabled>

                            </div>
                        </div>
                    </div>
                </div>                       
             ";
            }
            ?>


            <h1>Endereço / Data
                <a class="btn btn-secondary expandir" data-toggle="collapse" href="#endereco" role="button"
                   aria-expanded="false" aria-controls="collapseExample">
                    <i style="cursor: pointer" class="fas fa-caret-square-down"></i>
                </a>
            </h1>
            <p class="small texto-cinza">Informações do endereço e o dia para a realização do serviço</p>

            <div id="endereco" class="collapse">
                <div class="form-row texto-cinza">
                    <div class="form-group col-md-2 texto-cinza">
                        <label for="CEP">CEP:</label>

                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                            </div>

                            <?php
                            echo "
                            <input  class='form-control arredondar' id='CEP'  value='{$pedido[0]['cep_servico']}' disabled>"; ?>
                        </div>

                    </div>
                    <div class="form-group col-md-2 texto-cinza">
                        <label for="Bairro">Bairro:</label>

                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                            </div>
                            <?php
                            echo "
                            <input  class='form-control arredondar' id='Bairro'  value='{$pedido[0]['bairro_servico']}' disabled>"; ?>
                        </div>

                    </div>
                    <div class="form-group col-md-2 texto-cinza">
                        <label for="Logradouro">Logradouro:</label>

                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                            </div>
                            <?php
                            echo "
                            <input  class='form-control arredondar' id='Logradouro'  value='{$pedido[0]['logradouro_servico']}' disabled>"; ?>

                        </div>

                    </div>
                </div>

                <div class="form-row texto-cinza">
                    <div class="form-group col-md-2 texto-cinza">
                        <label for="Complemento">Complemento:</label>

                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                            </div>
                            <?php
                            echo "
                            <input  class='form-control arredondar' id='Logradouro'  value='{$pedido[0]['complemento_servico']}' disabled>"; ?>
                        </div>

                    </div>
                    <div class="form-group col-md-2 texto-cinza">
                        <label for="numero">Numero:</label>

                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                            </div>
                            <?php
                            echo "
                            <input  class='form-control arredondar' value='{$pedido[0]['numero_servico']}' disabled>"; ?>
                        </div>

                    </div>
                    <div class="form-group col-md-2 texto-cinza">
                        <label for="cidade">Cidade/UF</label>

                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                            </div>
                            <?php
                            echo "
                    <input value='{$pedido[0]['cidade_servico']}' 
                    type='text' class='form-control arredondar' id='cidade' required disabled>
                    <div class='input-group-append arredondar'>
                        <span id='UF' class='input-group-text'>{$pedido[0]['uf_servico']}</span>
                    </div>
            "; ?>
                        </div>
                    </div>
                    <div class="form-group col-md-3 texto-cinza">
                        <label for="data">Data:</label>

                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <?php
                            $pedido[0]['data_servico'] = strtotime($pedido[0]['data_servico']);
                            $pedido[0]['data_servico'] = date('d/m/Y', $pedido[0]['data_servico']);
                            echo "
                            <input  class='form-control arredondar' value='{$pedido[0]['data_servico']}' disabled>"; ?>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="form-group" style="display:flex;  justify-content: center;">
            <?php
            if ($_SESSION['id'] == $pedido[0]['id_cliente'] && $pedido[0]['status_pedido'] != 'Cancelado'
                && $pedido[0]['status_pedido'] != 'Finalizado') {
                echo "
            <button id='cancelarPedido' data-idPedido='{$_GET['pedido']}' data-idPagamento='{$pedido[0]['pagamento_id']}'  
            type='button' class='btn btn-danger ml-2  mb-3 mr-2'>Cancelar Serviço</button>
            
            <button  data-toggle='modal' data-target='#modalAvaliacao' 
                type='button' class='btn btn-success ml-2 mb-3 mr-2'>Finalizar Serviço
            </button>
            
          
                ";
            } elseif ($_SESSION['id'] == $pedido[0]['id_profissional'] && $pedido[0]['status_pedido'] == 'Analise') {
                echo "
                <button id='cancelarPedido' data-idPedido='{$_GET['pedido']}' data-idPagamento='{$pedido[0]['pagamento_id']}'  
                type='button' class='btn btn-danger ml-2  mb-3 mr-2'>Negar Serviço
                </button>
            
            <button 
                data-idPedido='{$_GET['pedido']}'
                id='aceitarPedido' type='button' class='btn btn-success ml-2 mb-3 mr-2'>Aceitar Serviço
            </button>
                
                ";
            } elseif ($pedido[0]['status_pedido'] == 'Finalizado') {
                echo '
                <div class="alert alert-success" role="alert">
                  Pedido Finalizado!
                </div>';
            } elseif ($pedido[0]['status_pedido'] == 'Cancelado') {
                echo '
                <div class="alert alert-danger" role="alert">
                  Pedido Cancelado!
                </div>';
            } elseif ($pedido[0]['status_pedido'] == 'Andamento' && $_SESSION['id'] == $pedido[0]['id_cliente']
                || $pedido[0]['status_pedido'] == 'Andamento' && $_SESSION['id'] == $pedido[0]['id_profissional']) {
                echo "<button id='cancelarPedido' data-idPedido='{$_GET['pedido']}' data-idPagamento='{$pedido[0]['pagamento_id']}'
            type='button' class='btn btn-danger ml-2  mb-3 mr-2'>Cancelar Serviço
            </button>";
            }
            ?>
        </div>
        <div class="alert alert-danger testando text-center" id="alertaErro" role="alert"
             style="display: none;">
            <strong>Erro! </strong>Solicitação <strong> não efetuada!</strong>
        </div>
        <div class="alert alert-danger testando text-center" id="erroReview" role="alert"
             style="display: none;">
            <strong>Erro! </strong>Por favor avalie o serviço.<strong> Essa ação nos ajudará a melhorar a plataforma melhor
                para você!</strong>
        </div>
    </div>

    <div  id="modal_loading" class="modal fade bd-loading-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div id="loading"></div>
            </div>
        </div>
    </div>
</div>

<?php
include('Footer.php');
?>

<!-- MODAL-->

<?php
include('modalAvaliacao.php');
?>
<!-- FIM MODAL-->

</body>
