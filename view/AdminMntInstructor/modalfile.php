<div id="modalfile" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0  tx-inverse tx-bold">Seleccione Imagen Firma</h6>                
            </div>
            <div class="modal-header pd-y-20 pd-x-25">            
                <span>IMPORTANTE: subir imagen en formato PNG, de lo contrario no se guardara. 
                    <br> tamaño maximo permito es de 350x150 píxeles
                </span>
            </div>

            <form method="post" id="detalle_form">
                <input type="hidden" name="curx_idx" id="curx_idx"/>

                <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="file" id="inst_firma" name="inst_firma" onchange="mostrarImagenFirma(this)"/>
                    </div>
                        <!-- Vista previa de la imagen -->
                        <img id="vistaPreviaFirma" src="" alt="Vista Previa de la Firma" class="img-fluid">
                        <!-- Vista previa de la imagen actual -->
                        <!-- <img id="vistaPreviaFirmaActual" src="" alt="Vista Previa de la Firma Actual" class="img-fluid"> -->
                </div>
                </div>
                <div class="modal-footer">
                    <button name="action" type="submit" name="action" value="add" class="btn btn-outline-primary tx-11 pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                    <button type="reset" class="btn btn-outline-secondary tx-11  pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Llamada a la función al cargar el formulario de edición
        mostrarVistaPreviaActualAlCargarFormulario("../../public/firma_img/"+inst_id+".png");
    });

    function mostrarVistaPreviaActualAlCargarFormulario(url) {
        $('#vistaPreviaFirmaActual').attr('src', url).show();
    }

    function mostrarImagenFirma(input) {
    var reader = new FileReader();
    var file = input.files[0];

    // Verificar el formato de la imagen
    if (file.type !== 'image/png') {
        alert('Por favor, suba una imagen en formato PNG.');
        return;
    }

    // Verificar el tamaño de la imagen (450x400 píxeles máximos)
    var maxSize = 450 * 400; // Tamaño máximo permitido en píxeles
    if (file.size > maxSize) {
        alert('La imagen es demasiado grande. El tamaño máximo permitido es de 350x150 píxeles.');
        return;
    }

    reader.onload = function (e) {
        // Muestra la vista previa de la imagen
        $('#vistaPreviaFirma').attr('src', e.target.result);

        // También muestra la vista previa de la imagen actual si existe
        if ($('#vistaPreviaFirmaActual').attr('src') !== "") {
            $('#vistaPreviaFirmaActual').show();
        }
    };

    // Lee el archivo seleccionado como un URL de datos
    reader.readAsDataURL(file);
}
</script>
