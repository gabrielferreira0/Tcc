function carregarCEP() {
    let CEP = $("#CEP").val().replace(/[^\d]+/g, '')
    $.ajax({
        type: "GET",
        dataType: 'text',
        url: 'https://viacep.com.br/ws/' + CEP + '/json/',
        async: true,
        success: function (rs) {
            rs = JSON.parse(rs);
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
        $("#cardCardRecuperar").hide();
        $("#carousel").hide();
        $("#sobre").hide();
        $("#suporte").hide();
        $("#cardLogin").show();
        let CPF = $("#CPF-login");
        CPF.mask('999.999.999-99');
    });


    $('#Conteudo').on('click', '#Recuperar', function () {
        let CPFrecuperar = $('#CPF-recuperar').val().replace(/[^\d]+/g, '')
        let url = '../src/Controller/index.php';


        if (CPFrecuperar == "") {
            $("#alertaRecuperar").show().fadeOut(4000);
            return;
        }

        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            data: {
                rq: 'recuperar',
                CPFrecuperar: CPFrecuperar
            },
            success: function (rs) {
                if (rs == true) {
                    $("#alertaRecuperar3").show().fadeOut(4000);
                } else {
                    $("#alertaRecuperar2").show().fadeOut(4000);
                }
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });

    });


    $('#Conteudo').on('click', '#Logar', function () {

        let CPFlogin = $('#CPF-login').val().replace(/[^\d]+/g, '')
        let senhaLogin = $('#senha-login').val();
        let url = '../src/Controller/index.php';
        $.ajax({
            type: "POST",
            dataType: 'text',
            url: url,
            async: true,
            data: {
                rq: 'login',
                CPFlogin: CPFlogin,
                senhaLogin: senhaLogin,
            },
            success: function (rs) {

                switch (rs) {
                    case 'true':
                        window.location.href = "index.php";
                        break;
                    default:
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
        $("#suporte").hide();
        $("#cardServicos").hide();
        $("#carousel").hide();
        $("#cardCardRecuperar").hide();
        $("#cardCadastro").show();
    });

    $('#Conteudo').on('click', '#sobreteste', function () {
        $("#cardCadastro").hide();
        $("#cardLogin").hide();
        $("#cardServicos").show();
        $("#sobre").show();
        $("#suporte").show();
        window.location.href = "index.php#sobre"
    });

    $('#Conteudo').on('click', '#suporte-navbar', function () {
        $("#cardCadastro").hide();
        $("#cardLogin").hide();
        $("#cardServicos").show();
        $("#sobre").show();
        $("#suporte").show();
        window.location.href = "index.php#suporte"
    });


    $('#Conteudo').on('click', '#cadastrar', function () {
        // let nascimento = $("#dt-nascimento").val();
        //let cidade = $("#Cidade").val();
        //let UF = $("#UF option:selected").val();
        let username = $("#Username").val();
        let senha = $("#Senha").val();
        let email = $("#Email").val();
        let formData = new FormData();
        let foto = $('#addFotoGaleria')[0].files[0];
        let fotoStatus;
        let CPF = $("#CPF").val().replace(/[^\d]+/g, '')
        let telefone = $("#Telefone").val().replace('-', '')

        if (!foto) {
            fotoStatus = 'false'
        } else {
            fotoStatus = 'true'
        }

        formData.append('username', username);
        formData.append('senha', senha);
        formData.append('email', email);
        formData.append('CPF', CPF);
        formData.append('foto', foto);
        formData.append('fotoStatus', fotoStatus);
        formData.append('telefone', telefone);
        formData.append('rq', 'cadastrar');

        let url = '../src/Controller/index.php';
        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function (rs) {
                console.log(rs)
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
                    case 'sucesso':
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
                        $("#Telefone").val("");
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
        let telefone = $('#Telefone').val();
        let foto = $('#addFotoGaleria')[0].files[0];
        let fotoStatus;
        let fotoAtual = $('#fotoAtual').val();
        let senhaStatus;
        let url = '../../src/Controller/index.php';


        if (!foto && !fotoAtual) {
            fotoStatus = 'false'
        } else if (!foto && fotoAtual) {
            fotoStatus = 'jaTem'
            foto = fotoAtual;
        } else if (foto) {
            fotoStatus = 'true'
        }


        if (!senha) {
            senhaStatus = 'false'
        } else {
            senhaStatus = 'true'
        }

        let formData = new FormData();
        formData.append('username', username);
        formData.append('senha', senha);
        formData.append('foto', foto);
        formData.append('fotoStatusupd', fotoStatus);
        formData.append('fotoAtual', fotoAtual);
        formData.append('senhaStatus', senhaStatus);
        formData.append('telefone', telefone);
        formData.append('rq', 'update');

        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
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
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Dados alterados com sucesso!',
                            showConfirmButton: false,
                            timer: 1500,
                        })
                        $('#Welcome').html(username);
                        break;
                }
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });
    });


    $('#Conteudo').on('click', '#salvarCat', function () {
        let formData = new FormData();

        let servicos = $(".services").find('input');
        let servico = [];
        for (let i = 0; i < servicos.length; i++) {
            servico[i] = ($(servicos[i]).val());
        }
        ;

        servicos = JSON.stringify(servico);
        let categoria = $("#nomeCategoria").val();
        let fotoCategoria = $('#addFotoCat')[0].files[0];

        //pegando os tipos de serviços de cada categoria

        formData.append('servicos', servicos)
        formData.append('categoria', categoria)
        formData.append('fotoCategoria', fotoCategoria)
        formData.append('rq', 'salvarCat');
        let url = '../../src/Controller/index.php';


        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function (rs) {
                console.log(rs);
                if (rs == 'sucesso') {
                    $("#catSucesso").show().fadeOut(4000);
                    $("#Categoria").val('');
                    $("#addFotoCat").val('');
                    $("#imgCategoria").html("<span style=\"font-size: 6rem\" class=\"far fa-image\"></span>");
                } else {
                    $("#catFalha").show().fadeOut(4000);
                }
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });

    });

    $('#Conteudo').on('click', '#listarCat', function () {
        $("#listaCat").show();
        $("#formCategoria").hide();
        $("#listaUsers").hide();
        $("#cardCardRecuperar").hide();
    });

    $('#Conteudo').on('click', '#listarUsers', function () {
        $("#listaCat").hide();
        $("#formCategoria").hide();
        $("#listaUsers").show();
        $("#cardCardRecuperar").hide();
    });

    $('#Conteudo').on('click', '#Categoria', function () {
        $("#formCategoria").show();
        $("#listaCat").hide();
        $("#listaUsers").hide();
        $("#cardCardRecuperar").hide();

    });


    $('#Conteudo').on('click', '#Excluir', function () {
        let url = '../../src/Controller/index.php';
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
        let url = '../src/Controller/index.php';
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

    $('#Conteudo').on('click', '#Deslogar2', function () {
        let url = '../../src/Controller/index.php';
        $.ajax({
            type: "POST",
            dataType: 'text',
            url: url,
            async: true,
            data: {
                rq: 'deslogar',
            },
            success: function (rs) {
                console.log(rs);
                switch (rs) {
                    case 'true':
                        window.location.href = "../index.php";
                        break;
                }
            },
            error: function (e) {
                bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
            }
        });
    });

    $('#Conteudo').on('click', '.galeria', function () {
        $("#addFotoGaleria").trigger('click')
        $(".miniatura").remove();
    });


    $('#Conteudo').on('click', '#imgCategoria', function () {
        $("#addFotoCat").trigger('click')
        $(".miniatura").remove();
    });
    $('#Conteudo').on('click', '.avatar', function () {
        window.location.href = "./Perfil.php";
    });


    $('#modalInfo').on('show.bs.modal', function (event) {

        //função para mostrar os dados na modal
        let button = $(event.relatedTarget)
        let nomeCat = button.attr('data-nomeC')
        let image = button.attr('data-image')
        let idCategoria = button.attr('data-idCat');
        let modal = $(this)


        modal.find('#categoriaUPD').val(nomeCat)
        modal.find('#imagemCatAtual').val(image);
        modal.find('#idCategoria').val(idCategoria);
        modal.find('#imageCatUPD').attr('src', "../imagens/categoria/" + image);
        modal.find('#miniaturaCat').attr('src', "../imagens/categoria/" + image);
        // retira a classe miniatura PARA ajustar o tamanho da imagem com a class do boostrap
        $("#miniaturaCat").removeClass('miniaturaCat').addClass('card-img-top');
    })


    $('#modalInfoUsers').on('show.bs.modal', function (event) {
        let modal = $(this)
        let button = $(event.relatedTarget)
        let usuID = button.attr('data-idUser')
        let usuNome = button.attr('data-nameUser')
        let usuTelefone = button.attr('data-telefoneUser')
        let usuEmail = button.attr('data-emailUser')
        let usuCPF = button.attr('data-cpfUser')
        let usuFoto = button.attr('data-fotoUser')
        let HTMLfoto;


        if (usuFoto != 'false') {
            let HTMLfoto = '<img  class ="miniatura" src="../imagens/usuarios/' + usuFoto + '">'
            modal.find('.fotoUser').html(HTMLfoto);
        } else {

            let HTMLfoto =
                '\<div class="d-flex align-items-center d-flex justify-content-center col-4 col-md-4" id="usuFoto"\
                   title="Foto de perfil">\
                <h1 class="fas fa-user"></h1> \
        </div>';

            modal.find('.fotoUser').html(HTMLfoto);
        }


        modal.find('#Username').val(usuNome);
        modal.find('#Telefone').val(usuTelefone);
        modal.find('#Email').val(usuEmail);
        modal.find('#CPF').val(usuCPF);
        modal.find('.fotoUser').html(HTMLfoto);

    })


    $('#Conteudo').on('click', '.setStatusCat', function () {
        let idCat = $(this).prev().val();
        let status = $(this).val();
        let url = '../../src/Controller/index.php';
        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            data: {
                rq: 'setStatusCat',
                status: status,
                idCat: idCat,
            },
            success: function (rs) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Categoria alterada com sucesso!',
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

});


$(function () {
    // Pré-visualização de várias imagens no navegador
    var visualizacaoImagens = function (input, lugarParaInserirVisualizacaoDeImagem) {
        if (input.files) {
            var quantImagens = input.files.length;

            for (i = 0; i < quantImagens; i++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $($.parseHTML('<img class="miniatura">')).attr('src', event.target.result).appendTo(lugarParaInserirVisualizacaoDeImagem);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    var visualizacaoImagensCat = function (input, lugarParaInserirVisualizacaoDeImagem) {
        if (input.files) {
            var quantImagens = input.files.length;

            for (i = 0; i < quantImagens; i++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $($.parseHTML('<img  id ="miniaturaCat" class="miniaturaCat">')).attr('src', event.target.result).appendTo(lugarParaInserirVisualizacaoDeImagem);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };


    $('#updImagemCat').on('change', function () {
        //$('#galeraUPDCat').children().css("display",'none');
        $('#galeraUPDCat').children().remove();
        visualizacaoImagensCat(this, 'div.galeria');
    });


    $('#addFotoGaleria').on('change', function () {
        $('#foto').remove();
        visualizacaoImagens(this, 'div.galeria');
    });

    $('#addFotoCat').on('change', function () {
        $('#imgCategoria').children().remove();
        visualizacaoImagensCat(this, 'div#imgCategoria');
    });

});

function showCardCadastro() {
    $("#cardLogin").hide();
    $("#cardCadastro").show();
}

function showCardRecuperar() {
    let CPF = $("#CPF-recuperar");
    CPF.mask('999.999.999-99');
    $("#cardLogin").hide();
    $("#cardCardRecuperar").show();
}


function updImagemCat() {
    $("#updImagemCat").trigger('click')
}

function updateCat() {

    let idCategoria = $('#idCategoria').val();
    let categoriaUPD = $('#categoriaUPD').val();
    let imagemCatAtual = $('#imagemCatAtual').val();
    let novaImagemCat = $('#updImagemCat')[0].files[0];
    let imagemUpdCat;
    let url = '../../src/Controller/index.php';


    if (novaImagemCat) {
        imagemUpdCat = true;
    } else {
        imagemUpdCat = false;
    }


    let formData = new FormData();
    formData.append('idCategoria', idCategoria)
    formData.append('categoriaUPD', categoriaUPD)
    formData.append('imagemCatAtual', imagemCatAtual)
    formData.append('novaImagemCat', novaImagemCat)
    formData.append('imagemUpdCat', imagemUpdCat)
    formData.append('rq', 'updateCat');


    $.ajax({
        url: url,
        dataType: 'text',
        type: 'post',
        contentType: false,
        processData: false,
        data: formData,
        success: function (rs) {

            console.log(rs);
            if (rs == 'sucesso') {
                $("#catSucesso2").show().fadeOut(4000);
            } else {
                $("#catFalha").show().fadeOut(4000);
            }
        },
        error: function (e) {
            bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
        }
    });


}

