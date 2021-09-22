<div class="navbar  navbar-expand-sm  navbar-dark mb-4 " role="navigation" style="background: #202020">
    <a style="text-decoration:none;" href=" ../index.php">
        <img class="logo" src="../imagens/logo.png" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse menu" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link arredondar" href="../index.php#sobre"><i class="fas fa-building"></i> Sobre Nós</a>
            </li>
            <li class="nav-item">
                <a style="cursor:pointer" class="nav-link arredondar" href="../index.php#suporte">
                    <img  style="height: 1.7rem" src="../imagens/svg/icone-suporte-azul.svg" alt="">Suporte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link arredondar" href="Perfil.php"><i class="fas fa-user-circle"></i> Perfil</a>
            </li>

            <li class="nav-item">
                <a class="nav-link arredondar" href="MeusServicos.php"><i class="fas fa-briefcase"></i> Meus serviços</a>
            </li>

            <?php
            if (isset($_SESSION['CPF']) && $_SESSION['Tipo'] == '1') {
                echo '<li class="nav-item">
                        <a class="nav-link arredondar" href="Painel.php"><i class="fas fa-cogs"></i> Painel</a>
                       </li>';
            }
            ?>
        </ul>
        <div class="d-flex justify-content-center align-items-center">
            <?php
            if ($_SESSION['Foto'] != 'false') {
                echo '<span  id ="Welcome" style="color: lightgray" class="nav-link text-center  arredondar" href="Perfil.php">' . $_SESSION['User'] . '</span>';
                echo '<img  class = "avatar iconeNavBar" src="../imagens/usuarios/' . $_SESSION['Foto'] . '"';
            } else
                echo '<span  id ="Welcome" style="color: lightgray" class="nav-link text-center  arredondar" href="Perfil.php">' . $_SESSION['User'] . '</span>';
                echo '<span class="fa fa-user-circle photo text-center iconeNavBar"></span>';
            ?>
        </div>
        <a class="nav-link text-center Deslogar" id="Deslogar2">Sair</a>
    </div>
</div>
