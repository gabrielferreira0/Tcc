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

<!--<div class="container-fluid  col-md-12 col-sm-12">-->
<!--    <div class="container-pedido arredondar ">-->
<!--        <h1 style="border-bottom: 1px solid white" class="text-center">Detalhes-->
<!--            <i class="fas fa-info-circle"></i>-->
<!--        </h1>-->
<!--        <div class="row">-->
<!---->
<!--            <div class="col-md-7 offset-md-1 ">-->
<!--                <h2>Profissional</h2>-->
<!--                <h3>Categoria</h3>-->
<!--                <span>Lucca Edson Calebe </span>-->
<!--                <span>(69)29153813</span>-->
<!--                <span>luccaedsoncale-80@viavaleseguros.com.br</span>-->
<!--            </div>-->

<!--            --><?php
//            if ($_SESSION['Foto'] != 'false') {
//                echo '
//                <div class=" col-12 offset-4 col-md-2 offset-md-1">
//
//                <div  style="padding-left: 2rem" class="col-md-12mb-2">
//                    <i style="color: #fac303" class="fas fa-star">4.0</i>
//                </div>
//
//                <img  style="cursor: default;"
//                         class ="miniatura" src="../imagens/usuarios/' . $_SESSION['Foto'] . '">
//                </div>
//                ';
//            }
//            else {
//                echo '<div class="col-md-2 col-sm-offset-1">
//                <div class="col-md-12 mb-3">
//                    <i style="color: #fac303" class="fas fa-star">4.0</i>
//                </div>
//
//                <div class="col-md-12">
//                    <div style="cursor: default;"
//                         class="d-flex align-items-center d-flex justify-content-center  col-md-2">
//
//                        <h1 class="fas fa-user"></h1>
//                    </div>
//                </div>
//            </div>';
//            }
//            ?>
<!---->
<!---->
<!---->
<!---->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<div class="container-fluid ">
    <div class="container-pedido arredondar">

        <h1 style="border-bottom: 1px solid white" class="text-center">
            Detalhes <i class="fas fa-info-circle"></i>
        </h1>

        <div class="row">
            <div class="col-md-7 offset-md-1 col-12 pl-5 pr-5 infoProfissional">
                <h2>Profissional</h2>
                <h3>Categoria</h3>
                <span>Lucca Edson Calebe </span>
                <span>(69)29153813</span>
                <span>luccaedsoncale-80@viavaleseguros.com.br</span>
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

    </div>
</div>


<?php
include('Footer.php');
?>
</body>