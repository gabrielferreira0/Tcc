<div style="color: white" class="modal fade" id="modalAvaliacao" data-backdrop="static" data-keyboard="false"
     tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="background: #202020" class="modal-content">

            <div class="modal-header  d-flex justify-content-center">
                <h2 class="modal-title " id="exampleModalLabel">Avaliação</h2>
            </div>
            <div class="modal-body">

                <div class=" col-md-8 offset-md-2">
                    <img src="../imagens/svg/Online%20Review-cuate1.svg" alt="banner-avaliação">
                </div>

                <div class="d-flex justify-content-center">

                    <div class="form-check">
                        <span data-value="1" class="estrela"><i id="estrela1" class="fas fa-star "></i></span>
                        <span data-value="2" class="estrela"><i id="estrela2" class="fas fa-star "></i></span>
                        <span data-value="3" class="estrela"><i id="estrela3" class="fas fa-star "></i></span>
                        <span data-value="4" class="estrela"><i id="estrela4" class="fas fa-star "></i></span>
                        <span data-value="5" class="estrela"><i id="estrela5" class="fas fa-star "></i></span>
                    </div>

                </div>


                <div class="alert alert-success text-center" id="sucesso" role="alert"
                     style="display: none;">
                    <strong>Avaliação realizada com sucesso!</strong>
                </div>

                <div class="alert alert-danger text-center" id="catFalha" role="alert"
                     style="display: none;">
                    <strong>Erro!</strong>
                </div>

            </div>



            <div class='modal-footer'>
                <?php
                echo " <button id='finalizarPedido' type='button' class='btn btn-success' 
                    data-idPedido='{$_GET['pedido']}' data-dismiss='modal'>Enviar</button>";
                ?>
            </div>
        </div>
    </div>
</div>
