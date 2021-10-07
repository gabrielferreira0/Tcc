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
                                    <div class="font-weight-bol text-success font-weight-bold ">R$40,000</div>
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
                                    <span class="font-weight-bol texto-cinza font-weight-bold">999
                                    <i class="fas fa-exchange-alt"></i>
                                </span>

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
                                    <span class="small texto-cinza font-weight-bold">
                                        <img style="width: 2.5rem" src="../imagens/svg/visa-logo.svg"
                                             alt="logo MasterCard">   Visa 62.5%
                                    </span>
                                    <br>
                                    <span class="small texto-cinza font-weight-bold">
                                        <img style="width: 2.5rem" src="../imagens/svg/mastercard-seeklogo.com.svg"
                                             alt="logo MasterCard"> Mastercard 37.5%
                                    </span>
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
                                    <div class="font-weight-bol text-success font-weight-bold">R$3.130,00</div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="col-md-11 col-12 ">
                    <div class="card cardDashBoard">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col mr-2">
                                    <h6 class="font-weight-bold">Ticket médio</h6>
                                    <div class="font-weight-bol text-success font-weight-bold">R$223,57</div>

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

                        <span>
                              <i class="fas fa-circle text-success"></i> Paga 7
                            </span>

                        <span>
                              <i style="color: #6045af" class="fas fa-circle"></i> Estornada 3
                            </span>

                        <br>
                        <span>
                              <i class="fas fa-circle text-warning"></i> Autorizada 2
                            </span>

                        <span>
                              <i class="fas fa-circle text-danger"></i> Recusada 1
                            </span>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-9 offset-md-0 col-10 offset-1">
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
        

    </div>
</div>


<?php
include('Footer.php');
?>

<script src="docs/plugins/chart.js/Chart.bundle.min.js"></script>
<script src="docs/js/chart-pie-demo.js"></script>
<script src="docs/js/chart-area-demo.js"></script>


</body>