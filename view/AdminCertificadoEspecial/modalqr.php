<div id="modalqr" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Código QR</h6>
            </div>

            <div class="modal-body text-center">
                <p>Este código QR permite verificar la autenticidad del certificado. Inclúyalo en el certificado antes de subirlo al sistema.</p>
                <img id="qr_img" src="" class="img-fluid" style="max-width: 300px; border: 1px solid #ddd; padding: 5px;">
                <p class="mt-3 text-muted">El QR incluye el logo de la institución para mayor personalización.</p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" onclick="downloadQR()">
                    <i class="fa fa-download"></i> Descargar QR
                </button>
                <button type="button" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">
                    <i class="fa fa-close"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>