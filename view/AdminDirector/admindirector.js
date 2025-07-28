var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("../../controller/director.php?op=mostrar", { id : id }, function (data) {
        data = JSON.parse(data);
        $('#nombre').val(data.nombre);
        $('#apellido_paterno').val(data.apellido_paterno);
        $('#apellido_materno').val(data.apellido_materno);
        $('#cargo').val(data.cargo);        
    });
});


