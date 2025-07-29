// cert_normal.js - Maneja solo certificados normales

function inicializarCertificadosNormales(usu_id, nombreCompleto) {
    console.log("Inicializando certificados normales para usuario ID:", usu_id);
    
    // Mostrar nombre del usuario
    $("#lbldatos").html("Listado de Cursos : " + nombreCompleto);
    
    // Inicializar DataTable para certificados normales
    $('#cursos_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/usuario.php?op=listar_cursos",
            type: "post",
            data: {
                usu_id: usu_id
            },
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "columnDefs": [
            {
                "targets": 0,
                "className": "title-column"
            },
            {
                "targets": 1,
                "className": "date-column"
            },
            {
                "targets": 2,
                "className": "date-column"
            },
            {
                "targets": 3,
                "className": "status-column"
            },
            {
                "targets": 4,
                "className": "button-column"
            }
        ]
    });
    
    // Mostrar panel de certificados normales
    $("#divpanel").show();
    setTimeout(function() {
        $("#divpanel").addClass('visible');
    }, 100);
}

// Función para certificados normales
function certificado(curd_id) {
    console.log("Abriendo certificado normal con ID:", curd_id);
    try {
        window.open('../Certificado/index.php?curd_id=' + curd_id, '_blank');
    } catch (e) {
        console.error("Error al abrir certificado normal:", e);
        alert("Error al abrir el certificado. Por favor, inténtelo de nuevo.");
    }
}