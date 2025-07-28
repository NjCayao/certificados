<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/Instructor.php");
    /*TODO: Inicializando Clase */
    $instructor = new Instructor();

    /*TODO: Opcion de solicitud de controller */ 
    switch($_GET["op"]){
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["inst_id"])){
                $instructor->insert_instructor($_POST["inst_nom"],$_POST["inst_apep"],$_POST["inst_apem"],$_POST["inst_correo"],$_POST["inst_sex"],$_POST["inst_telf"]);
            }else{
                $instructor->update_instructor($_POST["inst_id"],$_POST["inst_nom"],$_POST["inst_apep"],$_POST["inst_apem"],$_POST["inst_correo"],$_POST["inst_sex"],$_POST["inst_telf"]);
            }
            break;

        /*TODO: Creando Json segun el ID */
        case "mostrar":
            $datos = $instructor->get_instructor_id($_POST["inst_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["inst_id"] = $row["inst_id"];
                    $output["inst_nom"] = $row["inst_nom"];
                    $output["inst_apep"] = $row["inst_apep"];
                    $output["inst_apem"] = $row["inst_apem"];
                    $output["inst_correo"] = $row["inst_correo"];
                    $output["inst_sex"] = $row["inst_sex"];
                    $output["inst_telf"] = $row["inst_telf"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $instructor->delete_instructor($_POST["inst_id"]);
            break;

        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$instructor->get_instructor();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["inst_nom"];
                $sub_array[] = $row["inst_apep"];
                $sub_array[] = $row["inst_apem"];
                $sub_array[] = $row["inst_correo"];
                $sub_array[] = $row["inst_telf"];

                $image_path = $row["inst_firma"];                    
                $sub_array[] = '<img src="'.$image_path.'"  style="width: 50px; height: 50px;">';               

                $sub_array[] = '<button type="button" onclick="editar('.$row["inst_id"].');" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                    <i class="fa fa-edit"> Editar</i>
                                </button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["inst_id"].');"  id="'.$row["inst_id"].'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                    <div><i class="fa fa-close"> Eliminar </i></div> 
                                </button>'; 
                $sub_array[] = '<button type="button" onClick="imagen('.$row["inst_id"].');"  id="'.$row["inst_id"].'" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                    <div><i class="fa fa-file"> Firma </i></div> 
                                </button>';               
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
            $datos=$instructor->get_instructor();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['inst_id']."'>".$row['inst_nom']." ".$row['inst_apep']." ".$row['inst_apem']."</option>";
                }
                echo $html;
            }
            break;

            case "update_imagen_firma":
                $instructor->update_imagen_firma($_POST["curx_idx"],$_POST["inst_firma"]);
            break;
    }


?>