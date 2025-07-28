<?php
    class Director extends Conectar{

        public function insert_director($nombre,$apellido_paterno,$apellido_materno,$cargo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_instructor (inst_id, nombre, apellido_paterno, apellido_materno, cargo) VALUES (NULL,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $apellido_paterno);
            $sql->bindValue(3, $apellido_materno);
            $sql->bindValue(4, $cargo);            
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

        public function get_director(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_director";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_director_id($inst_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_director WHERE est = 1 AND inst_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $inst_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>