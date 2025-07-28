<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="certificado_form">
                <div class="modal-body">
                    <input type="hidden" name="cert_esp_id" id="cert_esp_id"/>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Usuario: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="usu_id" id="usu_id" data-placeholder="Seleccione" required>
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Título: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="cert_esp_titulo" type="text" name="cert_esp_titulo" required/>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Descripción: <span class="tx-danger">*</span></label>
                            <textarea class="form-control" id="cert_esp_descrip" name="cert_esp_descrip" rows="3" required></textarea>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Inicio: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="cert_esp_fechini" type="date" name="cert_esp_fechini" required/>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Fin: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="cert_esp_fechfin" type="date" name="cert_esp_fechfin" required/>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" name="action" value="add" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                    <button type="button" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>