<?php
session_start();
include('../Controller/verificarLogin.php')
?>


<head>
    <title>Pedido</title>
    <?php
    include('Head.php');
    ?>
</head>


<body id="Conteudo">

<?php
include('Navbar.php');
?>


<script>

    $(document).ready(function () {
        $('#cartaoNumero').mask('0000.0000.0000.0000')
        $('#cartaoData').mask('0000')
        $('#CVV').mask('000')
        $('#cartaoData').mask('00/00')

        $('#Conteudo').on('click', '.expandir', function () {
            let classe = $(this).children().attr('class');
            if (classe == 'fas fa-caret-square-down') {
                $(this).children().removeClass().addClass('fas fa-caret-square-up')
            } else {
                $(this).children().removeClass().addClass('fas fa-caret-square-down')
            }
        });

        $('#Conteudo').on('click', '#finalizar', function () {


            let nomeServico = $(this).attr("data-nomeServico");
            let idServico = $(this).attr("data-idServico");
            let cartaoNumero = $('#cartaoNumero').val().replace(/[^\d]+/g, '');
            let cartaoNome = $('#cartaoNome').val();
            let cartaoData = $('#cartaoData').val();
            let CVV = $('#CVV').val();
            let CEP = $("#CEP").val().replace(/[^\d]+/g, '')
            let bairro = $("#Bairro").val();
            let logradouro = $("#Logradouro").val();
            let complemento = $("#Complemento").val();
            let numero = $("#numero").val();
            let cidade = $("#cidade").val();
            let UF = $("#UF").val();
            let data = $("#data").val();
            let preco = $("#preco").val();

            if (cartaoNumero == "" || cartaoNome == "" || cartaoData == "" || CVV == "" || cartaoNome == "") {
                $("#alertaErro").show().fadeOut(4000);
                return
            }

            if (CEP == "" || bairro == "" || logradouro == "" || complemento == "" || numero == "" || data == "") {
                $("#alertaErro").show().fadeOut(4000);
                return
            }

            let formData = new FormData();
            formData.append('rq', 'pedido');
            formData.append('cartaoNumero', cartaoNumero);
            formData.append('cartaoNome', cartaoNome);
            formData.append('cartaoData', cartaoData);
            formData.append('CVV', CVV);
            formData.append('CEP', CEP);
            formData.append('bairro', bairro);
            formData.append('logradouro', logradouro);
            formData.append('complemento', complemento);
            formData.append('numero', numero);
            formData.append('cidade', cidade);
            formData.append('UF', UF);
            formData.append('preco', preco);
            formData.append('nomeServico', nomeServico);
            formData.append('idServico', idServico);
            formData.append('data', data);

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
    ;
</script>


<div class="container-fluid col-md-10 ">
    <div class="container-pedido arredondar">

        <h1 style="border-bottom: 1px solid white" class="text-center">
            Finalizar Pedido <i class="fas fa-money-check"></i>
        </h1>


        <?php
        require_once '../Model/modelCategoria.php';
        $categoria = new modelCategoria();
        $servicos = $categoria->getServico_profissional($_GET['servico']);
        ?>

        <div style="margin: 0" class="container row">
            <div class="col-md-8 col-12 pl-5 pr-5 infoProfissional">

                <?php
                echo "<h3>{$servicos[0]['catnome']} / {$servicos[0]['sernome']}</h3>
                        <h4>Preço:<span style='font-weight:600;color: #28a745'>R$ {$servicos[0]['preco']} <i class='fas fa-money-bill-wave'></i></h4></span>
                        <span>Nome: {$servicos[0]['usunome']} </span> <br>
                        <span>Telefone: {$servicos[0]['usutelefone']}</span> <br>
                        <span>Email: {$servicos[0]['usuemail']}</span>"; ?>
            </div>
            <?php
            if ($servicos[0]['usufoto'] != 'false') {
                echo "
                <div class='col-12 col-md-2'>
                
                <div class='col-md-12 d-flex justify-content-center mb-2'>
                    <i style='color: #fac303' class='fas fa-star'> {$servicos[0]['nota']}</i>
                </div>

                <div class='col-md-12 d-flex justify-content-center'>
                    <img alt ='avatar-profissional' style='cursor:default;' class ='miniatura' src='../imagens/usuarios/{$servicos[0]['usufoto']}'>
                </div>
                 </div>";
            } else {
                echo "<div class='col-md-2 col-sm-offset-1'>
                <div class='col-md-12 mb-3'>
                
                <div style='cursor: default;'
                         class='d-flex align-items-center d-flex justify-content-center'>
                       <i style='color: #fac303' class='fas fa-star'> {$servicos[0]['nota']}</i>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div style='cursor: default;'
                         class=' d-flex justify-content-center '>
                        <h1  style='font-size: 4rem' class='fas fa-user'></h1>
                    </div>
                </div>
            </div>";
            }
            ?>
        </div>

        <div class="container col-md-12 col-12 pl-5">

            <form id="formulario" class="formulario" data-toggle="validator" enctype="multipart/form-data">
                <h1>Pagamento

                    <a title="expandir" class="btn btn-secondary expandir" data-toggle="collapse" href="#pagamento"
                       role="button" aria-expanded="false">
                        <i style="cursor: pointer" class="fas fa-caret-square-down"></i>
                    </a>
                </h1>
                <p class="small texto-cinza">Forneça as informações de pagamento</p>

                <div id="pagamento" class="collapse">
                    <div class="form-row texto-cinza">
                        <div class="form-group col-md-3">
                            <label for="Username">Numero do cartão de crédito*:</label>

                            <div class="input-group input-group-sm ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"><i class="far fa-credit-card"></i></span>

                                </div>
                                <input id="cartaoNumero" type="text" class="form-control"
                                       placeholder="Numero" required>
                            </div>


                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Username">Nome impresso no cartão*:</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"><i class="far fa-credit-card"></i></span>
                                </div>
                                <input id="cartaoNome" type="text" class="form-control arredondar" id=""
                                       placeholder="Nome"
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-row texto-cinza">
                        <div class="form-group col-md-2">
                            <label for="Username">Expiração*:</label>
                            <div class="input-group input-group-sm ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input id="cartaoData" type="text" class="form-control arredondar"
                                       placeholder="data"
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Username">CVV*:</label>
                            <div class="input-group input-group-sm ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"><i class="fas fa-key"></i></span>
                                </div>
                                <input id="CVV" maxlength="3" type="password" class="form-control arredondar"
                                       placeholder="Código"
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>
                    <?php
                    echo "<input  type='hidden'  id='preco' value='{$servicos[0]['preco']}'>";
                    ?>
                </div>

                <h1>Endereço / Data
                    <a class="btn btn-secondary expandir" data-toggle="collapse" href="#endereco" role="button"
                       aria-expanded="false" aria-controls="collapseExample">
                        <i style="cursor: pointer" class="fas fa-caret-square-down"></i>
                    </a>
                </h1>
                <p class="small texto-cinza">Forneça o endereço e o dia para a realização do serviço</p>

                <div id="endereco" class="collapse">
                    <div class="form-row texto-cinza">
                        <div class="form-group col-md-2 texto-cinza">
                            <label for="CEP">CEP*:</label>

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                </div>
                                <label for="CEP"></label>
                                <input onblur="carregarCEP()" type="text" class="form-control arredondar" id="CEP"
                                       placeholder="12.123-123" data-error="Por favor, informe um CEP correto."
                                       required="">
                            </div>

                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-2 texto-cinza">
                            <label for="Bairro">Bairro*:</label>

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                </div>
                                <input type="text" class="form-control arredondar" id="Bairro"
                                       data-error="Por favor, informe um bairro correto." required="">
                            </div>

                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-2 texto-cinza">
                            <label for="Logradouro">Logradouro*:</label>

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                </div>
                                <input type="text" class="form-control arredondar" id="Logradouro"
                                       data-error="Por favor, informe um Logradouro correto." required="">
                            </div>

                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-row texto-cinza">
                        <div class="form-group col-md-2 texto-cinza">
                            <label for="Complemento">Complemento*:</label>

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                </div>
                                <label for="CEP"></label>
                                <input type="text" class="form-control arredondar" id="Complemento"
                                       data-error="Por favor, informe um Complemento correto." required="">
                            </div>

                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-2 texto-cinza">
                            <label for="numero">Numero*:</label>

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                </div>
                                <label for="numero"></label>
                                <input type="text" class="form-control arredondar" id="numero"
                                       data-error="Por favor, informe um numero correto." required="">
                            </div>

                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-2 texto-cinza">
                            <label for="cidade">Cidade/UF</label>

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-home"></i></span>
                                </div>
                                <label for="numero"></label>

                                <?php
                                echo "
                    <input value='{$servicos[0]['cidade']}' 
                    type='text' class='form-control arredondar' id='cidade' required disabled>
                    <div class='input-group-append arredondar'>
                        <span id='UF' class='input-group-text'>{$servicos[0]['uf']}</span>
                    </div>
            "; ?>
                            </div>
                        </div>
                        <div class="form-group col-md-3 texto-cinza">
                            <label for="data">Data prestação do serviço*:</label>

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <label for="data"></label>
                                <input type="date" class="form-control arredondar" id="data"
                                       data-error="Por favor, informe uma data correta." required="">
                            </div>

                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="form-group" style="display:flex;  justify-content: center;"><a href="../index.php">
                <button id="" type="button" class="btn btn-danger ml-2  mb-3 mr-2">Voltar</button>
            </a>
            <?php
            echo "<button 
                data-idServico='{$_GET['servico']}' data-nomeServico ='{$servicos[0]['catnome']}/{$servicos[0]['sernome']}'
                id='finalizar' type='button' class='btn btn-success ml-2 mb-3 mr-2'>Finalizar Pedido
                </button>";
            ?>
        </div>

        <div class="alert alert-danger testando text-center" id="alertaErro" role="alert"
             style="display: none;">
            <strong>Erro! </strong>Solicitação <strong> não efetuada!</strong>
        </div>

    </div>

    <div class="modal fade bd-loading-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
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
</body>
