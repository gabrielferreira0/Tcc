function carregarCEP() {
    let CEP = $("#CEP").val().replace(/[^\d]+/g, '')
    $.ajax({
        type: "GET",
        dataType: 'text',
        url: 'https://viacep.com.br/ws/' + CEP + '/json/',
        async: true,
        success: function (rs) {
            rs = JSON.parse(rs);
            console.log(rs);
            $("#Logradouro").val(rs['logradouro']);
            $("#Complemento").val(rs['complemento']);
            $("#Bairro").val(rs['bairro']);
            $("#Cidade").val(rs['localidade']);
            $("#UF").val(rs['uf']);
        },
        error: function (e) {
            bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
        }
    });
}

$(document).ready(function () {
    let CPF = $("#CPF");
    let CEP = $("#CEP");
    CEP.mask("99.999-999");
    CPF.mask('999.999.999-99');
    let telefone = $("#Telefone");
    telefone.mask('(00) 0000-0000');


    $('#Conteudo').on('click', '#Login', function () {
        $("#cardServicos").hide();
        $("#cardCadastro").hide();
        $("#sobre").hide();
        $("#cardLogin").show();
        let CPF = $("#CPF-login");
        CPF.mask('999.999.999-99');
    });

    $('#Conteudo').on('click', '#Logar', function () {

        let CPF_login = $('#CPF-login').val();
        let senha_login = $('#senha-login').val();
        let url = '../crud/class/index.php';
        $.ajax({
            type: "POST",
            dataType: 'text',
            url: url,
            async: true,
            data: {
                rq: 'login',
                CPF_login: CPF_login,
                senha_login: senha_login,
            },
            success: function (rs) {
                //alert(rs);
                switch (rs) {
                    case 'true':
                        window.location.href = "Perfil.php";
                        break;
                    default :
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Dados invalidos!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                }
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });
    });

    $('#Conteudo').on('click', '#Registrar', function () {

        // $('.cardFormulario').remove();
        // $('.geral').html(cadastroHTML);
        // let CPF = $("#CPF");
        // CPF.mask('999.999.999-99');
        // let CEP = $("#CEP");
        // CEP.mask("99.999-999");
        // let telefone = $("#Telefone");
        // telefone.mask('(00) 0000-0000');
        $("#cardLogin").hide();
        $("#sobre").hide();
        $("#cardServicos").hide();
        $("#cardCadastro").show();
    });

    $('#Conteudo').on('click', '#cadastrar', function () {
        let username = $("#Username").val();
        let senha = $("#Senha").val();
        let email = $("#Email").val();
        let CPF = $("#CPF").val();
        let nascimento = $("#dt-nascimento").val();
        let cidade = $("#Cidade").val();
        let telefone = $('#Telefone').val();
        let UF = $("#UF option:selected").val();
        let url = '../crud/class/index.php';
        $.ajax({
            type: "POST",
            dataType: 'text',
            url: url,
            async: true,
            data: {
                rq: 'cadastrar',
                Username: username,
                Senha: senha,
                Email: email,
                CPF: CPF,
                Nascimento: nascimento,
                Cidade: cidade,
                Telefone: telefone,
                UF: UF,
            },
            success: function (rs) {
                switch (rs) {
                    case 'nomeC':
                        $("#alerta3").show().fadeOut(4000);
                        break;
                    case 'emailC':
                        $("#alerta4").show().fadeOut(4000);
                        break;
                        s
                    case 'cpfC':
                        $("#alerta5").show().fadeOut(4000);
                        break;
                    case 'null':
                        $("#alerta6").show().fadeOut(4000);
                        break;
                    case 'CPFinvalido':
                        $("#alerta7").show().fadeOut(4000);
                        break;
                    case '#alerta':
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Cadastro realizado com sucesso!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#Email").val("");
                        $("#Username").val("");
                        $("#CPF").val("");
                        $("#Senha").val("");
                        $("#Cidade").val("");
                        $("#dt-nascimento").val("");
                        $("#Telefone").val("");
                        $("#UF").val("UF");
                        break;
                }

            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });

    });

    $('#Conteudo').on('click', '#Alterar', function () {
        let username = $("#Username").val();
        let senha = $("#Senha").val();
        let nascimento = $("#dt-nascimento").val();
        let cidade = $("#Cidade").val();
        let telefone = $('#Telefone').val();
        let UF = $("#UF option:selected").val();
        let url = '../crud/class/index.php';
        $.ajax({
            type: "POST",
            dataType: 'text',
            url: url,
            async: true,
            data: {
                rq: 'update',
                Username: username,
                Senha: senha,
                Nascimento: nascimento,
                Cidade: cidade,
                Telefone: telefone,
                UF: UF,
            },
            success: function (rs) {

                console.log(rs);
                switch (rs) {
                    case 'false':
                        bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
                        break;
                    case 'null':
                        $("#alerta6").show().fadeOut(4000);
                        break;
                    default:
                        rs = rs.split(",")
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Dados alterados com sucesso!',
                            showConfirmButton: false,
                            timer: 1500,
                        })
                        $('#Welcome').html("Bem vindo, " + rs[0]);
                        // $('#Senha').html(rs[1]);
                        // $('#dt-nascimento').html(rs[2]);
                        // $('#Cidade').html(rs[3]);
                        // $('#Telefone').html(rs[4]);
                        // $('#UF2').html(rs[5]);
                        break;
                }
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });
    });

    $('#Conteudo').on('click', '#Excluir', function () {
        let url = '../crud/class/index.php';
        $.ajax({
            type: "POST",
            dataType: 'text',
            url: url,
            async: true,
            data: {
                rq: 'delete',
            },
            success: function (rs) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Cadastro deletado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500,
                })
                setTimeout(function () {
                    location.reload();
                }, 1700);
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });
    });

    $('#Conteudo').on('click', '#Deslogar', function () {
        let url = '../crud/class/index.php';
        $.ajax({
            type: "POST",
            dataType: 'text',
            url: url,
            async: true,
            data: {
                rq: 'deslogar',
            },
            success: function (rs) {
                switch (rs) {
                    case 'true':
                        window.location.href = "index.php";
                        break;
                }
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });
    });

    $('#Conteudo').on('click', '#foto', function () {
        $("#addFotoGaleria").trigger('click')
    });

});



$(function() {
// Pré-visualização de várias imagens no navegador
    var visualizacaoImagens = function(input, lugarParaInserirVisualizacaoDeImagem) {
        if (input.files) {
            var quantImagens = input.files.length;

            for (i = 0; i < quantImagens; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="miniatura">')).attr('src', event.target.result).appendTo(lugarParaInserirVisualizacaoDeImagem);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };
    $('#addFotoGaleria').on('change', function() {
        $('#foto').remove();
        visualizacaoImagens(this, 'div.galeria');
    });


});