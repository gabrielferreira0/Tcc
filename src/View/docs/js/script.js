$(document).ready(function () {
    let CPF = $("#CPF");
    CPF.mask('999.999.999-99');
    let telefone = $("#Telefone");
    telefone.mask('(00) 0000-0000');


    $('#Conteudo').on('click', '#Login', function () {
        let loginHTML = '\ <div class="card cardFormulario col-md-3">\
            <div class="card-body" id="card-body">\
                <h3 class="text-center titulo"> Login  <i class="fas fa-users"></i></h3> \
                <form id="formulario" class="formulario" data-toggle="validator">\
                    <div class="form-row">\
                        <div class="form-group col-md-12">\
                            <label for="CPF">CPF:</label>\
                            <div class="input-group">\
                                <div class="input-group-prepend">\
                                    <span class="input-group-text arredondar"> <i class="fas fa-id-card-alt"></i></span>\
                                </div>\
                                <input type="text" class="form-control arredondar" id="CPF-login" placeholder="123.123.123-00"\
                                       max="11" data-error="Por favor, informe um CPF correto." required>\
                            </div>\
                            <div class="error help-block with-errors"></div>\
                        </div>\
                    </div>\
                    <div class="form-row">\
                        <div class="form-group col-md-12">\
                            <label for="Senha">Senha:</label>\
                            <div class="input-group">\
                                <div class="input-group-prepend">\
                                    <span class="input-group-text arredondar"> <i class="fas fa-lock"></i></span>\
                                </div>\
                                <input type="password" class="form-control arredondar" id="senha-login" placeholder="Senha"\
                                         maxlength="20" required>\
                            </div>\
                            <div class="error help-block with-errors"></div>\
                        </div>\
                    </div>\
                    </form>\
            </div>\
            <button id="Logar" type="button" class="Entrar btn btn btn arredondar">Login</button>\
            <a href="#!" class="login-card-footer-text">Esqueceu a senha?</a>\
            <p class="login-card-footer-text">Não possui uma conta? <a href="index.php" class="login-card-footer-text">Cadastrar-se\
                    aqui</a></p>\
        </div>';
        // $('.cardFormulario').remove();
        $('.geral').html(loginHTML);
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


        let cadastroHTML = '\ <div class="card cardFormulario">\n' +
            '<!--            inicia aqui-->\n' +
            '            <div class="card-body">\n' +
            '                <h3 class="text-center titulo"> Cadastro  <i class="fas fa-address-card"></i></h3>\n' +
            '                <form id="formulario" class="formulario" data-toggle="validator">\n' +
            '                    <div class="form-row">\n' +
            '                        <div class="form-group col-md-6">\n' +
            '                            <label for="Username">Usuario:</label>\n' +
            '                            <div class="input-group">\n' +
            '                                <div class="input-group-prepend">\n' +
            '                                    <span class="input-group-text arredondar"> <i class="fas fa-user"></i></span>\n' +
            '                                </div>\n' +
            '                                <input type="text" class="form-control arredondar" id="Username" placeholder="Usuario"\n' +
            '                                       required>\n' +
            '                            </div>\n' +
            '                            <div class="error help-block with-errors"></div>\n' +
            '                        </div>\n' +
            '                        <div class="form-group col-md-6">\n' +
            '                            <label for="Senha">Senha:</label>\n' +
            '                            <div class="input-group">\n' +
            '                                <div class="input-group-prepend">\n' +
            '                                    <span class="input-group-text arredondar"> <i class="fas fa-lock"></i></span>\n' +
            '                                </div>\n' +
            '                                <input type="password" class="form-control arredondar" id="Senha" placeholder="Senha"\n' +
            '                                       maxlength="20" required>\n' +
            '                            </div>\n' +
            '                            <div class="error help-block with-errors"></div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="form-group">\n' +
            '                        <label for="email">Email:</label>\n' +
            '                        <div class="input-group">\n' +
            '                            <div class="input-group-prepend">\n' +
            '                                <span class="input-group-text arredondar"> <i class="fas fa-envelope"></i></span>\n' +
            '                            </div>\n' +
            '                            <input type="email" class="form-control arredondar" id="Email"\n' +
            '                                   placeholder="nome@exemplo.com" data-error="Por favor, informe um email valido."\n' +
            '                                   required>\n' +
            '                        </div>\n' +
            '                        <div class="error help-block with-errors"></div>\n' +
            '                    </div>\n' +
            '                    <div class="form-row">\n' +
            '                        <div class="form-group col-xl-6">\n' +
            '                            <label for="CPF">CPF:</label>\n' +
            '                            <div class="input-group">\n' +
            '                                <div class="input-group-prepend">\n' +
            '                                    <span class="input-group-text arredondar"> <i class="fas fa-id-card-alt"></i></span>\n' +
            '                                </div>\n' +
            '                                <input type="text" class="form-control arredondar" id="CPF" placeholder="123.123.123-00"\n' +
            '                                       data-error="Por favor, informe um CPF correto." required>\n' +
            '                            </div>\n' +
            '                            <div class="error help-block with-errors"></div>\n' +
            '                        </div>\n' +
            '\n' +
            '                        <div class="form-group col-xl-6">\n' +
            '                            <label for="dt-nascimento">Data de nascimento:</label>\n' +
            '                            <div class="input-group">\n' +
            '                                <div class="input-group-prepend">\n' +
            '                                    <span class="input-group-text arredondar"> <i\n' +
            '                                            class="fas fa-calendar-alt"></i></span>\n' +
            '                                </div>\n' +
            '                                <input type="date" class="form-control arredondar" id="dt-nascimento"\n' +
            '                                       placeholder="Nascimento" required>\n' +
            '                            </div>\n' +
            '                            <div class="error help-block with-errors"></div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="form-row">\n' +
            '                        <div class="form-group col-xl-6">\n' +
            '                            <label for="Cidade">Cidade:</label>\n' +
            '                            <div class="input-group ">\n' +
            '\n' +
            '                                <div class="input-group-prepend">\n' +
            '                                    <span class="input-group-text arredondar"> <i class="fas fa-city"></i></span>\n' +
            '                                </div>\n' +
            '\n' +
            '                                <input type="text" class="form-control" id="Cidade"\n' +
            '                                       placeholder="Brasilia-DF" required>\n' +
            '                                <div class="input-group-append">\n' +
            '                                        <select class="form-control " id="UF" required>\n' +
            '                                            <option value="estado">UF</option>\n' +
            '                                            <option value="AC">AC</option>\n' +
            '                                            <option value="AL">AL</option>\n' +
            '                                            <option value="AP">AP</option>\n' +
            '                                            <option value="AM">AM</option>\n' +
            '                                            <option value="BA">BA</option>\n' +
            '                                            <option value="CE">CE</option>\n' +
            '                                            <option value="DF">DF</option>\n' +
            '                                            <option value="ES">ES</option>\n' +
            '                                            <option value="GO">GO</option>\n' +
            '                                            <option value="MA">MA</option>\n' +
            '                                            <option value="MT">MT</option>\n' +
            '                                            <option value="MS">MS</option>\n' +
            '                                            <option value="MG">MG</option>\n' +
            '                                            <option value="PA">PA</option>\n' +
            '                                            <option value="PB">PB</option>\n' +
            '                                            <option value="PR">PR</option>\n' +
            '                                            <option value="PE">PE</option>\n' +
            '                                            <option value="PI">PI</option>\n' +
            '                                            <option value="RJ">RJ</option>\n' +
            '                                            <option value="RN">RN</option>\n' +
            '                                            <option value="RS">RS</option>\n' +
            '                                            <option value="RO">RO</option>\n' +
            '                                            <option value="RR">RR</option>\n' +
            '                                            <option value="SC">SC</option>\n' +
            '                                            <option value="SP">SP</option>\n' +
            '                                            <option value="SE">SE</option>\n' +
            '                                            <option value="TO">TO</option>\n' +
            '                                        </select>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="error help-block with-errors"></div>\n' +
            '                        </div>\n' +
            '                        <div class="form-group col-xl-6">\n' +
            '                            <label for="Telefone">Telefone:</label>\n' +
            '                            <div class="input-group">\n' +
            '                                <div class="input-group-prepend">\n' +
            '                                    <span class="input-group-text arredondar"> <i class="fas fa-phone"></i></span>\n' +
            '                                </div>\n' +
            '                                <input type="text" class="form-control arredondar phone-mask" id="Telefone"\n' +
            '                                       placeholder="(DD) 0000-0000" required>\n' +
            '                            </div>\n' +
            '                            <div class="error help-block with-errors"></div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '\n' +
            '                    <div class="form-group" style="display: flex; justify-content:flex-end;">\n' +
            '                        <button id="cadastrar" type="button" class="btn btn-success">Cadastrar</button>\n' +
            '                    </div>\n' +
            '\n' +
            '                    <div class="alert alert-success testando text-center" id="alerta" role="alert"\n' +
            '                         style="display: none;">\n' +
            '                        <strong>Successo!</strong> você realizou seu <strong>Cadastro!</strong>\n' +
            '                    </div>\n' +
            '                    <div class="alert alert-danger testando text-center" id="alerta2" role="alert"\n' +
            '                         style="display: none;">\n' +
            '                        <strong>Erro! </strong> Seu cadastro <strong>não foi realizado!</strong>\n' +
            '                    </div>\n' +
            '                    <div class="alert alert-danger testando text-center" id="alerta3" role="alert"\n' +
            '                         style="display: none;">\n' +
            '                        <strong>Erro! </strong> Username <strong>já cadastrado!</strong>\n' +
            '                    </div>\n' +
            '                    <div class="alert alert-danger testando text-center" id="alerta4" role="alert"\n' +
            '                         style="display: none;">\n' +
            '                        <strong>Erro! </strong> Email <strong>já cadastrado!</strong>\n' +
            '                    </div>\n' +
            '                    <div class="alert alert-danger testando text-center" id="alerta5" role="alert"\n' +
            '                         style="display: none;">\n' +
            '                        <strong>Erro!  </strong> CPF <strong>já cadastrado!</strong>\n' +
            '                    </div>\n' +
            '\n' +
            '                    <div class="alert alert-danger testando text-center" id="alerta6" role="alert"\n' +
            '                         style="display: none; justify-content: flex-start;">\n' +
            '                         <strong>Erro!  </strong> Preencha <strong> todos os campos! </strong>\n' +
            '                    </div>\n' +
            '\n' +
            '                    <div class="alert alert-danger testando text-center" id="alerta7" role="alert"\n' +
            '                         style="display: none; justify-content: flex-start;">\n' +
            '                        <strong>Erro! </strong> CPF <strong> Inválido !</strong>\n' +
            '                    </div>\n' +
            '\n' +
            '                </form>\n' +
            '\n' +
            '            </div>\n' +
            '\n' +
            '<!--            termina aqui-->\n' +
            '        </div> ';
        // $('.cardFormulario').remove();
        $('.geral').html(cadastroHTML);
        let CPF = $("#CPF");
        CPF.mask('999.999.999-99');
        let telefone = $("#Telefone");
        telefone.mask('(00) 0000-0000');
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


});

