<?php
session_start();
include('../Controller/verificarLoginADM.php')
?>

<head>
    <title>DashBoard</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <?php
    include('Head.php');
    ?>

</head>

<body id="Conteudo">
<?php
include('Navbar.php');
?>

<div class="container-fluid d-flex justify-content-center col-md-12 geral">

    <div class="row">
        <div class="col-md-9 offset-md-0 col-10 offset-1">

            <div class="card-columns">

                <!--            saldo atual-->
                <div class="col-md-11 col-12">
                    <div class="card cardDashBoard">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col mr-2">
                                    <h6 class="font-weight-bold mb-1">Saldo Conta WeDo:</h6>
                                    <div id="saldo" class="text-success font-weight-bold"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hand-holding-usd fa-3x text-gray-300 "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--  formas de pagamento-->

                <div class="col-md-11 col-12">
                    <div class="card cardDashBoard">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mr-2">
                                    <h6 class="font-weight-bold">Formas de pagamentos:</h6>
                                    <span class="small texto-cinza font-weight-bold"> ● CRÉDITO 100% </span>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- total de transações-->
                <div class="col-md-11 col-12">
                    <div class="card cardDashBoard">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col mr-2">
                                    <h6 class="font-weight-bold">Total de transações:</h6>
                                    <span id="totalTransacoes"
                                          class="font-weight-bol texto-cinza font-weight-bold"></span>
                                    <i class="fas fa-exchange-alt"></i>

                                </div>
                                <div class="col-auto">
                                    <i class="far fa-credit-card fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-columns">


                <div class="col-md-11 col-12">
                    <div class="card cardDashBoard">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col">
                                    <h6 class="font-weight-bold mb-1">Bandeiras mais utilizadas:</h6>

                                    <img style="width: 2.5rem" src="../imagens/svg/visa-logo.svg"
                                         alt="logo visa">
                                    <span class="small texto-cinza font-weight-bold">Visa</span>
                                    <span id="visa" class="small texto-cinza font-weight-bold"></span>
                                    <br>

                                    <img style="width: 2.5rem" src="../imagens/svg/mastercard-seeklogo.com.svg"
                                         alt="logo MasterCard">
                                    <span class="small texto-cinza font-weight-bold">Mastercard</span>
                                    <span id="mastercard" class="small texto-cinza font-weight-bold"></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-11 col-12">
                    <div class="card cardDashBoard">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mr-2">
                                    <h6 class="font-weight-bold">Volume transacionado</h6>
                                    <span id="volume_transacionado" class="text-success font-weight-bold"></span>
                                    <i class="fas fa-file-invoice-dollar text-success"></i>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-11 col-12 ">
                    <div class="card cardDashBoard">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col mr-2">
                                    <h6 class="font-weight-bold">Ticket médio</h6>
                                    <span id="ticket_medio" class="text-success font-weight-bold"></span>
                                    <i class="fas fa-file-invoice-dollar text-success"></i>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <div class="col-md-3 offset-md-0 col-10 offset-1 mb-3">
            <div class="card cardDashBoard">
                <div class="card-header text-center">
                    <h6 class="font-weight-bold">Transações por status</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="">
                        <canvas id="myPieChart"></canvas>
                    </div>

                    <div class="text-center small">

                        <i class="fas fa-circle text-success"></i>
                        <span id="pagas"></span>

                        <i style="color: #6045af" class="fas fa-circle"></i>
                        <span id="estornadas"></span>

                        <br>
                        <i class="fas fa-circle text-warning"></i>
                        <span id="autorizadas"></span>

                        <i class="fas fa-circle text-danger"></i>
                        <span id="recusadas"></span>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6 offset-md-0 col-10 offset-1">
            <div class="card cardDashBoard">
                <!-- Card Header - Dropdown -->
                <div class="card-header">
                    <h6 class="font-weight-bold text-center">Pedidos solicitados overView 2021</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bar Chart -->
        <div class="col-md-6 offset-md-0 col-10 offset-1">

            <div class="card cardDashBoard">
                <div class="card-header ">
                    <h6 class="font-weight-bold text-center">Tipos de serviços mais solicitados</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_loading" class="modal fade bd-loading-modal-lg" data-backdrop="static" data-keyboard="false"
         tabindex="-1">
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

<script src="docs/plugins/chart.js/Chart.bundle.min.js"></script>
<script src="docs/js/chart.js"></script>


</body>