<div id="modalfile" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Seleccione Imagen del Certificado</h6>
            </div>

            <form method="post" id="detalle_form" enctype="multipart/form-data">
                <input type="hidden" name="cert_esp_id" id="cert_esp_id_upload"/>

                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Imagen del Certificado: <span class="tx-danger">*</span></label>
                            <input type="file" id="cert_esp_img" name="cert_esp_img" required/>
                        </div>
                        <div class="preview-container">
                            <img id="preview_img" src="" style="max-width: 100%; display: none;" alt="Vista previa">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                    <button type="button" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Vista previa de la imagen
document.getElementById('cert_esp_img').addEventListener('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('preview_img').src = e.target.result;
        document.getElementById('preview_img').style.display = 'block';
    }
    reader.readAsDataURL(this.files[0]);
});
</script>