<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0  tx-inverse tx-bold"></h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="cursos_form">
                <div class="modal-body">
                    <input type="hidden" name="cur_id" id="cur_id" />
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Categoria: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="cat_id" id="cat_id" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="cur_nom" type="text" name="cur_nom" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Duración del Curso (Hrs): <span class="tx-danger">*</span></label>
                            <input class="form-control " id="cur_descrip" type="number" name="cur_descrip" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Inicio: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="cur_fechini" type="date" name="cur_fechini" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Fin (Emisión del certificado): <span class="tx-danger">*</span></label>
                            <input class="form-control " id="cur_fechfin" type="date" name="cur_fechfin" required />
                        </div>
                    </div>

                    <!-- NUEVO: Control de vencimiento -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">¿El certificado tiene fecha de vencimiento?</label>
                            <select class="form-control" id="tiene_vencimiento" name="tiene_vencimiento">
                                <option value="no">No</option>
                                <option value="si">Sí</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12" id="div_vigencia" style="display:none;">
                        <div class="form-group">
                            <label class="form-control-label">Vigencia del certificado (años): <span class="tx-danger">*</span></label>
                            <select class="form-control" id="vigencia_anos" name="vigencia_anos">
                                <option value="1">1 año</option>
                                <option value="2">2 años</option>
                                <option value="3">3 años</option>
                                <option value="4">4 años</option>
                                <option value="5">5 años</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12" id="div_fecha_vencimiento" style="display:none;">
                        <div class="form-group">
                            <label class="form-control-label">Fecha de Vencimiento (calculada automáticamente):</label>
                            <input class="form-control" id="cur_fecha_vencimiento" name="cur_fecha_vencimiento" type="date" readonly style="background-color: #e9ecef;" />
                        </div>
                    </div>
                    <!-- FIN NUEVO -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Instructor: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="inst_id" id="inst_id" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                            </select>
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
    // Convertir nombre a mayúsculas
    document.getElementById('cursos_form').addEventListener('submit', function() {
        var nombre = document.getElementById('cur_nom').value;
        var nombreEnMayusculas = nombre.toUpperCase();
        document.getElementById('cur_nom').value = nombreEnMayusculas;
    });

    // Función para calcular fecha de vencimiento
    function calcularFechaVencimiento() {
        var fechaFin = $('#cur_fechfin').val();
        var anos = $('#vigencia_anos').val();

        if (fechaFin && $('#tiene_vencimiento').val() == 'si') {
            // Separar la fecha para evitar problemas de zona horaria
            var partes = fechaFin.split('-');
            var anio = parseInt(partes[0]);
            var mes = parseInt(partes[1]) - 1; // Los meses en JS van de 0-11
            var dia = parseInt(partes[2]);

            // Crear fecha usando componentes locales
            var fecha = new Date(anio, mes, dia);

            // Sumar los años
            fecha.setFullYear(fecha.getFullYear() + parseInt(anos));

            // Formatear fecha para input date
            var anioNuevo = fecha.getFullYear();
            var mesNuevo = (fecha.getMonth() + 1).toString().padStart(2, '0');
            var diaNuevo = fecha.getDate().toString().padStart(2, '0');

            var fechaFormateada = anioNuevo + '-' + mesNuevo + '-' + diaNuevo;
            $('#cur_fecha_vencimiento').val(fechaFormateada);
        }
    }

    $(document).ready(function() {
        // Mostrar/ocultar campos de vencimiento
        $('#tiene_vencimiento').change(function() {
            if ($(this).val() == 'si') {
                $('#div_vigencia').show();
                $('#div_fecha_vencimiento').show();
                calcularFechaVencimiento();
            } else {
                $('#div_vigencia').hide();
                $('#div_fecha_vencimiento').hide();
                $('#cur_fecha_vencimiento').val('');
            }
        });

        // Recalcular cuando cambia la fecha fin
        $('#cur_fechfin').change(function() {
            calcularFechaVencimiento();
        });

        // Recalcular cuando cambia los años de vigencia
        $('#vigencia_anos').change(function() {
            calcularFechaVencimiento();
        });
    });
</script>