<script>
    $(document).ready(function () {
        $('#Suporte-telefone').mask('(99)9999-9999');
    });
</script>

<style>

    #redes-sociais a {
        text-decoration: none;
        color: white;
        margin: 5px;
    }
</style>

<div class="container suporte col-11">
    <div class="text-center">
        <h1 style="font-family: 'Oswald', sans-serif;" class="text-center ">Procurando ajuda?</h1>
    </div>
    <div style="margin-top: 2rem" class="row text-center">
        <div class="col-md-3 offset-md-2">

            <form id="formSuporte" method="POST" action="">
                <div class="form-group">
                    <input style=" margin-bottom:1rem;border-radius: 10px" placeholder="Nome Completo"
                           name="nomeCompleto" id="Suporte-nomeCompleto"
                           type="text"
                           class="form-control" required/>

                    <input style=" margin-bottom:1rem; border-radius: 10px" type="text" class="form-control"
                           id="Suporte-telefone" name="telefone"
                           placeholder="Telefone" required>

                    <input style=" margin-bottom:1rem;border-radius: 10px" type="email" class="form-control"
                           id="Suporte-Email"
                           placeholder="Email" name="email"
                           required>
                    <textarea placeholder="Mensagem" name="mensagem" style="border-radius: 10px;resize: none;"
                              class="form-control"
                              rows="6" id="comment"></textarea>
                </div>
                <div class="form-group" style="display: flex;justify-content:flex-end;">
                    <button type="button" style="background: #007bff" class="btn btn-info">Enviar</button>
                </div>
            </form>
        </div>
        <div class="col-md-5 offset-md-1">
            <h2 style="border-bottom: 1px solid white">Siga-nos nas redes sociais</h2>

            <div id="redes-sociais">
                <a href="https://www.instagram.com/"><i style="font-size: 2.5rem" class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/"><i style="font-size: 2.5rem" class="fab fa-youtube"></i></a>
                <a href="https://twitter.com/home"><i style="font-size: 2.5rem" class="fab fa-twitter"></i></a>
                <a href="https://www.linkedin.com/"><i style="font-size: 2.5rem" class="fab fa-linkedin-in"></i></a>
            </div>
            <img src="imagens/svg/Active Support-pana.svg" alt="logo-suporte">
        </div>
    </div>
</div>