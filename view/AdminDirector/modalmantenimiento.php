<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0  tx-inverse tx-bold"></h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="instructor_form">
                <div class="modal-body">
                    <input type="hidden" name="inst_id" id="inst_id"/>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="inst_nom" type="text" name="inst_nom" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Apellido Paterno: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="inst_apep" type="text" name="inst_apep" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Apellido Materno: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="inst_apem" type="text" name="inst_apem" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Correo: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="inst_correo" type="email" name="inst_correo" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="inst_sex" id="inst_sex" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Telefono: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="inst_telf" type="text" name="inst_telf" required/>
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
    document.getElementById('instructor_form').addEventListener('submit', function (event) {
        // Evitar que el formulario se envíe automáticamente
        event.preventDefault();

        // Obtener los valores de los campos
        var nombre = document.getElementById('inst_nom').value;
        var apellidoPaterno = document.getElementById('inst_apep').value;
        var apellidoMaterno = document.getElementById('inst_apem').value;

        // Convertir la primera letra a mayúscula y el resto a minúscula
        var nombreCapitalizado = nombre.charAt(0).toUpperCase() + nombre.slice(1).toLowerCase();
        var apellidoPaternoCapitalizado = apellidoPaterno.charAt(0).toUpperCase() + apellidoPaterno.slice(1).toLowerCase();
        var apellidoMaternoCapitalizado = apellidoMaterno.charAt(0).toUpperCase() + apellidoMaterno.slice(1).toLowerCase();

        // Asignar los valores capitalizados a los campos
        document.getElementById('inst_nom').value = nombreCapitalizado;
        document.getElementById('inst_apep').value = apellidoPaternoCapitalizado;
        document.getElementById('inst_apem').value = apellidoMaternoCapitalizado;

        // Ahora, puedes enviar el formulario si es necesario
        // document.getElementById('instructor_form').submit();
    });
</script>