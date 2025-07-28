// cert_especial.js - Maneja solo certificados especiales

function inicializarCertificadosEspeciales(usu_id) {
    console.log("Inicializando certificados especiales para usuario ID:", usu_id);
    
    // Inicializar DataTable para certificados especiales
    $('#certificados_especiales_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/certificado_especial.php?op=listar_x_usuario",
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
                "className": "title-column",
                "render": function(data, type, row) {
                    return row[1]; // Título
                }
            },
            {
                "targets": 1,
                "className": "date-column",
                "render": function(data, type, row) {
                    return row[2]; // Fecha Inicio
                }
            },
            {
                "targets": 2,
                "className": "date-column",
                "render": function(data, type, row) {
                    return row[3]; // Fecha Fin
                }
            },
            {
                "targets": 3,
                "className": "button-column",
                "render": function(data, type, row) {
                    console.log("Datos certificado especial:", row);
                    return '<button type="button" onclick="certificado_especial(' + row[0] + ')" class="certificate-btn"><i class="fa fa-id-card-o"></i> Ver</button>';
                }
            }
        ]
    });
    
    // Mostrar panel de certificados especiales
    $("#divpanelespecial").show();
    setTimeout(function() {
        $("#divpanelespecial").addClass('visible');
    }, 100);
}

// Función para certificados especiales
function certificado_especial(cert_esp_id) {
    console.log("Abriendo certificado especial con ID:", cert_esp_id);
    try {
        window.open('../CertificadoEspecial/index.php?cert_esp_id=' + cert_esp_id, '_blank');
    } catch (e) {
        console.error("Error al abrir certificado especial:", e);
        alert("Error al abrir el certificado especial. Por favor, inténtelo de nuevo.");
    }
}