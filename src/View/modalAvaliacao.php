<div style="color: white" class="modal fade" id="modalAvaliacao" data-backdrop="static" data-keyboard="false"
     tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="background: #202020" class="modal-content">

            <div class="modal-header  d-flex justify-content-center">
                <h2  style="color:lightgray" class="modal-title">Avaliação</h2>
            </div>
            <div class="modal-body">

                <div class=" col-md-8 offset-md-2">
                    <img src="../imagens/svg/Online%20Review-cuate1.svg" alt="banner-avaliação">
                </div>

                <div class="d-flex justify-content-center">

                    <div class="form-check">
                        <span title="Pessímo" data-value="1" class="estrela"><i class="fas fa-star "></i></span>
                        <span title="Ruim" data-value="2" class="estrela"><i class="fas fa-star "></i></span>
                        <span title="Regular" data-value="3" class="estrela"><i class="fas fa-star "></i></span>
                        <span title="Bom" data-value="4" class="estrela"><i class="fas fa-star "></i></span>
                        <span title="Otímo" data-value="5" class="estrela"><i class="fas fa-star "></i></span>
                    </div>
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
