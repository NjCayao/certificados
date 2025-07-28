<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/Curso.php");
    /*TODO: Inicializando Clase */
    $curso = new Curso();

    /*TODO: Opcion de solicitud de controller */
    switch($_GET["op"]){
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["cur_id"])){
                $curso->insert_curso($_POST["cat_id"],$_POST["cur_nom"],$_POST["cur_descrip"],$_POST["cur_fechini"],$_POST["cur_fechfin"],$_POST["inst_id"]);
            }else{
                $curso->update_curso($_POST["cur_id"],$_POST["cat_id"],$_POST["cur_nom"],$_POST["cur_descrip"],$_POST["cur_fechini"],$_POST["cur_fechfin"],$_POST["inst_id"]);
            }
            break;
        /*TODO: Creando Json segun el ID */
        case "mostrar":
            $datos = $curso->get_curso_id($_POST["cur_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["cur_id"] = $row["cur_id"];
                    $output["cat_id"] = $row["cat_id"];
                    $output["cur_nom"] = $row["cur_nom"];
                    $output["cur_descrip"] = $row["cur_descrip"];
                    $output["cur_fechini"] = $row["cur_fechini"];
                    $output["cur_fechfin"] = $row["cur_fechfin"];
                    $output["inst_id"] = $row["inst_id"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $curso->delete_curso($_POST["cur_id"]);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$curso->get_curso();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array(); 
                $sub_array[] = $row["cur_id"];//agregado
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = '<a href="'.$row["cur_img"].'" target="_blank">'.strtoupper($row["cur_nom"]).'</a>';
                $sub_array[] = $row["cur_fechini"];
                $sub_array[] = $row["cur_fechfin"];
                $sub_array[] = $row["inst_nom"] ." ". $row["inst_apep"] ." ". $row["inst_apem"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["cur_id"].');"  id="'.$row["cur_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cur_id"].');"  id="'.$row["cur_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
                $sub_array[] = '<button type="button" onClick="imagen('.$row["cur_id"].');"  id="'.$row["cur_id"].'" class="btn btn-outline-success btn-icon"><div><i class="fa fa-file"></i></div></button>';                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;


        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "combo":
            $datos=$curso->get_curso();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['cur_id']."'>".$row['cur_nom']."</option>";
                }
                echo $html; 
            }
            break;

            

        case "eliminar_curso_usuario":
            $curso->delete_curso_usuario($_POST["curd_id"]);
            break;
        /*TODO: Insetar detalle de curso usuario */
        case "insert_curso_usuario":
            /*TODO: Array de usuario separado por comas */
            $datos = explode(',', $_POST['usu_id']);
            /*TODO: Registrar tantos usuarios vengan de la vista */
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $idx=$curso->insert_curso_usuario($_POST["cur_id"],$row);
                $sub_array[] = $idx;
                $data[] = $sub_array;
            }

            echo json_encode($data);
            break;

        // case "generar_qr":
        //     require 'phpqrcode/qrlib.php';
            
        //     QRcode::png(conectar::ruta()."view/Certificado/index.php?curd_id=".$_POST["curd_id"],"../public/qr/".$_POST["curd_id"].".png",'L',32,5);
        //     break;

    
        

        case "generar_qr":
        require 'phpqrcode/qrlib.php';

        // Ruta al archivo del logo
        $logo = '../public/logoqr.png';

        // Texto para el código QR
        $texto = conectar::ruta() . "view/Certificado/index.php?curd_id=" . $_POST["curd_id"];

        // Ruta para guardar el código QR
        $ruta_qr = "../public/qr/" . $_POST["curd_id"] . ".png";

        try {
            // Generar el código QR
            QRcode::png($texto, $ruta_qr, 'L', 32, 5);

            // Cargar la imagen del código QR y del logo
            $qr_imagen = imagecreatefrompng($ruta_qr);
            $logo_imagen = imagecreatefrompng($logo);

            // Dimensiones del código QR
            $qr_width = imagesx($qr_imagen);
            $qr_height = imagesy($qr_imagen);

            // Dimensiones del logo (ajustadas para que no sea demasiado grande)
            $logo_width = min($qr_width * 0.2, 180); // Ajusta el tamaño del logo según sea necesario
            $logo_height = $logo_width * imagesy($logo_imagen) / imagesx($logo_imagen);

            // Calcular posición para centrar el logo en el código QR
            $x = ($qr_width / 2) - ($logo_width / 2);
            $y = ($qr_height / 2) - ($logo_height / 2);

            // Superponer el logo en el centro del código QR
            imagecopyresampled($qr_imagen, $logo_imagen, $x, $y, 0, 0, $logo_width, $logo_height, imagesx($logo_imagen), imagesy($logo_imagen));

            // Guardar la imagen con el logo superpuesto
            imagepng($qr_imagen, $ruta_qr);

            // Liberar memoria
            imagedestroy($qr_imagen);
            imagedestroy($logo_imagen);

            // CAMBIO IMPORTANTE: Devolver JSON en lugar de HTML
            echo json_encode([
                "status" => "success",
                "message" => "QR generado correctamente",
                "path" => $ruta_qr
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "status" => "error",
                "message" => "Error al generar QR: " . $e->getMessage()
            ]);
        }
        break;
        






        case "update_imagen_curso":
            $curso->update_imagen_curso($_POST["curx_idx"],$_POST["cur_img"]);
            break;
    }
?>