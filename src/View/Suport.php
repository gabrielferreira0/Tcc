<script>
    $(document).ready(function () {
        $('#Suporte-telefone').mask('(99)9999-9999');
    });

    $('#Conteudo').on('click', '#enviarSuporte', function () {

        let nomeCompleto = $("#Suporte-nomeCompleto").val();
        let telefone = $('#Suporte-telefone').val();
        let email = $('#Suporte-Email').val();
        let mensagem = $('#Suporte-mensagem').val();


        if (mensagem == '' || nomeCompleto == "" || telefone == '' || email == '') {
            $("#erroSuporte").show().fadeOut(4000);
        }

        let formData = new FormData();
        formData.append('nomeCompleto', nomeCompleto)
        formData.append('telefone', telefone)
        formData.append('mensagem', mensagem)
        formData.append('email', email)
        formData.append('rq', 'suporte');
        let url = '../src/Controller/index.php';


        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function (rs) {
                if (rs==true) {
                    $("#sucessoSuporte").show().fadeOut(4000);

                } else {
                    $("#erroSuporte").show().fadeOut(4000);
                }
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });

    });


</script>

<style>

    #redes-sociais a {
        text-decoration: none;
        color: white;
        margin: 5px;
    }
</style>

<div class="container suporte col-12 col-md-11">
    <div class="text-center" style="margin-bottom: 2rem">
        <h1 style="font-family: 'Oswald', sans-serif;" class="text-center ">Procurando ajuda?</h1>
    </div>
    <div style="margin:0" class="row text-center col-12">
        <div class="col-md-4 col-12 offset-md-1 ">

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
                    <textarea id="Suporte-mensagem" placeholder="Mensagem" name="mensagem"
                              style="border-radius: 10px;resize: none;"
                              class="form-control"
                              rows="6" id="comment"></textarea>
                </div>
                <div class="form-group" style="display: flex;justify-content:flex-end;">
                    <button id="enviarSuporte" type="button" style="background: #007bff" class="btn btn-info">Enviar
                    </button>
                </div>
            </form>
            <div class="alert alert-danger text-center" id="erroSuporte" role="alert" style="display: none;">
                <strong>Erro! </strong> sua mensagem <strong>não foi enviada!</strong>
            </div>
            <div class="alert alert-success text-center"  id="sucessoSuporte" role="alert" style="display: none;">
                <strong>Sucesso! </strong> sua mensagem <strong>foi enviada!</strong>
            </div>
        </div>

        <div class="col-md-5 col-12 offset-md-1">
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