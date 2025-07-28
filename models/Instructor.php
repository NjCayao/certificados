<?php
    class Instructor extends Conectar{

        public function insert_instructor($inst_nom,$inst_apep,$inst_apem,$inst_correo,$inst_sex,$inst_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_instructor (inst_id, inst_nom, inst_apep, inst_apem, inst_correo, inst_sex, inst_telf, fech_crea, est) VALUES (NULL,?,?,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $inst_nom);
            $sql->bindValue(2, $inst_apep);
            $sql->bindValue(3, $inst_apem);
            $sql->bindValue(4, $inst_correo);
            $sql->bindValue(5, $inst_sex);
            $sql->bindValue(6, $inst_telf);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        

        public function update_instructor($inst_id,$inst_nom,$inst_apep,$inst_apem,$inst_correo,$inst_sex,$inst_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_instructor
                SET
                    inst_nom = ?,
                    inst_apep = ?,
                    inst_apem = ?, 
                    inst_correo = ?,
                    inst_sex = ?,
                    inst_telf = ?
                WHERE
                    inst_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $inst_nom);
            $sql->bindValue(2, $inst_apep);
            $sql->bindValue(3, $inst_apem);
            $sql->bindValue(4, $inst_correo);
            $sql->bindValue(5, $inst_sex);
            $sql->bindValue(6, $inst_telf);
            $sql->bindValue(7, $inst_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        
        

        public function delete_instructor($inst_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_instructor
                SET
                    est = 0
                WHERE
                    inst_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $inst_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_instructor(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_instructor WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_instructor_id($inst_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_instructor WHERE est = 1 AND inst_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $inst_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function update_imagen_firma($inst_id,$inst_firma){
            $conectar= parent::conexion();
            parent::set_names();

            require_once("Instructor.php");
            $curx = new Instructor();
            $inst_firma = '';
            if ($_FILES["inst_firma"]["name"]!=''){
                $inst_firma = $curx->upload_file();
            }

            $sql="UPDATE tm_instructor
                SET
                    inst_firma = ?
                WHERE
                    inst_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $inst_firma);
            $sql->bindValue(2, $inst_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function upload_file(){
            if(isset($_FILES["inst_firma"])){
                $allowed_formats = array('png');
                $max_width = 450;
                $max_height = 400;
        
                $extension = pathinfo($_FILES['inst_firma']['name'], PATHINFO_EXTENSION);
                
                // Validar formato
                if (!in_array(strtolower($extension), $allowed_formats)) {
                    // Formato no permitido
                    return "Formato de imagen no permitido. Se permite solo PNG.";
                }
        
                // Obtener dimensiones de la imagen
                list($width, $height) = getimagesize($_FILES['inst_firma']['tmp_name']);
        
                // Validar tamaño
                if ($width > $max_width || $height > $max_height) {
                    // Tamaño excede el límite
                    return "La imagen excede el tamaño máximo permitido (450x400 px).";
                }
        
                // Generar nuevo nombre y destino para la imagen
                $new_name = rand() . '.' . $extension;
                $destination = '../public/firma_img/' . $new_name;
        
                // Mover la imagen
                move_uploaded_file($_FILES['inst_firma']['tmp_name'], $destination);
        
                // Devolver la ruta completa de la imagen para almacenar en la base de datos
                return "../../public/firma_img/".$new_name;
            }
        }
    }
?>