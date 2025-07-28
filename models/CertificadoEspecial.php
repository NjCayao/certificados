<?php
class CertificadoEspecial extends Conectar
{
    /* Función para insertar certificado especial */
    public function insert_certificado_especial($usu_id, $cert_esp_titulo, $cert_esp_descrip, $cert_esp_fechini, $cert_esp_fechfin)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_certificados_especiales (usu_id, cert_esp_titulo, cert_esp_descrip, cert_esp_fechini, cert_esp_fechfin, fech_crea, est) 
                    VALUES (?,?,?,?,?,now(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $cert_esp_titulo);
        $sql->bindValue(3, $cert_esp_descrip);
        $sql->bindValue(4, $cert_esp_fechini);
        $sql->bindValue(5, $cert_esp_fechfin);
        $sql->execute();

        $sql1 = "select last_insert_id() as 'cert_esp_id'";
        $sql1 = $conectar->prepare($sql1);
        $sql1->execute();
        return $resultado = $sql1->fetch(pdo::FETCH_ASSOC);
    }

    /* Función para actualizar certificado especial */
    public function update_certificado_especial($cert_esp_id, $usu_id, $cert_esp_titulo, $cert_esp_descrip, $cert_esp_fechini, $cert_esp_fechfin)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_certificados_especiales 
                    SET
                        usu_id = ?,
                        cert_esp_titulo = ?,
                        cert_esp_descrip = ?,
                        cert_esp_fechini = ?,
                        cert_esp_fechfin = ?
                    WHERE
                        cert_esp_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $cert_esp_titulo);
        $sql->bindValue(3, $cert_esp_descrip);
        $sql->bindValue(4, $cert_esp_fechini);
        $sql->bindValue(5, $cert_esp_fechfin);
        $sql->bindValue(6, $cert_esp_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Función para actualizar la ruta del QR */
    public function update_qr_certificado($cert_esp_id, $cert_esp_qr)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_certificados_especiales
                    SET cert_esp_qr = ?
                    WHERE cert_esp_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cert_esp_qr);
        $sql->bindValue(2, $cert_esp_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Función para actualizar la imagen del certificado */
    public function update_imagen_certificado($cert_esp_id, $cert_esp_img)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_certificados_especiales
                    SET cert_esp_img = ?
                    WHERE cert_esp_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cert_esp_img);
        $sql->bindValue(2, $cert_esp_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Eliminar certificado (cambiar estado) */
    public function delete_certificado_especial($cert_esp_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_certificados_especiales
                    SET est = 0
                    WHERE cert_esp_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cert_esp_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Obtener certificado por ID */
    public function get_certificado_especial_x_id($cert_esp_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_certificados_especiales WHERE est = 1 AND cert_esp_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cert_esp_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Obtener certificado con datos de usuario por ID */
    public function get_certificado_especial_x_id_detalle($cert_esp_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                        ce.cert_esp_id,
                        ce.cert_esp_titulo,
                        ce.cert_esp_descrip,
                        ce.cert_esp_fechini,
                        ce.cert_esp_fechfin,
                        ce.cert_esp_img,
                        ce.cert_esp_qr,
                        u.usu_id,
                        u.usu_nom,
                        u.usu_apep,
                        u.usu_apem,
                        u.usu_dni,
                        u.usu_foto
                    FROM 
                        tm_certificados_especiales ce
                    INNER JOIN 
                        tm_usuario u ON ce.usu_id = u.usu_id
                    WHERE 
                        ce.est = 1 AND ce.cert_esp_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cert_esp_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Obtener certificados por usuario */
    public function get_certificados_especiales_x_usuario($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_certificados_especiales WHERE est = 1 AND usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Listar todos los certificados especiales */
    public function get_certificado_especial()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                        ce.cert_esp_id,
                        u.usu_nom,
                        u.usu_apep,
                        u.usu_apem,
                        ce.cert_esp_titulo,
                        ce.cert_esp_descrip,
                        ce.cert_esp_fechini,
                        ce.cert_esp_fechfin,
                        ce.cert_esp_img,
                        ce.cert_esp_qr
                    FROM 
                        tm_certificados_especiales ce
                    INNER JOIN 
                        tm_usuario u ON ce.usu_id = u.usu_id
                    WHERE 
                        ce.est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Función para subir imagen de certificado */
    public function upload_certificado()
    {
        if (isset($_FILES["cert_esp_img"])) {
            // Verificar si existe la carpeta, si no, crearla
            $dir = "../public/cert_esp_img";
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $extension = pathinfo($_FILES['cert_esp_img']['name'], PATHINFO_EXTENSION);
            $new_name = rand() . '.' . $extension;
            $destination = $dir . '/' . $new_name;

            // Subir el archivo
            if (move_uploaded_file($_FILES['cert_esp_img']['tmp_name'], $destination)) {
                return "../../public/cert_esp_img/" . $new_name;
            } else {
                // Si falla, devolver mensaje de error
                return false;
            }
        }
        return false;
    }
}
