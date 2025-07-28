<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/Director.php");
    /*TODO: Inicializando Clase */
    $director = new Director();

    /*TODO: Opcion de solicitud de controller */
    switch($_GET["op"]){
        
        case "mostrar":
            $datos = $director->get_director($_POST["id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["id"] = $row["id"];
                    $output["nombre"] = $row["nombre"];
                    $output["apellido_paterno"] = $row["apellido_paterno"];
                    $output["apellido_materno"] = $row["apellido_materno"];
                    $output["cargo"] = $row["cargo"];                    
                }
                echo json_encode($output);
            }
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
                $sub_array[] = '<button type="button" onClick="editar('.$row["inst_id"].');"  id="'.$row["inst_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["inst_id"].');"  id="'.$row["inst_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        
    }
?>