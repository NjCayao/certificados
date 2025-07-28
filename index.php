<?php
  /*TODO: Llamando Cadena de Conexion */
  require_once("config/conexion.php");
  include_once 'config/ConfigGlobal.php';
   
    

  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("models/Usuario.php");
    /*TODO: Inicializando Clase */
    $usuario = new Usuario();
    $usuario->login();
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">    
    <meta name="author" content="DevCayao">
    <link href="public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="public/lib/Ionicons/css/ionicons.css" rel="stylesheet">    
    <link href="public/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="public/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="public/lib/highlightjs/github.css" rel="stylesheet">
    <link href="public/lib/chartist/chartist.css" rel="stylesheet">    

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="public/css/bracket.css">
    

    <title><?php echo Titulo::titulo(); ?>::Acceso</title>
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
      <form action="" method="post">
        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
          <!-- Capturando mensaje de error -->
          <?php
            if (isset($_GET["m"])){
              switch($_GET["m"]){
                case "1";
                  ?>
                    <div class="alert alert-warning" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong class="d-block d-sm-inline-block-force">Error!</strong> Datos Incorrectos
                    </div>
                  <?php
                break;

                case "2";
                  ?>
                    <div class="alert alert-warning" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong class="d-block d-sm-inline-block-force">Error!</strong> Campos vacios
                    </div>
                  <?php
                break;
              }
            }
          ?>

          <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">
            <!-- <span class="tx-normal">[</span> BIMDEC <span class="tx-normal">]</span> -->
            <img src="public/logo.png" alt="BIMDEC Logo" style=" width: 150px">
          </div><br>

          

          <div class="tx-center mg-b-30">Certificados y Diplomas</div>

          <div class="form-group">
              <input type="text" id="usu_correo" name="usu_correo" class="form-control" placeholder="Ingrese Correo Electronico">
          </div>
          <div class="form-group">
              <input type="password" id="usu_pass" name="usu_pass" class="form-control" placeholder="Ingrese Contraseña">
          </div>
          <input type="hidden" name="enviar" class="form-control" value="si">
          <button type="submit" class="btn btn-info btn-block">Acceder</button>
        </div>
      </form>
    </div>

    <script src="public/lib/jquery/jquery.js"></script>
    <script src="public/lib/popper.js/popper.js"></script>
    <script src="public/lib/bootstrap/bootstrap.js"></script>


  </body>
</html>
