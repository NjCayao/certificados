<div id="modalplantilla" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Subir Plantilla</h6>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label">Seleccionar Plantilla: <span class="tx-danger">*</span></label>
                        <form id="form-subir-plantilla" enctype="multipart/form-data">
                            <input id="upload" type="file" name="files[]" accept=".xlsx, .xls">
                        </form>
                    </div>
                </div><br>
                <div class="form-group">
                    <a href="../../docs/usuarios.xlsx" target="_new" class="text-dark mr-auto">
                        <span class="mr-2">Descargar formato de ejemplo para importar</span> <i class="fa fa-download"></i>
                    </a>        
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                <button id="btnSubirArchivo" class="btn btn-primary">Subir archivo</button>
            </div>
        </div>
    </div>
</div>
