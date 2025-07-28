var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
var globalURL = window.globalURL; 



/* Inicializamos la imagen */
var image = new Image();
var imageqr = new Image();



// Mueve la declaración de 'fecha' aquí
var fecha;

$(document).ready(function(){
    var curd_id = getUrlParameter('curd_id');

    $.post("../../controller/usuario.php?op=mostrar_curso_detalle", { curd_id : curd_id }, function (data) {
        data = JSON.parse(data);
        console.log(data);

        // Asigna el valor de 'fecha' dentro de la función de callback de $.post()
        fecha = new Date(data.cur_fechfin + 'T00:00:00');
        // Aumenta un día
        fecha.setDate(fecha.getDate() + 1);

        /* Ruta de la Imagen */
        image.src = data.cur_img;
        /* Dimensionamos y seleccionamos imagen */
        image.onload = function() {
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
          
           // Ruta de la Imagen Logo 
             var logoImagen = "../../public/logo.png";
             var imagenLogo = new Image();           

             imagenLogo.src = logoImagen;            
             imagenLogo.onload = function() {
                ctx.drawImage(imagenLogo, 18, 10, 750, 300);
             }


             

            
            ctx.font = 'bold 230px AnotherFont'; 
            ctx.textAlign = "center";
            ctx.textBaseline = 'middle';
            var xTitle = canvas.width / 2;
            ctx.fillText('CERTIFICADO', xTitle, 490);


            
            // Agregar foto del usuario
            var foto_usuarioImagen = "../../public/usuario_fotos/"+data.usu_foto+" ";
            var imagenFoto_usuario = new Image();           

            imagenFoto_usuario.src = foto_usuarioImagen;            
            imagenFoto_usuario.onload = function() {
                ctx.drawImage(imagenFoto_usuario, 3000, 580, 370, 370);
            }

         


            // Agregar la línea "Otorgado a:"
            ctx.font = 'bold 70px arial';
            ctx.textAlign = "center";
            ctx.textBaseline = 'middle';
            var xOtorgado = canvas.width / 2;
            ctx.fillText('Otorgado a:', xOtorgado, 650);



            // Nombre del alumno
            // Establecer el ancho máximo
            var maxWidthname = 2500;            
            var fullName = data.usu_apep + ' ' + data.usu_apem + ' ' + data.usu_nom;

            // Configurar propiedades iniciales del texto
            ctx.font = 'bold 150px Palatino';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            // Posición del texto
            var x = canvas.width / 2;
            var y = 850;

            // Medir el ancho del texto
            var textWidth = ctx.measureText(fullName).width;

            // Ajustar el tamaño de la fuente para que el texto no exceda el ancho máximo
            while (textWidth > maxWidthname) {
                var currentFontSize = parseInt(ctx.font.match(/\d+/)[0], 10); // Obtener el tamaño actual de la fuente
                if (currentFontSize <= 10) break; // Prevenir que el tamaño de la fuente sea demasiado pequeño
                ctx.font = 'bold ' + (currentFontSize - 10) + 'px Palatino'; // Reducir el tamaño de la fuente
                textWidth = ctx.measureText(fullName).width; // Volver a medir el ancho del texto
            }

            // Dibujar el texto
            ctx.fillText(fullName, x, y);

            

            ctx.font = '75px arial';
            ctx.textAlign = "center";
            ctx.textBaseline = 'middle';
            var xAprobado = canvas.width / 2;
            ctx.fillText('En mérito de haber aprobado satisfatoriamente el curso técnico operativo - capacitación', xAprobado, 1150);

            

           



// Nombre del curso y Ancho máximo para el texto del nombre del curso
var maxWidth = 2350;            
var cursoNombre = data.cur_nom;

// Calcula el ancho del texto del nombre del curso
var cursoWidth = ctx.measureText(cursoNombre).width;
ctx.font = 'bold 90px Arial';

if (cursoWidth > maxWidth) {
    // Si el nombre del curso es demasiado ancho, dividirlo en líneas
    var words = cursoNombre.split(' ');
    var lines = [];
    var line = '';

    for (var i = 0; i < words.length; i++) {
        var testLine = line + words[i] + ' ';
        var testWidth = ctx.measureText(testLine).width;

        if (testWidth > maxWidth && i > 0) {
            lines.push(line.trim());
            line = words[i] + ' ';
        } else {
            line = testLine;
        }
    }
    lines.push(line.trim());

    // Dibuja el texto en varias líneas
    var lineHeight = 110; // Espaciado entre líneas
    var totalLinesHeight = lines.length * lineHeight;
    var y = 1350 - totalLinesHeight / 2; // Posición Y centrada            
    for (var j = 0; j < lines.length; j++) {
        ctx.fillText(lines[j], x, y);
        y += lineHeight;
    }
} else {
    // Si el nombre del curso no es demasiado ancho, dibújalo en una sola línea
    ctx.font = 'bold 110px Arial'; // Cambia el tamaño de la fuente
    var y = 1300; // Posición Y centrada
    ctx.fillText(cursoNombre, x, y);
}

            // Formatear las fechas cur_fechini y cur_fechfin al formato deseado
            ctx.font = '75px arial';
            ctx.textAlign = "center";
            ctx.textBaseline = 'middle';
            var xDuracion = canvas.width / 2;
            
            var fechaInicio = new Date(data.cur_fechini + 'T00:00:00-05:00');
            var fechaFin = new Date(data.cur_fechfin + 'T00:00:00-05:00');

            var meses = [
                "enero", "febrero", "marzo", "abril", "mayo", "junio",
                "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
            ];

            var diaInicio = fechaInicio.getDate();
            var mesInicio = meses[fechaInicio.getMonth()];
            var anioInicio = fechaInicio.getFullYear();

            var diaFin = fechaFin.getDate();
            var mesFin = meses[fechaFin.getMonth()];
            var anioFin = fechaFin.getFullYear();            
            var textoFecha = diaInicio + " de " + mesInicio + " hasta el " + diaFin + " de " + mesFin + " del año " + anioFin + ".";            
            ctx.fillText('En el Periodo Programado del ' + textoFecha, xDuracion, 1430);                      
            ctx.fillText('Con una duración de '+ data.cur_descrip+' '+'horas académicas.', xDuracion, 1510);




            ctx.font = '45px Arial';
            ctx.fillText('Lima, ' + formatFecha(fecha) + ' ', 3000, 1680); 
            function formatFecha(fecha) {
                if (!fecha || isNaN(fecha.getTime())) {
                    return ''; // o cualquier otro valor predeterminado
                }
            
                var meses = [
                    "enero", "febrero", "marzo", "abril", "mayo", "junio",
                    "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
                ];
            
                var dia = fecha.getDate();
                var mes = fecha.getMonth() + 1;
                var anio = fecha.getFullYear();
            
                // Asegúrate de que mes tenga dos dígitos
                if (mes < 10) {
                    mes = '0' + mes;
                }
            
                return dia + ' de ' + meses[mes - 1] + ' del ' + anio;
            }

            

                      

             /* Ruta de la Imagen firma y sello Gerente */
             var firma_gerenteImagen = "../../public/img/firma_gerente.png";
             var imagenFirma_gerente = new Image();           
 
             imagenFirma_gerente.src = firma_gerenteImagen;            
             imagenFirma_gerente.onload = function() {
                 ctx.drawImage(imagenFirma_gerente, 600, 1700, 600, 600);
             }

            ctx.font = '60px Arial';
            ctx.fillText('_______________________ ', 900, 2050);
            ctx.fillText('Juan Carlos Infante Chuquimango', 950, 2120);
            ctx.font = '60px Arial';
            ctx.fillText('Coordinador De Escuela Jaidec  E.I.R.L', 900, 2170);



            /* Firma y nombre  instructor */
            var firma_instructorImagen = "../../public/firma_img/"+data.inst_firma+"";
            var imagenFirma_instructor = new Image();           

            imagenFirma_instructor.src = firma_instructorImagen;            
            imagenFirma_instructor.onload = function() {
                ctx.drawImage(imagenFirma_instructor, 1950, 1850, 460, 300);
            }              
             
            ctx.font = '60px Arial';
            ctx.fillText('____________________', 2190, 2050);
            ctx.fillText(data.inst_nom+' '+ data.inst_apep+' '+data.inst_apem, 2200, 2120);
            ctx.font = '60px Arial';
            ctx.fillText('Instructor', 2230, 2170);
            

          
            



            /* Ruta de codigo QR */
            /* Ruta de codigo QR con validación */
            var qrPath = "../../public/qr/"+curd_id+".png";

            // Configurar manejadores ANTES de asignar src
            imageqr.onerror = function() {
                console.log("QR no encontrado, generando...");
                
                // Si no existe, llamar para generar
                $.post("../../controller/curso.php?op=generar_qr", { curd_id: curd_id }, function(response) {
                    console.log("Respuesta generación QR:", response);
                    
                    // Esperar un momento y volver a intentar
                    setTimeout(function() {
                        var imageqr2 = new Image();
                        imageqr2.src = qrPath + "?t=" + new Date().getTime();
                        
                        imageqr2.onload = function() {
                            ctx.drawImage(imageqr2, 2930, 1780, 500, 500);
                            ctx.font = 'bold 50px calibri';
                            ctx.fillText('QR de validación', 3180, 2320);
                        };
                        
                        imageqr2.onerror = function() {
                            ctx.font = 'bold 40px calibri';
                            ctx.fillStyle = 'red';
                            ctx.fillText('QR no disponible', 3180, 2050);
                            ctx.fillStyle = 'black';
                        };
                    }, 1000);
                });
            };

            imageqr.onload = function() {
                ctx.drawImage(imageqr, 2930, 1780, 500, 500);
                ctx.font = 'bold 50px calibri';
                ctx.fillText('QR de validación', 3180, 2320);
            };

            // Ahora sí intentar cargar
            imageqr.src = qrPath;

            // ID del alumno
            var idReal = parseInt(data.curd_id); // Convertir a entero
            var idImpresion = 100000 + idReal;
            ctx.font = 'bold 60px calibri';
            ctx.fillText('ID: ' + idImpresion, 3150, 100);

            //DNI alumno            
            ctx.font = 'bold 70px calibri';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            // Coordenadas para el texto
            var x1 = canvas.width / 2;
            var y1 = 1000;
            // Asegúrate de que usu_dni es una cadena
            var usu_dni = data.usu_dni.toString();
            // Verificar la longitud de usu_dni
            var dniLabel = usu_dni.length > 8 ? 'C.E' : 'DNI';
            // Dibujar el texto en el canvas
            ctx.fillText(dniLabel + ': ' + usu_dni, x1, y1);


            // PAGINA WEB
            ctx.font = "bold 60px calibri";            
            ctx.fillText(globalURL, 550, 2350);

        };

    });

});




$(document).on("click","#btnpng", function(){
    let canvas = document.getElementById('canvas');
    // Generar la imagen PNG con la mejor calidad posible
    let imgData = canvas.toDataURL('image/png', 1.0); 
    let lblpng = document.createElement('a');
    lblpng.download = "Certificado.png";
    lblpng.href = imgData;
    lblpng.click();
});




//PDF ORIGINAL ANCHO TOTAL DE LA HOJA 
$(document).on("click", "#btnpdf", function(){
    var canvas = document.getElementById('canvas');
    var imgData = canvas.toDataURL('image/png', 1.0); 
    var pdf = new jsPDF('l', 'pt', 'a4'); // Crea un PDF en formato A4 horizontal
    var width = pdf.internal.pageSize.width; // Obtiene el ancho del PDF
    var height = pdf.internal.pageSize.height; // Obtiene el alto del PDF
    pdf.addImage(imgData, 'PNG', 0, 0, width, height); // Añade la imagen en el PDF cubriendo toda la página
    pdf.save('Certificado.pdf'); // Guarda el PDF con el nombre "Certificado.pdf"
});



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
};
