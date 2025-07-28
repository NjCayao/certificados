<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/CertificadoEspecial.php");
/*TODO: Inicializando Clase */
$certificado_especial = new CertificadoEspecial();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {
    /*TODO: Guardar y editar cuando se tenga el ID */
    case "guardaryeditar":
        if (empty($_POST["cert_esp_id"])) {
            // Insertar nuevo certificado
            $resultado = $certificado_especial->insert_certificado_especial(
                $_POST["usu_id"],
                $_POST["cert_esp_titulo"],
                $_POST["cert_esp_descrip"],
                $_POST["cert_esp_fechini"],
                $_POST["cert_esp_fechfin"]
            );

            // Devolver el ID del certificado creado
            echo json_encode($resultado);
        } else {
            // Actualizar certificado existente
            $certificado_especial->update_certificado_especial(
                $_POST["cert_esp_id"],
                $_POST["usu_id"],
                $_POST["cert_esp_titulo"],
                $_POST["cert_esp_descrip"],
                $_POST["cert_esp_fechini"],
                $_POST["cert_esp_fechfin"]
            );

            echo json_encode(["status" => "updated"]);
        }
        break;

    /*TODO: Creando Json segun el ID */
    case "mostrar":
        $datos = $certificado_especial->get_certificado_especial_x_id($_POST["cert_esp_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["cert_esp_id"] = $row["cert_esp_id"];
                $output["usu_id"] = $row["usu_id"];
                $output["cert_esp_titulo"] = $row["cert_esp_titulo"];
                $output["cert_esp_descrip"] = $row["cert_esp_descrip"];
                $output["cert_esp_fechini"] = $row["cert_esp_fechini"];
                $output["cert_esp_fechfin"] = $row["cert_esp_fechfin"];
                $output["cert_esp_img"] = $row["cert_esp_img"];
                $output["cert_esp_qr"] = $row["cert_esp_qr"];
            }
            echo json_encode($output);
        }
        break;

    /*TODO: Eliminar segun ID */
    case "eliminar":
        $certificado_especial->delete_certificado_especial($_POST["cert_esp_id"]);
        break;

    /*TODO: Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $certificado_especial->get_certificado_especial();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cert_esp_id"];
            $sub_array[] = $row["usu_nom"] . " " . $row["usu_apep"] . " " . $row["usu_apem"];
            $sub_array[] = $row["cert_esp_titulo"];
            $sub_array[] = date("d/m/Y", strtotime($row["cert_esp_fechini"]));
            $sub_array[] = date("d/m/Y", strtotime($row["cert_esp_fechfin"]));

            // Mostrar imagen del certificado si existe
            if ($row["cert_esp_img"]) {
                $sub_array[] = '<img src="' . $row["cert_esp_img"] . '" style="width: 50px; height: 50px;">';
            } else {
                $sub_array[] = '<span class="badge badge-danger">Sin certificado</span>';
            }

            // Mostrar imagen del QR si existe
            if ($row["cert_esp_qr"]) {
                $sub_array[] = '<img src="' . $row["cert_esp_qr"] . '" style="width: 50px; height: 50px;">';
            } else {
                $sub_array[] = '<span class="badge badge-danger">Sin QR</span>';
            }

            // Botones de acción (en el orden solicitado)

            // 1. Botón Ver (solo si tiene certificado y QR)
            if ($row["cert_esp_img"] && $row["cert_esp_qr"]) {
                $sub_array[] = '<button type="button" onClick="ver(' . $row["cert_esp_id"] . ');" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver certificado" style="cursor: pointer;"><i class="fa fa-eye"></i> Ver</button>';
            } else {
                $sub_array[] = '<button type="button" class="btn btn-secondary btn-sm" disabled title="Certificado no disponible"><i class="fa fa-eye"></i> Ver</button>';
            }

            // 2. Botón Editar
            $sub_array[] = '<button type="button" onClick="editar(' . $row["cert_esp_id"] . ');" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar certificado" style="cursor: pointer;"><i class="fa fa-edit"></i> Editar</button>';

            // 3. Botón Subir Certificado
            $sub_array[] = '<button type="button" onClick="subirCertificado(' . $row["cert_esp_id"] . ');" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Subir certificado" style="cursor: pointer;"><i class="fa fa-upload"></i> Subir</button>';

            // 4. Botón QR (mostrar o generar)
            if ($row["cert_esp_qr"]) {
                $sub_array[] = '<button type="button" onClick="verQR(' . $row["cert_esp_id"] . ');" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver QR" style="cursor: pointer;"><i class="fa fa-qrcode"></i> QR</button>';
            } else {
                $sub_array[] = '<button type="button" onClick="verQR(' . $row["cert_esp_id"] . ');" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Generar QR" style="cursor: pointer;"><i class="fa fa-qrcode"></i> QR</button>';
            }

            // 5. Botón Eliminar
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["cert_esp_id"] . ');" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar certificado" style="cursor: pointer;"><i class="fa fa-trash"></i> Eliminar</button>';

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

    /*TODO: Listar certificados por usuario para página de consulta */
    case "listar_x_usuario":
        $datos = $certificado_especial->get_certificados_especiales_x_usuario($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cert_esp_id"]; // ID oculto para referencias (será usado por JavaScript)
            $sub_array[] = $row["cert_esp_titulo"]; // Título del certificado
            $sub_array[] = date("d/m/Y", strtotime($row["cert_esp_fechini"])); // Fecha de inicio formateada
            $sub_array[] = date("d/m/Y", strtotime($row["cert_esp_fechfin"])); // Fecha de fin formateada
            // El botón de certificado se inserta mediante JavaScript en consulta.js
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

    /*TODO: Mostrar información detallada del certificado */
    case "mostrar_certificado_detalle":
        $datos = $certificado_especial->get_certificado_especial_x_id_detalle($_POST["cert_esp_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["cert_esp_id"] = $row["cert_esp_id"];
                $output["cert_esp_titulo"] = $row["cert_esp_titulo"];
                $output["cert_esp_descrip"] = $row["cert_esp_descrip"];
                $output["cert_esp_fechini"] = $row["cert_esp_fechini"];
                $output["cert_esp_fechfin"] = $row["cert_esp_fechfin"];
                $output["cert_esp_img"] = $row["cert_esp_img"];
                $output["cert_esp_qr"] = $row["cert_esp_qr"];
                $output["usu_id"] = $row["usu_id"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_apep"] = $row["usu_apep"];
                $output["usu_apem"] = $row["usu_apem"];
                $output["usu_dni"] = $row["usu_dni"];
                $output["usu_foto"] = $row["usu_foto"];
            }
            echo json_encode($output);
        } else {
            echo json_encode(array("error" => "No se encontró el certificado"));
        }
        break;

    /*TODO: Generar QR CERTIFICADO ESPECIAL*/
    case "generar_qr":
        try {
            // Incluir la librería phpqrcode
            require_once('phpqrcode/qrlib.php');

            // URL que contendrá el QR
            $url = Conectar::ruta() . "view/CertificadoEspecial/index.php?cert_esp_id=" . $_POST["cert_esp_id"];

            // Verificar si existe la carpeta para guardar los QR, si no, crearla
            $dir = "../public/cert_esp_qr";
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            // Ruta completa para guardar el QR
            $ruta_qr = $dir . "/" . $_POST["cert_esp_id"] . ".png";

            // Generar el QR
            QRcode::png($url, $ruta_qr, 'L', 10, 2);

            // Ruta del logo
            $logo = '../public/logoqr.png';

            // Combinar QR con logo
            if (file_exists($logo)) {
                // Cargar la imagen del código QR y del logo
                $qr_imagen = imagecreatefrompng($ruta_qr);
                $logo_imagen = imagecreatefrompng($logo);

                // Dimensiones del código QR
                $qr_width = imagesx($qr_imagen);
                $qr_height = imagesy($qr_imagen);

                // Redimensionar el logo para que no interfiera con la lectura del QR
                // Tamaño recomendado: 20% del tamaño del QR
                $logo_width_orig = imagesx($logo_imagen);
                $logo_height_orig = imagesy($logo_imagen);
                $logo_width = $qr_width * 0.2;
                $logo_height = $logo_width * ($logo_height_orig / $logo_width_orig);

                // Calcular posición para centrar el logo en el código QR
                $x = ($qr_width - $logo_width) / 2;
                $y = ($qr_height - $logo_height) / 2;

                // Crear una nueva imagen para el logo redimensionado
                $logo_redim = imagecreatetruecolor($logo_width, $logo_height);
                imagealphablending($logo_redim, false);
                imagesavealpha($logo_redim, true);

                // Fondo transparente
                $transparent = imagecolorallocatealpha($logo_redim, 255, 255, 255, 127);
                imagefilledrectangle($logo_redim, 0, 0, $logo_width, $logo_height, $transparent);

                // Redimensionar el logo
                imagecopyresampled($logo_redim, $logo_imagen, 0, 0, 0, 0, $logo_width, $logo_height, $logo_width_orig, $logo_height_orig);

                // Combinar el QR con el logo
                imagecopy($qr_imagen, $logo_redim, $x, $y, 0, 0, $logo_width, $logo_height);

                // Guardar la imagen resultante
                imagepng($qr_imagen, $ruta_qr);

                // Liberar memoria
                imagedestroy($qr_imagen);
                imagedestroy($logo_imagen);
                imagedestroy($logo_redim);
            }

            // Ruta relativa para guardar en la BD
            $ruta_bd = "../../public/cert_esp_qr/" . $_POST["cert_esp_id"] . ".png";

            // Actualizar la ruta del QR en la BD
            $certificado_especial->update_qr_certificado(
                $_POST["cert_esp_id"],
                $ruta_bd
            );

            // Devolver la ruta para mostrarlo en el frontend
            echo json_encode(["status" => "success", "qr_path" => $ruta_bd]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case "update_imagen_certificado":
        // Verificamos que esté configurado cert_esp_id
        if (isset($_POST["cert_esp_id"]) && !empty($_POST["cert_esp_id"])) {
            // Usar la función upload_certificado para subir el archivo
            $cert_esp_img = $certificado_especial->upload_certificado();

            // Si la imagen se subió correctamente
            if ($cert_esp_img !== false) {
                // Actualizar la ruta en la BD
                $certificado_especial->update_imagen_certificado(
                    $_POST["cert_esp_id"],
                    $cert_esp_img
                );
                echo json_encode(["status" => "success", "message" => "Certificado subido correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al subir el certificado"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "ID de certificado no proporcionado"]);
        }
        break;
}
