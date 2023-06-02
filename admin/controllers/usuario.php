<?php
	require_once(__DIR__.'/sistema.php');

	class Usuario extends Sistema 
	{
		public function get($idUsuario = null){
            $this->db();
            if (is_null($idUsuario)) {
                $sql = 'SELECT * FROM usuario';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM usuario WHERE id_usuario = :id_usuario';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();
        
                $emailExists = $this->checkEmailExists($data['correo']);
                if (!$emailExists) {
                    $nombrearchivo = str_replace(" ","_", $data['correo']);
                    $nombrearchivo = substr($nombrearchivo, 0, 10);
                    $sql = 'INSERT INTO usuario(correo, contrasena, imagen) VALUES (:correo, md5(:contrasena), :imagen)';
                    $st = $this->db->prepare($sql);
                    $st->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
                    $st->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
                    $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);
                    $imagen = "images/default-user.png";
                    if ($secargo) {
                        $imagen = $secargo;
                    }
                    $st->bindParam(':imagen', $imagen, PDO::PARAM_STR);
                    $st->execute();
                    $rc = $st->rowCount();
            
                    $this->db->commit();
            
                    return $rc;
                }
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idUsuario){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);

                $sql1 = "DELETE FROM cliente WHERE id_usuario = :id_usuario";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);

                $sql2 = "DELETE FROM empleado WHERE id_usuario = :id_usuario";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);

                $sql3 = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
                $st->execute();
                $st1->execute();
                $st2->execute();
                $st3->execute();
                $rc = $st3->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idUsuario, $data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $nombrearchivo = str_replace(" ","_", $data['correo']);
                $nombrearchivo = substr($nombrearchivo, 0, 10);
                $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);

                if ($secargo) {
                    $sql = 'UPDATE usuario SET correo = :correo, contrasena = md5(:contrasena), imagen = :imagen WHERE id_usuario = :id_usuario';
                } else {
                    $sql = 'UPDATE usuario SET correo = :correo, contrasena = md5(:contrasena) WHERE id_usuario = :id_usuario';
                }
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
                $st->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
                $st->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
                if ($secargo) {
                    $st->bindParam(":imagen", $secargo, PDO::PARAM_STR);
                }
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function getRol($idUsuario){
            $this->db();
            $sql = "SELECT u.id_usuario, u.correo, r.id_rol, r.rol FROM usuario u JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario JOIN rol r ON ur.id_rol = r.id_rol WHERE u.id_usuario = :id_usuario";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function deleteRol($idUsuario, $idRol){
            $this->db();
            $sql = 'delete from usuario_rol where id_usuario = :id_usuario and id_rol = :id_rol';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $st->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function newRol($idUsuario, $data){
            $this->db();
            $sql = 'insert into usuario_rol (id_usuario, id_rol) values (:id_usuario, :id_rol)';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $st->bindParam(':id_rol', $data['id_rol'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function newRegister($data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $imagen = "images/default-user.png";
                $emailExists = $this->checkEmailExists($data['correo']);
                if (!$emailExists) {
                    $nombrearchivo = str_replace(" ","_", $data['correo']);
                    $nombrearchivo = substr($nombrearchivo, 0, 10);
                    $sql = 'INSERT INTO usuario(correo, contrasena, imagen) VALUES (:correo, md5(:contrasena), :imagen)';
                    $st = $this->db->prepare($sql);
                    $st->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
                    $st->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
                    $st->bindParam(':imagen', $imagen, PDO::PARAM_STR);
                    $st->execute();
                    $rc = $st->rowCount();
            
                    $this->db->commit();
            
                    return $rc;
                }
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function asignarRol($idUsuario, $idRol){
            $this->db();
            $sql = 'insert into usuario_rol (id_usuario, id_rol) values (:id_usuario, :id_rol)';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $st->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function checkEmailExists($email) {
            $sql = 'SELECT COUNT(*) FROM usuario WHERE correo = :correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(':correo', $email, PDO::PARAM_STR);
            $st->execute();
            $count = $st->fetchColumn();
            return $count > 0;
        }

        public function getId($data){
            $contrasena = md5($data['contrasena']);
            $sql = 'SELECT id_usuario FROM usuario WHERE correo = :correo AND contrasena = :contrasena';
            $st = $this->db->prepare($sql);
            $st->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $st->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $st->execute();
            $idUsuarioNew = $st->fetchColumn();
            return intval($idUsuarioNew);
        }
        
        public function countUsers() {
            $this->db();
            $sql = 'SELECT COUNT(*) AS total FROM usuario';
            $st = $this->db->prepare($sql);
            $st->execute();
            $count = $st->fetchColumn();
            return $count;
        }
	}
	$usuario = new Usuario;
?>