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
        $('#expiracao').mask('0000')


        $('#Conteudo').on('click', '.expandir', function () {
            let classe = $(this).children().attr('class');
            if (classe == 'fas fa-caret-square-down') {
                $(this).children().removeClass().addClass('fas fa-caret-square-up')
            } else {
                $(this).children().removeClass().addClass('fas fa-caret-square-down')
            }
        });

    });
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
                echo '
                <div class="col-12 col-md-2 ">
                
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <i style="color: #fac303" class="fas fa-star">4.0</i>
                </div>

                <div class="col-md-12 d-flex justify-content-center">
                    <img alt ="avatar-profissional" style="cursor:default;" class ="miniatura" src="../imagens/usuarios/' . $servicos[0]['usufoto'] . '">
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
                            <label for="Username">numero do cartão de crédito:</label>

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
                            <label for="Username">Nome impresso no cartão:</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"><i class="far fa-credit-card"></i></span>
                                </div>
                                <input value="" type="text" class="form-control arredondar" id="" placeholder="Nome"
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-row texto-cinza">
                        <div class="form-group col-md-2">
                            <label for="Username">Expiração:</label>
                            <div class="input-group input-group-sm ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input id="expiracao" type="text" class="form-control arredondar"
                                       placeholder="data"
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Username">CVV:</label>
                            <div class="input-group input-group-sm ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"><i class="fas fa-key"></i></span>
                                </div>
                                <input maxlength="3" type="password" class="form-control arredondar"
                                       placeholder="Código"
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>
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
                            <label for="CEP">CEP:</label>

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
                            <label for="Bairro">Bairro:</label>

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
                            <label for="Logradouro">Logradouro:</label>

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
                            <label for="Complemento">Complemento:</label>

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
                            <label for="numero">Numero:</label>

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
                        <span class='input-group-text'>{$servicos[0]['uf']}</span>
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

        <div class="form-group" style="display:flex;  justify-content: center;">
            <button id="" type="button" class="btn btn-danger ml-2  mb-3 mr-2">Voltar</button>
            <button id="" type="button" class="btn btn-success ml-2 mb-3 mr-2">Finalizar Pedido</button>
        </div>

    </div>

</div>


<?php
include('Footer.php');
?>
</body>