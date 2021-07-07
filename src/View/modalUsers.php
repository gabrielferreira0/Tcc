<style>

    #usuFoto {
        height: 75px;
        cursor: pointer;
        border-radius: 50%;
        border: 1px solid transparent;
        background: rgba(0, 0, 0, 0.8);
    }

</style>

<div style="color: white" class="modal fade" id="modalInfoUsers" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="background: #202020" class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Informações do Usuário</h5>
                <button style="color: white" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">


                <div class="d-flex justify-content-center fotoUser">



                </div>
                <div style="display: none">
                    <input type="file" multiple id="addFotoGaleria" accept="image/x-png,image/gif,image/jpeg">
                    <input value="<?php echo $_SESSION['Foto']; ?>" type="text" multiple id="fotoAtual">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Username">Usuario:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control arredondar"
                                   id="Username" placeholder="Usuario"
                                   disabled>
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Telefone">Telefone:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-phone"></i></span>
                            </div>
                            <input  type="text"
                                   class="form-control arredondar phone-mask" id="Telefone"
                                   placeholder="(DD) 0000-0000"  disabled>
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
                        <input  type="email" class="form-control arredondar"
                               id="Email"
                               placeholder="nome@exemplo.com" data-error="Por favor, informe um email valido."
                               disabled>
                    </div>
                    <div class="error help-block with-errors"></div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="CPF">CPF:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text arredondar"> <i class="fas fa-id-card-alt"></i></span>
                            </div>
                            <input type="text" class="form-control arredondar"
                                   id="CPF" placeholder="123.123.123-00"
                                   data-error="Por favor, informe um CPF correto." disabled>
                        </div>
                        <div class="error help-block with-errors"></div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>
