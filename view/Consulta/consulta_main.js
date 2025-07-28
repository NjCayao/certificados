// consulta_main.js - Maneja la búsqueda y coordina los otros scripts

function init() {
    // Inicializaciones si son necesarias
}

$(document).ready(function() {
    // Ocultar los paneles de resultados inicialmente
    $("#divpanel").hide();
    $("#divpanelespecial").hide();
    
    // Ocultar loader inicialmente
    $("#loader").hide();
    
    // Permitir búsqueda al presionar Enter en el campo de DNI
    $("#usu_dni").keypress(function(e) {
        if (e.which === 13) {
            $("#btnconsultar").click();
        }
    });
});

$(document).on("click", "#btnconsultar", function() {
    console.log("Botón de consulta presionado");
    var usu_dni = $("#usu_dni").val();
    
    if (usu_dni.length == 0) {
        Swal.fire({
            title: 'Error!',
            text: 'DNI Vacío',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return;
    }
    
    // Mostrar loader
    $("#loader").show();
    
    // Ocultar paneles si estaban visibles
    $("#divpanel").removeClass('visible').hide();
    $("#divpanelespecial").removeClass('visible').hide();
    
    // Consultar usuario por DNI
    $.post("../../controller/usuario.php?op=consulta_dni", {
        usu_dni: usu_dni
    }, function(data) {
        console.log("Respuesta de consulta_dni:", data);
        
        // Ocultar loader
        $("#loader").hide();
        
        // Verificar que tenemos datos
        if (data.length > 0) {
            try {
                data = JSON.parse(data);
                console.log("Datos del usuario:", data);
                
                // Nombre completo para mostrar
                var nombreCompleto = data.usu_apep + " " + data.usu_apem + " " + data.usu_nom;
                
                // Inicializar certificados normales (desde cert_normal.js)
                inicializarCertificadosNormales(data.usu_id, nombreCompleto);
                
                // Inicializar certificados especiales (desde cert_especial.js)
                inicializarCertificadosEspeciales(data.usu_id);
                
            } catch (e) {
                console.error("Error al procesar datos:", e);
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al procesar los datos recibidos',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'No Existe Usuario',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    }).fail(function(xhr, status, error) {
        // Ocultar loader en caso de error
        $("#loader").hide();
        
        console.error("Error en la solicitud:", error);
        Swal.fire({
            title: 'Error!',
            text: 'Hubo un problema al procesar la solicitud: ' + error,
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    });
});

// Iniciar el script
init();