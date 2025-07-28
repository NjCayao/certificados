<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/Usuario.php");
/*TODO: Inicializando Clase */
$usuario = new Usuario();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {

    /*TODO: MicroServicio para poder mostrar el listado de cursos de un usuario con certificado */
    case "listar_cursos":
        $datos = $usuario->get_cursos_x_usuario($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];
            // $sub_array[] = $row["inst_nom"]." ".$row["inst_apep"];
            $sub_array[] = '<button type="button" onClick="certificado(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);

        break;

    /*TODO: MicroServicio para poder mostrar el listado de cursos de un usuario con certificado */
    case "listar_cursos_top10":
        $datos = $usuario->get_cursos_x_usuario_top10($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];
            $sub_array[] = $row["inst_nom"] . " " . $row["inst_apep"];
            $sub_array[] = '<button type="button" onClick="certificado(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);

        break;

    case "combo_alumno":
        $datos = $usuario->get_usuario_alumno_combo();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['usu_id'] . "'>" . $row['usu_nom'] . " " . $row['usu_apep'] . " " . $row['usu_apem'] . " (DNI: " . $row['usu_dni'] . ")</option>";
            }
            echo $html;
        }
        break;

    /*TODO: Microservicio para mostar informacion del certificado con el curd_id */
    case "mostrar_curso_detalle":
        $datos = $usuario->get_curso_x_id_detalle($_POST["curd_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["curd_id"] = $row["curd_id"];
                $output["cur_id"] = $row["cur_id"];
                $output["cur_nom"] = $row["cur_nom"];
                $output["cur_descrip"] = $row["cur_descrip"];
                $output["cur_fechini"] = $row["cur_fechini"];
                $output["cur_fechfin"] = $row["cur_fechfin"];
                $output["cur_img"] = $row["cur_img"];
                $output["usu_id"] = $row["usu_id"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_apep"] = $row["usu_apep"];
                $output["usu_apem"] = $row["usu_apem"];
                $output["usu_dni"] = $row["usu_dni"];
                $output["usu_foto"] = $row["usu_foto"];
                $output["inst_id"] = $row["inst_id"];
                $output["inst_nom"] = $row["inst_nom"];
                $output["inst_apep"] = $row["inst_apep"];
                $output["inst_apem"] = $row["inst_apem"];
                $output["inst_firma"] = $row["inst_firma"];
            }

            echo json_encode($output);
        }
        break;

    /*TODO: Total de Cursos por usuario para el dashboard */
    case "total":
        $datos = $usuario->get_total_cursos(); // No se envía $usu_id
        if (is_array($datos) && count($datos) > 0) {
            foreach ($datos as $row) {
                $output["total"] = $row["total"];
            }
            echo json_encode($output);
        }
        break;


    /*TODO: Total de Alumnos por usuario para el dashboard */
    case "totalAlumnos":
        $datos = $usuario->get_total_alumnos(); // Llama a la función correcta
        if (is_array($datos) && count($datos) > 0) {
            foreach ($datos as $row) {
                $output["totalAlumnos"] = $row["total"]; // Usa "total", no "totalAlumnos", ya que es el alias de tu consulta
            }
            echo json_encode($output);
        }
        break;

    case "totalInstructores":
        $datos = $usuario->total_instructores();
        if (is_array($datos) && count($datos) > 0) {
            foreach ($datos as $row) {
                $output["totalInstructores"] = $row["total"];
            }
            echo json_encode($output);
        }
        break;

    case "totalCertificados":
        $datos = $usuario->total_certificados();
        if (is_array($datos) && count($datos) > 0) {
            foreach ($datos as $row) {
                $output["totalCertificados"] = $row["total"];
            }
            echo json_encode($output);
        }
        break;


    /*TODO: Mostrar informacion del usuario en la vista perfil */
    case "mostrar":
        $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["usu_id"] = $row["usu_id"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_apep"] = $row["usu_apep"];
                $output["usu_apem"] = $row["usu_apem"];
                $output["usu_correo"] = $row["usu_correo"];
                $output["usu_sex"] = $row["usu_sex"];
                $output["usu_pass"] = $row["usu_pass"];
                $output["usu_telf"] = $row["usu_telf"];
                $output["rol_id"] = $row["rol_id"];
                $output["usu_dni"] = $row["usu_dni"];
            }
            echo json_encode($output);
        }
        break;

    /*TODO: Mostrar informacion segun DNI del usuario registrado */
    case "consulta_dni":
        $datos = $usuario->get_usuario_x_dni($_POST["usu_dni"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["usu_id"] = $row["usu_id"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_apep"] = $row["usu_apep"];
                $output["usu_apem"] = $row["usu_apem"];
                $output["usu_correo"] = $row["usu_correo"];
                $output["usu_sex"] = $row["usu_sex"];
                $output["usu_pass"] = $row["usu_pass"];
                $output["usu_telf"] = $row["usu_telf"];
                $output["rol_id"] = $row["rol_id"];
                $output["usu_dni"] = $row["usu_dni"];
            }
            echo json_encode($output);
        }
        break;


    /*TODO: Actualizar datos de perfil */
    case "update_perfil":
        $usuario->update_usuario_perfil(
            $_POST["usu_id"],
            $_POST["usu_nom"],
            $_POST["usu_apep"],
            $_POST["usu_apem"],
            $_POST["usu_pass"],
            $_POST["usu_sex"],
            $_POST["usu_telf"]
        );
        break;

    //actualizado 18/11/24

    case "guardaryeditar":
        if (empty($_POST["usu_id"])) {
            // Si no existe un ID, se realiza la inserción
            $resultado = $usuario->verificar_dni2($_POST["usu_dni"]);

            if ($resultado['status'] == 'error') {
                // Si el DNI ya está registrado, se devuelve el error
                echo json_encode(['status' => 'error', 'message' => 'Error de registro, el DNI ' . $_POST["usu_dni"] . ' ya está registrado.']);
            } else {
                // Si el DNI no está registrado, se inserta el nuevo usuario
                echo $usuario->insert_usuario(
                    $_POST["usu_nom"],
                    $_POST["usu_apep"],
                    $_POST["usu_apem"],
                    $_POST["usu_correo"],
                    $_POST["usu_pass"],
                    $_POST["usu_sex"],
                    $_POST["usu_telf"],
                    $_POST["rol_id"],
                    $_POST["usu_dni"]
                );
            }
        } else {
            // Si existe un ID, se actualiza el usuario
            echo $usuario->update_usuario(
                $_POST["usu_id"],
                $_POST["usu_nom"],
                $_POST["usu_apep"],
                $_POST["usu_apem"],
                $_POST["usu_correo"],
                $_POST["usu_pass"],
                $_POST["usu_sex"],
                $_POST["usu_telf"],
                $_POST["rol_id"],
                $_POST["usu_dni"]
            );
        }
        break;










    /*TODO: Eliminar segun ID */
    case "eliminar":
        $usuario->delete_usuario($_POST["usu_id"]);
        break;


    // listar administradores    
    case "listarAdmin":
        $datos = $usuario->get_usuario(); // Obtener todos los usuarios
        $data = array();
        foreach ($datos as $row) {
            if ($row["rol_id"] != 2) { // Solo procesar administradores (rol_id = 2)
                continue;
            }
            $sub_array = array();
            $sub_array[] = $row["usu_id"];
            $sub_array[] = $row["usu_nom"];
            $sub_array[] = $row["usu_apep"];
            $sub_array[] = $row["usu_apem"];
            $sub_array[] = $row["usu_correo"];
            $sub_array[] = $row["usu_dni"];
            $sub_array[] = "Administrador"; // Etiqueta de rol como "Administrador"

            $image_path = $row["usu_foto"];
            $sub_array[] = '<img src="' . $image_path . '" style="width: 50px; height: 50px;">';

            $sub_array[] = '<button type="button" onClick="editar(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                   <div><i class="fa fa-edit"> Editar </i></div>
                               </button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                   <div><i class="fa fa-close"> Eliminar </i></div>
                               </button>';
            $sub_array[] = '<button type="button" onClick="imagen(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                   <div><i class="fa fa-file"> Foto </i></div>
                               </button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;


    // listar alumnos    
    case "listarAlumno":
        $datos = $usuario->get_usuario(); // Obtener todos los usuarios
        $data = array();
        foreach ($datos as $row) {
            if ($row["rol_id"] != 1) { // Solo procesar estudiantes (rol_id = 1)
                continue;
            }
            $sub_array = array();
            $sub_array[] = $row["usu_id"];
            $sub_array[] = $row["usu_nom"];
            $sub_array[] = $row["usu_apep"];
            $sub_array[] = $row["usu_apem"];
            $sub_array[] = $row["usu_correo"];
            $sub_array[] = $row["usu_dni"];
            $sub_array[] = "Alumno"; // Etiqueta de rol como "Administrador"

            $image_path = $row["usu_foto"];
            $sub_array[] = '<img src="' . $image_path . '" style="width: 50px; height: 50px;">';

            $sub_array[] = '<button type="button" onClick="editar(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                   <div><i class="fa fa-edit"> Editar </i></div>
                               </button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                   <div><i class="fa fa-close"> Eliminar </i></div>
                               </button>';
            $sub_array[] = '<button type="button" onClick="imagen(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                   <div><i class="fa fa-file"> Foto </i></div>
                               </button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;






    /*TODO:  Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $usuario->get_usuario();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["usu_id"]; //agregado
            $sub_array[] = $row["usu_nom"];
            $sub_array[] = $row["usu_apep"];
            $sub_array[] = $row["usu_apem"];
            $sub_array[] = $row["usu_correo"];
            $sub_array[] = $row["usu_dni"];


            if ($row["rol_id"] == 1) {
                $sub_array[] = "Alumno";
            } else {
                $sub_array[] = "Administrador";
            }

            $image_path = $row["usu_foto"];
            $sub_array[] = '<img src="' . $image_path . '"  style="width: 50px; height: 50px;">';


            $sub_array[] = '<button type="button" onClick="editar(' . $row["usu_id"] . ');"  id="' . $row["usu_id"] . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                        <div><i class="fa fa-edit"> Editar </i></div>
                                    </button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["usu_id"] . ');"  id="' . $row["usu_id"] . '" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                        <div><i class="fa fa-close"> Eliminar </i></div>
                                    </button>';
            $sub_array[] = '<button type="button" onClick="imagen(' . $row["usu_id"] . ');"  id="' . $row["usu_id"] . '" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                        <div><i class="fa fa-file"> Foto </i></div> 
                                    </button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    /*TODO: Listar todos los usuarios pertenecientes a un curso */
    case "listar_cursos_usuario":
        $datos = $usuario->get_cursos_usuario_x_id($_POST["cur_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["curd_id"]; //agregado           
            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["usu_nom"] . " " . $row["usu_apep"] . " " . $row["usu_apem"];
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];
            $sub_array[] = $row["inst_nom"] . " " . $row["inst_apep"];
            $sub_array[] = '<button type="button" onClick="certificado(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "listar_detalle_usuario":
        $datos = $usuario->get_usuario_modal($_POST["cur_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = "<input type='checkbox' name='detallecheck[]' value='" . $row["usu_id"] . "'>";
            $sub_array[] = $row["usu_nom"]; 
            $sub_array[] = $row["usu_apep"];
            $sub_array[] = $row["usu_apem"];
            $sub_array[] = $row["usu_correo"];
            $sub_array[] = $row["usu_id"]; //agregado 
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;







    case "guardar_desde_excel":
        // Obtener los usuarios desde la solicitud POST (verificar que es un array)
        if (isset($_POST["usuarios"]) && is_array($_POST["usuarios"])) {
            $usuarios = $_POST["usuarios"];
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se han recibido usuarios válidos.']);
            break;
        }

        $dni_no_registrados = [];

        // Instanciar la clase de usuario
        $usuarioObj = new Usuario();

        // Iterar sobre los usuarios (array de datos)
        foreach ($usuarios as $usuario) {
            // Verificar si el DNI ya está registrado
            if (isset($usuario['usu_dni'])) {
                $resultado = $usuarioObj->verificar_dni($usuario['usu_dni']);

                if ($resultado['status'] == 'error') {
                    // Si el DNI ya está registrado, agregarlo al arreglo de no registrados
                    $dni_no_registrados[] = $usuario['usu_dni'];
                } else {
                    // Si el DNI no está registrado, insertar el usuario en la base de datos
                    if (isset($usuario['usu_nom'], $usuario['usu_correo'], $usuario['usu_pass'], $usuario['usu_sex'], $usuario['usu_telf'], $usuario['rol_id'])) {
                        $usuarioObj->insert_usuario_excel(
                            $usuario['usu_nom'],
                            $usuario['usu_correo'],
                            $usuario['usu_pass'],
                            $usuario['usu_sex'],
                            $usuario['usu_telf'],
                            $usuario['rol_id'],
                            $usuario['usu_dni']
                        );
                    } else {
                        // Si falta algún campo importante, agregar el DNI a la lista de no registrados
                        $dni_no_registrados[] = $usuario['usu_dni'];
                    }
                }
            } else {
                // Si no hay DNI, agregar a la lista de no registrados
                $dni_no_registrados[] = 'DNI no proporcionado';
            }
        }

        // Responder con los usuarios que no pudieron ser registrados
        if (count($dni_no_registrados) > 0) {
            echo json_encode([
                'status' => 'error',
                'dni_no_registrados' => $dni_no_registrados,
                'message' => 'Algunos DNI no fueron registrados.'
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Todos los usuarios fueron registrados correctamente.'
            ]);
        }
        break;

        // Responder con los usuarios que no pudieron ser registrados
        if (count($dni_no_registrados) > 0) {
            echo json_encode([
                'status' => 'error',
                'dni_no_registrados' => $dni_no_registrados,
                'message' => 'Algunos DNI no fueron registrados.'
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Todos los usuarios fueron registrados correctamente.'
            ]);
        }
        break;


        // Responder con los usuarios que no pudieron ser registrados
        if (count($dni_no_registrados) > 0) {
            echo json_encode([
                'status' => 'error',
                'dni_no_registrados' => $dni_no_registrados,
                'message' => 'Algunos DNI no fueron registrados.'
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Todos los usuarios fueron registrados correctamente.'
            ]);
        }
        break;



    case "update_imagen_firma":
        $usuario->update_imagen_firma($_POST["curx_idx"], $_POST["usu_foto"]);
        break;
}
