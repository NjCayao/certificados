<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0  tx-inverse tx-bold"></h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="usuario_form">
                <div class="modal-body">
                    <input type="hidden" name="usu_id" id="usu_id"/>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="usu_nom" type="text" name="usu_nom" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Apellido Paterno: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="usu_apep" type="text" name="usu_apep" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Apellido Materno: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="usu_apem" type="text" name="usu_apem" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Correo: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="usu_correo" type="email" name="usu_correo" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="usu_pass" type="text" name="usu_pass" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="usu_sex" id="usu_sex" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Telefono: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_telf" type="text" name="usu_telf" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Rol: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="rol_id" id="rol_id" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                                <!-- <option value="1">Estudiante</option> -->
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">DNI: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_dni" type="text" name="usu_dni" required/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="add" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                    <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>





<script>

    document.getElementById('usuario_form').addEventListener('submit', function (event) {
        // Evitar que el formulario se envíe antes de ejecutar el script
        event.preventDefault();

        // Obtener los valores de los campos
        var nombreCompleto = document.getElementById('usu_nom').value;
        var apellidoPaterno = document.getElementById('usu_apep').value;
        var apellidoMaterno = document.getElementById('usu_apem').value;

        // Dividir el nombre completo en palabras
        var palabras = nombreCompleto.split(" ");

        // Capitalizar la primera letra de cada palabra del nombre
        var nombreCapitalizado = palabras.map(function(palabra) {
            return palabra.charAt(0).toUpperCase() + palabra.slice(1).toLowerCase();
        }).join(" ");

        // Capitalizar la primera letra de los apellidos
        var apellidoPaternoCapitalizado = apellidoPaterno.charAt(0).toUpperCase() + apellidoPaterno.slice(1).toLowerCase();
        var apellidoMaternoCapitalizado = apellidoMaterno.charAt(0).toUpperCase() + apellidoMaterno.slice(1).toLowerCase();

        // Asignar los valores capitalizados a los campos
        document.getElementById('usu_nom').value = nombreCapitalizado;
        document.getElementById('usu_apep').value = apellidoPaternoCapitalizado;
        document.getElementById('usu_apem').value = apellidoMaternoCapitalizado;

        // Envía el formulario después de procesarlo
        this.submit();
    });

</script>
