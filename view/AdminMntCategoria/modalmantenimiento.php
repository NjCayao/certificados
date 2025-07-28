<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0  tx-inverse tx-bold"></h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="categoria_form">
                <div class="modal-body">
                    <input type="hidden" name="cat_id" id="cat_id"/>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="cat_nom" type="text" name="cat_nom" required/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="add" class="btn btn-outline-primary tx-11  pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                    <button type="reset" class="btn btn-outline-secondary tx-11  pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('categoria_form').addEventListener('submit', function () {
        // Obtener el valor del campo
        var nombre = document.getElementById('cat_nom').value;

        // Convertir todo el contenido a mayúsculas
        var nombreEnMayusculas = nombre.toUpperCase();

        // Asignar el valor en mayúsculas al campo
        document.getElementById('cat_nom').value = nombreEnMayusculas;
    });
</script>