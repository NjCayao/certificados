var globalURL = null;

$(document).ready(function(){
    var cert_esp_id = getUrlParameter('cert_esp_id');
    
    if (!cert_esp_id) {
        console.error("No se proporcionó ID de certificado");
        $("#cert_img").attr("src", "");
        $("#cert_descrip").text("Error: No se encontró el certificado");
        return;
    }

    console.log("Cargando certificado ID:", cert_esp_id);

    $.post("../../controller/certificado_especial.php?op=mostrar_certificado_detalle", 
        { cert_esp_id: cert_esp_id }, 
        function (data) {
            console.log("Respuesta:", data);
            
            try {
                data = JSON.parse(data);
                
                // Verificar que tenemos datos válidos
                if (!data || !data.cert_esp_img) {
                    console.error("Datos de certificado incompletos o inválidos");
                    $("#cert_img").attr("src", "");
                    $("#cert_descrip").text("Error: Certificado no disponible");
                    return;
                }
                
                // Mostrar imagen del certificado
                $("#cert_img").attr("src", data.cert_esp_img);
                
                // Mostrar descripción
                $("#cert_descrip").text(data.cert_esp_descrip || "");
                
                console.log("Certificado cargado correctamente");
            } catch (e) {
                console.error("Error al procesar datos:", e);
                $("#cert_img").attr("src", "");
                $("#cert_descrip").text("Error al procesar los datos del certificado");
            }
        }
    ).fail(function(xhr, status, error) {
        console.error("Error en la solicitud:", error);
        $("#cert_img").attr("src", "");
        $("#cert_descrip").text("Error en la comunicación con el servidor");
    });
});

// Descargar como PNG
$(document).on("click","#btnpng", function(){
    let imgSrc = $("#cert_img").attr('src');
    if (!imgSrc) {
        alert("No hay imagen de certificado para descargar");
        return;
    }
    
    let link = document.createElement('a');
    link.download = "Certificado_Especial.png";
    link.href = imgSrc;
    link.click();
});

// Descargar como PDF
$(document).on("click","#btnpdf", function(){
    var imgSrc = $("#cert_img").attr('src');
    if (!imgSrc) {
        alert("No hay imagen de certificado para descargar");
        return;
    }
    
    try {
        // Obtener la imagen como objeto Image para conocer sus dimensiones reales
        var img = new Image();
        img.onload = function() {
            // Crear un nuevo objeto jsPDF con orientación apropiada
            var orientation = (img.width > img.height) ? 'l' : 'p'; // 'l' para landscape, 'p' para portrait
            var pdf = new jsPDF(orientation, 'pt', 'a4');
            
            // Calcular dimensiones para ajustar la imagen a la página
            var pageWidth = orientation === 'l' ? pdf.internal.pageSize.height : pdf.internal.pageSize.width;
            var pageHeight = orientation === 'l' ? pdf.internal.pageSize.width : pdf.internal.pageSize.height;
            
            // Calcular proporciones para que la imagen se ajuste manteniendo su relación de aspecto
            var imgWidth = img.width;
            var imgHeight = img.height;
            var ratio = Math.min(pageWidth / imgWidth, pageHeight / imgHeight);
            
            // Calcular nuevas dimensiones proporcionales
            var newWidth = imgWidth * ratio;
            var newHeight = imgHeight * ratio;
            
            // Centrar la imagen en la página
            var x = (pageWidth - newWidth) / 2;
            var y = (pageHeight - newHeight) / 2;
            
            // Añadir la imagen al PDF
            pdf.addImage(imgSrc, 'PNG', x, y, newWidth, newHeight);
            
            // Guardar el PDF
            pdf.save('Certificado_Especial.pdf');
        };
        img.src = imgSrc;
        
    } catch(e) {
        console.error("Error al generar PDF:", e);
        alert("Error al generar el PDF. Por favor, intente de nuevo. Detalles: " + e.message);
    }
});

// Función para obtener parámetros de la URL
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
    return null;
};