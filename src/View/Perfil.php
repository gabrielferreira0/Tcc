<?php
session_start();
include ('../Controller/verificarLogin.php')
?>

<head>
    <title>Perfil</title>
    <?php
    include ('Head.php');
    ?>
</head>

<body id="Conteudo">

<?php
include ('Navbar.php');
?>

<div class="container-fluid ">
    <div class="d-flex justify-content-center geral">
        <div class="card cardFormulario">
            <!--            inicia aqui-->
            <div class="card-body">
                <h3 class="text-center titulo"> Perfil <i class="fas fa-address-card"></i></h3>
                <form id="formulario" class="formulario" data-toggle="validator" enctype="multipart/form-data">

                    <div class="d-flex justify-content-center galeria">

                        <?php
                        if ($_SESSION['Foto'] != 'false'){
                            echo '<img  class = "miniatura" src="../imagens/'.$_SESSION['Foto'].'">';
                        }
                        else {
                            echo '<div class="d-flex align-items-center d-flex justify-content-center col-4 col-md-4" id="foto"
                             title="Foto de perfil">
                            <h1 class="fas fa-user"></h1>
                        </div>';
                        }
                        ?>


                        </div>
                    <div style="display: none">
                        <input type="file" multiple id="addFotoGaleria" accept="image/x-png,image/gif,image/jpeg">
                    </div>

                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="Username">Usuario:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-user"></i></span>
                                </div>
                                <input  value="<?php echo $_SESSION['User']; ?>"  type="text" class="form-control arredondar" id="Username" placeholder="Usuario"
                                       required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Senha">Nova senha:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-lock"></i></span>
                                </div>
                                <input  type="text" class="form-control arredondar" id="Senha" placeholder="Senha"
                                       maxlength="20" required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-envelope"></i></span>
                            </div>
                            <input  value="<?php echo $_SESSION['Email']; ?>" type="email" class="form-control arredondar" id="Email"
                                   placeholder="nome@exemplo.com" data-error="Por favor, informe um email valido."
                                   disabled>
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xl-6">
                            <label for="CPF">CPF:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-id-card-alt"></i></span>
                                </div>
                                <input  value="<?php echo $_SESSION['CPF']; ?>" type="text" class="form-control arredondar" id="CPF" placeholder="123.123.123-00"
                                       data-error="Por favor, informe um CPF correto." disabled>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="Telefone">Telefone:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text arredondar"> <i class="fas fa-phone"></i></span>
                                </div>
                                <input   value="<?php echo $_SESSION['Telefone']; ?>" type="text" class="form-control arredondar phone-mask" id="Telefone"
                                         placeholder="(DD) 0000-0000" required>
                            </div>
                            <div class="error help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; justify-content:flex-end;">
                        <button  style="margin:3px;"  id="Excluir"  type="button" class="btn btn-danger">Excluir</button>
                        <button  style="margin:3px;"  id="Alterar"  type="button" class="btn btn-primary">Alterar</button>
                    </div>

                    <div class="alert alert-danger testando text-center" id="alerta2" role="alert"
                         style="display: none;">
                        <strong>Erro! </strong> Seu cadastro <strong>não foi realizado!</strong>
                    </div>
                    <div class="alert alert-danger testando text-center" id="alerta3" role="alert"
                         style="display: none;">
                        <strong>Erro! </strong> Username <strong>já cadastrado!</strong>
                    </div>
                    <div class="alert alert-danger testando text-center" id="alerta4" role="alert"
                         style="display: none;">
                        <strong>Erro! </strong> Email <strong>já cadastrado!</strong>
                    </div>
                    <div class="alert alert-danger testando text-center" id="alerta5" role="alert"
                         style="display: none;">
                        <strong>Erro! </strong> CPF <strong>já cadastrado!</strong>
                    </div>

                    <div class="alert alert-danger testando text-center" id="alerta6" role="alert"
                         style="display: none; justify-content: flex-start;">
                        <strong>Erro! </strong> Preencha <strong> todos os campos! </strong>
                    </div>
                    <div class="alert alert-danger testando text-center" id="alerta7" role="alert"
                         style="display: none; justify-content: flex-start;">
                        <strong>Erro! </strong> CPF <strong> Inválido !</strong>
                    </div>

                </form>

            </div>

            <!--            termina aqui-->
        </div>
    </div>
</div>

<?php
include ('Footer.php');
?>
</body>