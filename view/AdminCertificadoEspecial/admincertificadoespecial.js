var usu_id = $('#usu_idx').val();

function init(){
    $("#certificado_form").on("submit", function(e){
        guardaryeditar(e);
    });
    
    $("#detalle_form").on("submit", function(e){
        guardaryeditarimg(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#certificado_form")[0]);
    $.ajax({
        url: "../../controller/certificado_especial.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            console.log("Respuesta guardaryeditar:", data);
            
            try {
                var jsonData = JSON.parse(data);
                
                // Si es un nuevo registro (tiene cert_esp_id en la respuesta)
                if(jsonData.cert_esp_id) {
                    console.log("Nuevo certificado creado con ID:", jsonData.cert_esp_id);
                    
                    // Generar QR después de guardar el certificado
                    $.post("../../controller/certificado_especial.php?op=generar_qr", 
                        {cert_esp_id: jsonData.cert_esp_id}, 
                        function(qrResponse){
                            console.log("Respuesta generación QR:", qrResponse);
                            
                            // Recargar la tabla para mostrar el QR generado
                            $('#certificado_especial_data').DataTable().ajax.reload();
                            
                            // Mostrar mensaje de éxito
                            Swal.fire({
                                title: 'Correcto!',
                                text: 'Se registró correctamente y se generó el código QR',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                            
                            // Cerrar el modal
                            $('#modalmantenimiento').modal('hide');
                        }
                    ).fail(function(error) {
                        console.error("Error al generar QR:", error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error al generar el código QR',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    });
                } else {
                    // Si es una actualización
                    $('#certificado_especial_data').DataTable().ajax.reload();
                    $('#modalmantenimiento').modal('hide');
                    
                    Swal.fire({
                        title: 'Correcto!',
                        text: 'Se actualizó correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });
                }
            } catch(e) {
                console.error("Error al procesar la respuesta:", e);
                alert("Error al procesar la respuesta: " + data);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud:", error);
            alert("Error en la solicitud: " + error);
        }
    });
}

$(document).ready(function(){
    // Inicializar selects
    $('#usu_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });
    
    // Inicializar DataTable
    $('#certificado_especial_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url: "../../controller/certificado_especial.php?op=listar",
            type: "post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
    
    // Cargar lista de usuarios para el select
    $.post("../../controller/usuario.php?op=combo_alumno", function(data){
        $('#usu_id').html(data);
    });
});

function editar(cert_esp_id){
    $.post("../../controller/certificado_especial.php?op=mostrar", {cert_esp_id: cert_esp_id}, function(data){
        data = JSON.parse(data);
        $('#cert_esp_id').val(data.cert_esp_id);
        $('#usu_id').val(data.usu_id).trigger('change');
        $('#cert_esp_titulo').val(data.cert_esp_titulo);
        $('#cert_esp_descrip').val(data.cert_esp_descrip);
        $('#cert_esp_fechini').val(data.cert_esp_fechini);
        $('#cert_esp_fechfin').val(data.cert_esp_fechfin);
    });
    $('#lbltitulo').html('Editar Certificado Especial');
    $('#modalmantenimiento').modal('show');
}

function eliminar(cert_esp_id){
    swal.fire({
        title: "Eliminar!",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Sí",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/certificado_especial.php?op=eliminar", {cert_esp_id: cert_esp_id}, function(data){
                $('#certificado_especial_data').DataTable().ajax.reload();
                
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se eliminó correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });
        }
    });
}

function ver(cert_esp_id){
    window.open('../CertificadoEspecial/index.php?cert_esp_id='+ cert_esp_id, '_blank');
}

// Función para subir el certificado
function subirCertificado(cert_esp_id){
    $('#cert_esp_id_upload').val(cert_esp_id);
    $('#modalfile').modal('show');
}

// Función para generar/ver el QR
function verQR(cert_esp_id){
    console.log("Solicitando QR para certificado ID:", cert_esp_id);
    
    $.post("../../controller/certificado_especial.php?op=mostrar", {cert_esp_id: cert_esp_id}, function(data){
        console.log("Datos del certificado:", data);
        var dataObj = JSON.parse(data);
        
        if(dataObj.cert_esp_qr) {
            console.log("QR existente:", dataObj.cert_esp_qr);
            $('#qr_img').attr('src', dataObj.cert_esp_qr);
            $('#modalqr').modal('show');
        } else {
            console.log("Generando nuevo QR");
            $.post("../../controller/certificado_especial.php?op=generar_qr", 
                {cert_esp_id: cert_esp_id}, 
                function(qrResponse){
                    console.log("Respuesta generar QR:", qrResponse);
                    
                    try {
                        var responseObj = JSON.parse(qrResponse);
                        if(responseObj.status === "success") {
                            $('#qr_img').attr('src', responseObj.qr_path);
                            $('#modalqr').modal('show');
                            
                            // Recargar la tabla para mostrar el QR generado
                            $('#certificado_especial_data').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: responseObj.message || 'Error al generar el código QR',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    } catch(e) {
                        console.error("Error al procesar la respuesta:", e);
                        alert("Error en la respuesta: " + qrResponse);
                    }
                }
            ).fail(function(xhr, status, error) {
                console.error("Error en la solicitud:", error);
                alert("Error en la solicitud: " + error);
            });
        }
    }).fail(function(xhr, status, error) {
        console.error("Error al obtener datos del certificado:", error);
        alert("Error al obtener datos del certificado: " + error);
    });
}

function nuevo(){
    $('#cert_esp_id').val('');
    $('#usu_id').val('').trigger('change');
    $('#lbltitulo').html('Nuevo Certificado Especial');
    $('#certificado_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

function guardaryeditarimg(e){
    e.preventDefault();
    
    // Verificar que haya un archivo seleccionado
    if(!$('#cert_esp_img').val()) {
        Swal.fire({
            title: 'Error!',
            text: 'Debe seleccionar una imagen',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return;
    }
    
    var formData = new FormData($("#detalle_form")[0]);
    $.ajax({
        url: "../../controller/certificado_especial.php?op=update_imagen_certificado",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            try {
                var response = JSON.parse(datos);
                if(response.status === "success") {
                    $('#certificado_especial_data').DataTable().ajax.reload();
                    Swal.fire({
                        title: 'Correcto!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });
                    $("#modalfile").modal('hide');
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            } catch(e) {
                console.error("Error al procesar la respuesta:", e);
                Swal.fire({
                    title: 'Error!',
                    text: 'Ha ocurrido un error al procesar la respuesta',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud:", error);
            Swal.fire({
                title: 'Error!',
                text: 'Ha ocurrido un error en la solicitud',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}

function downloadQR(){
    let url = $('#qr_img').attr('src');
    let link = document.createElement('a');
    link.download = 'QR_Certificado.png';
    link.href = url;
    link.click();
}

init();