
var usu_id = $('#usu_idx').val();

function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);
    });

    $("#detalle_form").on("submit",function(e){
        guardaryeditarimg(e);
    });

}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);

    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            let response = JSON.parse(data); // Parsear la respuesta JSON

            if (response.status === "error") {
                // Mostrar alerta con mensaje de error
                alert(response.message); 
            } else if (response.status === "success") {
                // Recargar tabla y cerrar modal
                $('#usuario_data').DataTable().ajax.reload();
                $('#modalmantenimiento').modal('hide');

                // Mostrar alerta de éxito
                alert(response.message); 
            }
        },
        error: function (error) {
            // Mostrar cualquier error inesperado
            alert("Ocurrió un error al procesar la solicitud.");
        }
    });
}


$(document).ready(function(){
    $('#usu_sex').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#rol_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#usuario_data').DataTable({
        "aProcessing": true,
        "aServerSide": true, 
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controller/usuario.php?op=listarAdmin",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
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

});







function editar(usu_id){
    $.post("../../controller/usuario.php?op=mostrar",{usu_id : usu_id}, function (data) {
        console.log(data);
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apep').val(data.usu_apep);
        $('#usu_apem').val(data.usu_apem);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#usu_sex').val(data.usu_sex).trigger('change');
        $('#rol_id').val(data.rol_id).trigger('change');
        $('#usu_telf').val(data.usu_telf);
        $('#usu_dni').val(data.usu_dni);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(usu_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/usuario.php?op=eliminar",{usu_id : usu_id}, function (data) {
                $('#usuario_data').DataTable().ajax.reload();

                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}

function nuevo(){
    $('#usu_id').val('');
    $('#usu_sex').val('').trigger('change');
    $('#rol_id').val('').trigger('change');
    $('#lbltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

// Muestra el modal al hacer clic en el botón de plantilla
$(document).on("click", "#btnplantilla", function () {
    $('#modalplantilla').modal('show');
});

// Procesa el archivo cuando se hace clic en "Subir archivo"
$(document).on("click", "#btnSubirArchivo", function (event) {
    event.preventDefault();  
    
    var fileInput = $('#upload')[0]; 
    var file = fileInput.files[0]; 

    if (file) {
        subirexcel(file); 
    } else {
        alert("Por favor, seleccione un archivo de plantilla.");
    }
});



// Función para procesar el archivo Excel
function subirexcel(file) {
    var reader = new FileReader();

    reader.onload = function(e) {
        var data = e.target.result;
        var workbook = XLSX.read(data, { type: 'binary' });

        workbook.SheetNames.forEach(function(sheetName) {
            var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
            var json_object = JSON.stringify(XL_row_object);
            var UserList = JSON.parse(json_object); // Convertir el JSON

            var usuarios = []; // Array para almacenar todos los usuarios

            // Procesar cada fila de la plantilla y agregar al array de usuarios
            for (var i = 0; i < UserList.length; i++) {
                var columns = Object.values(UserList[i]);

                // Agregar el usuario al array
                usuarios.push({
                    usu_nom: columns[0],  // Nombre
                    usu_apep: columns[1], // Apellido Paterno
                    usu_apem: columns[2], // Apellido Materno
                    usu_correo: columns[3], // Correo
                    usu_pass: columns[4], // Contraseña
                    usu_sex: columns[5],  // Sexo
                    usu_telf: columns[6], // Teléfono
                    rol_id: columns[7],   // Rol
                    usu_dni: columns[8]   // DNI
                });
            }            
            $.post("../../controller/usuario.php?op=guardar_desde_excel", { usuarios: usuarios }, function(data) {
                console.log(data);  
                var response = JSON.parse(data);
            
                if(response.status === 'error') {
                    alert('Los siguientes DNI no fueron registrados:\n' + response.dni_no_registrados.join('\n'));
                } else {
                    alert(response.message);  // Mensaje de éxito
                }
            
                $('#upload').val('');
                $('#usuario_data').DataTable().ajax.reload();
                $('#modalplantilla').modal('hide');
            });
            
        });
    };

    reader.onerror = function(ex) {
        console.log(ex); 
    };

    reader.readAsBinaryString(file);
}



function imagen(usu_id){
    $('#curx_idx').val(usu_id);
    $('#modalfile').modal('show');
}

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

function guardaryeditarimg(e){
    e.preventDefault();
    var formData = new FormData($("#detalle_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=update_imagen_firma",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){ 
            $('#usuario_data').DataTable().ajax.reload();
            Swal.fire({
                title: 'Correcto!',
                text: 'Se Actualizo Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
            $("#modalfile").modal('hide');

        }
    });
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);

init();
