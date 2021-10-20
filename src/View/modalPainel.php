<div style="color: white" class="modal fade" id="modalInfo" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="background: #202020" class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Informações da Categoria</h5>
                <button style="color: white" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <div class="alert alert-success testando text-center" id="catSucesso2" role="alert"
                     style="display: none;">
                    <strong>Aviso! </strong> Categoria adicionada com <strong>sucesso!</strong>
                </div>

                <div class="alert alert-danger testando text-center" id="catFalha" role="alert" style="display: none;">
                    <strong>Erro! </strong> Categoria não foi <strong>alterada!</strong>
                </div>
                <div class="container col-md-8">
                    <div class=" d-flex justify-content-center input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text arredondar"> <i class="fas fa-tools"></i></span>
                        </div>
                        <input  type="hidden" id="idCategoria">

                        <input type="text" class="form-control arredondar" id="categoriaUPD"
                               value=""  required="">
                    </div>

                </div>

                <div style="display: none">
                    <input type="file" multiple id="updImagemCat" accept="image/x-png,image/gif,image/jpeg">
                    <input  type="text" multiple id="imagemCatAtual">
                </div>

                <div id="galeraUPDCat" onclick="updImagemCat()" style=" cursor:pointer;margin-top: 1rem;"
                     class="d-flex align-items-center justify-content-center col-md-8 offset-md-2 galeria">
                    <img  title="Clique para alterar" id="imageCatUPD" class="card-img-top" src=""
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" onclick="updateCat()" class="btn btn-primary">Alterar</button>
            </div>
        </div>
    </div>
</div>
