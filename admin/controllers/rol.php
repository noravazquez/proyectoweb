<?php
    require_once(__DIR__.'/sistema.php');

    class Rol extends Sistema{
        public function get($idRol = null){
            $this->db();
            if (is_null($idRol)) {
                $sql = 'SELECT * FROM rol';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM rol WHERE id_rol = :id_rol';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO rol(rol) VALUES (:rol)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idRol){
            $this->db();

            try {
                $this->db->beginTransaction();
                $sql = "DELETE FROM rol_privilegio WHERE id_rol = :id_rol";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_rol', $idRol, PDO::PARAM_INT);

                $sql1 = "DELETE FROM usuario_rol WHERE id_rol = :id_rol";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_rol', $idRol, PDO::PARAM_INT);

                $sql2 = "DELETE FROM rol WHERE id_rol = :id_rol";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
                $st->execute();
                $st1->execute();
                $st2->execute();
                $rc = $st2->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idRol, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE rol SET rol = :rol WHERE id_rol = :id_rol';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
                $st->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function getPrivilegio($idRol){
            $this->db();
            $sql = 'SELECT r.id_rol, r.rol, p.id_privilegio, p.privilegio FROM rol r JOIN rol_privilegio rp ON r.id_rol = rp.id_rol JOIN privilegio p ON rp.id_privilegio = p.id_privilegio WHERE r.id_rol = :id_rol';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    
        public function deletePrivilegio($idRol, $idPrivilegio){
            $this->db();
            $sql = 'DELETE FROM rol_privilegio WHERE id_rol = :id_rol AND id_privilegio = :id_privilegio';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $st->bindParam(':id_privilegio', $idPrivilegio, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
    
        public function newPrivilegio($idRol, $data){
            $this->db();
            $sql = 'INSERT INTO rol_privilegio (id_rol, id_privilegio) VALUES (:id_rol, :id_privilegio)';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $st->bindParam(':id_privilegio', $data['id_privilegio'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
    }

    $rol = new Rol;
?>