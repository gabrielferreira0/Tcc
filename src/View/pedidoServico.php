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


<div class="container-fluid ">
    <div class="container-pedido arredondar">

        <h1 style="border-bottom: 1px solid white" class="text-center">
            Finalizar Pedido <i class="fas fa-money-check"></i>
        </h1>

        <div class="container row">
            <div class="col-md-10  col-12 pl-5 pr-5 infoProfissional">
                <h3>Pintor / Casa ou apartamento</h3>
                <span>Nome: Lucca Edson Calebe </span> <br>
                <span>Telefone: (69)29153813</span> <br>
                <span>Email: luccaedsoncale-80@viavaleseguros.com.br</span>
            </div>


            <?php
            if ($_SESSION['Foto'] != 'false') {
                echo '

                <div class="col-12 col-md-2 ">
                
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <i style="color: #fac303" class="fas fa-star">4.0</i>
                </div>

                <div class="col-md-12 d-flex justify-content-center">
                    <img  style="cursor:default;" class ="miniatura" src="../imagens/usuarios/' . $_SESSION['Foto'] . '">
                </div>
                 </div>';
            } else {
                echo '<div class="col-md-2 col-sm-offset-1">
                <div class="col-md-12 mb-3">
                    <i style="color: #fac303" class="fas fa-star">4.0</i>
                </div>

                <div class="col-md-12">
                    <div style="cursor: default;"
                         class="d-flex align-items-center d-flex justify-content-center  col-md-2">

                        <h1 class="fas fa-user"></h1>
                    </div>
                </div>
            </div>';
            }
            ?>

        </div>

        <div class="container col-md-12 col-12 pl-5">
            <h1>Pagamento</h1>
            <form id="formulario" class="formulario" data-toggle="validator" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="Username">numero do cartão de crédito:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"><i class="far fa-credit-card"></i></span>
                            </div>
                            <input value="" type="text" class="form-control arredondar"
                                   placeholder="Numero"
                                   required>
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Username">Nome impresso no cartão:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"><i class="far fa-credit-card"></i></span>
                            </div>
                            <input value="" type="text" class="form-control arredondar" id="Username" placeholder="Nome"
                                   required>
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="Username">Expiração:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input value="" type="text" class="form-control arredondar"
                                   placeholder="data"
                                   required>
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="Username">CVV:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"><i class="fas fa-key"></i></span>
                            </div>
                            <input  maxlength="3" type="password" class="form-control arredondar"  placeholder="Código"
                                   required>
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


<?php
include('Footer.php');
?>
</body>