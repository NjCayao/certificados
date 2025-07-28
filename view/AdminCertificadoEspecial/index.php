<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");

// Verificamos que el usuario haya iniciado sesión
if (isset($_SESSION["usu_id"])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once("../html/MainHead.php"); ?>
        <title><?php echo Titulo::titulo(); ?>::Certificados Especiales</title>
    </head>

    <body>
        <!-- Incluimos el menú de navegación -->
        <?php require_once("../html/MainMenu.php"); ?>

        <!-- Incluimos el encabezado principal -->
        <?php require_once("../html/MainHeader.php"); ?>

        <div class="br-mainpanel">
            <!-- Migas de pan / breadcrumb -->
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="#">Certificados Especiales</a>
                </nav>
            </div>

            <!-- Título de la página -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Certificados Especiales</h4>
                <p class="mg-b-0">Gestión de Certificados Especiales</p>
            </div>

            <!-- Contenido principal -->
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Listado de Certificados Especiales</h6>
                    <p class="mg-b-25 mg-lg-b-50">Desde aquí podrá gestionar los certificados especiales.</p>

                    <!-- Botón para agregar nuevo certificado -->
                    <button class="btn btn-outline-primary" id="add_button" onclick="nuevo()">
                        <i class="fa fa-plus-square mg-r-10"></i> Nuevo Certificado Especial
                    </button>

                    <p></p>

                    <!-- Tabla de certificados especiales -->
                    <div class="table-wrapper">
                        <table id="certificado_especial_data" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-5p">ID</th>
                                    <th class="wd-15p">Usuario</th>
                                    <th class="wd-15p">Título</th>
                                    <th class="wd-10p">Fecha Inicio</th>
                                    <th class="wd-10p">Fecha Fin</th>
                                    <th class="wd-10p">Certificado</th>
                                    <th class="wd-10p">QR</th>
                                    <th class="wd-5p">Ver</th>
                                    <th class="wd-5p">Editar</th>
                                    <th class="wd-5p">Subir</th>
                                    <th class="wd-5p">QR</th>
                                    <th class="wd-5p">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos se cargarán dinámicamente con DataTables desde el JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Incluimos los modales necesarios -->
        <?php require_once("modalmantenimiento.php"); ?> <!-- Modal para crear/editar certificados -->
        <?php require_once("modalfile.php"); ?> <!-- Modal para subir archivos de certificado -->
        <?php require_once("modalqr.php"); ?> <!-- Modal para visualizar/descargar QR -->

        <!-- Incluimos los archivos JS necesarios -->
        <?php require_once("../html/MainJs.php"); ?>
        <script type="text/javascript" src="admincertificadoespecial.js"></script>
    </body>

    </html>
<?php
} else {
    /* Si no ha iniciado sesión se redirecciona a la ventana de error 404 */
    header("Location:" . Conectar::ruta() . "view/404/");
}
?>