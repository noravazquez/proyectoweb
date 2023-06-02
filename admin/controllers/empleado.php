<?php
	require_once(__DIR__.'/sistema.php');

	class Empleado extends Sistema 
	{
		public function get($idEmpleado = null){
            $this->db();
            if (is_null($idEmpleado)) {
                $sql = 'SELECT * FROM empleado e LEFT JOIN usuario u ON e.id_usuario = u.id_usuario';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM empleado e LEFT JOIN usuario u ON e.id_usuario = u.id_usuario WHERE id_empleado = :id_empleado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'INSERT INTO empleado(nombre, apellido_paterno, apellido_materno, RFC, CURP, direccion, telefono, fecha_nacimiento, id_usuario) VALUES (:nombre, :apellido_paterno, :apellido_materno, :RFC, :CURP, :direccion, :telefono, :fecha_nacimiento, :id_usuario)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                $st->bindParam(':apellido_paterno', $data['apellido_paterno'], PDO::PARAM_STR);
                $st->bindParam(':apellido_materno', $data['apellido_materno'], PDO::PARAM_STR);
                $st->bindParam(':RFC', $data['RFC'], PDO::PARAM_STR);
                $st->bindParam(':CURP', $data['CURP'], PDO::PARAM_STR);
                $st->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
                $st->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
                $st->bindParam(':fecha_nacimiento', $data['fecha_nacimiento'], PDO::PARAM_STR);
                $st->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idEmpleado){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql3 = "DELETE FROM empleado WHERE id_empleado = :id_empleado";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_INT);
                $st3->execute();
                $rc = $st3->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idEmpleado, $data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'UPDATE empleado SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, RFC = :RFC, CURP = :CURP, direccion = :direccion, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento, id_usuario = :id_usuario WHERE id_empleado = :id_empleado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_INT);
                $st->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                $st->bindParam(':apellido_paterno', $data['apellido_paterno'], PDO::PARAM_STR);
                $st->bindParam(':apellido_materno', $data['apellido_materno'], PDO::PARAM_STR);
                $st->bindParam(':RFC', $data['RFC'], PDO::PARAM_STR);
                $st->bindParam(':CURP', $data['CURP'], PDO::PARAM_STR);
                $st->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
                $st->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
                $st->bindParam(':fecha_nacimiento', $data['fecha_nacimiento'], PDO::PARAM_STR);
                $st->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }
	}
	$empleado = new Empleado;
?>