<?php
	require_once(__DIR__.'/sistema.php');

	class Cliente extends Sistema 
	{
		public function get($idCliente = null){
            $this->db();
            if (is_null($idCliente)) {
                $sql = 'SELECT * FROM cliente c LEFT JOIN usuario u ON c.id_usuario = u.id_usuario';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM cliente c LEFT JOIN usuario u ON c.id_usuario = u.id_usuario WHERE id_cliente = :id_cliente';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'INSERT INTO cliente(nombre, apellido_paterno, apellido_materno, RFC, direccion, telefono, fecha_nacimiento, id_usuario) VALUES (:nombre, :apellido_paterno, :apellido_materno, :RFC, :direccion, :telefono, :fecha_nacimiento, :id_usuario)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                $st->bindParam(':apellido_paterno', $data['apellido_paterno'], PDO::PARAM_STR);
                $st->bindParam(':apellido_materno', $data['apellido_materno'], PDO::PARAM_STR);
                $st->bindParam(':RFC', $data['RFC'], PDO::PARAM_STR);
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

        public function delete($idCliente){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM comentario_juguete WHERE id_cliente = :id_cliente";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);

                $sql1 = "DELETE FROM comentario_ropa WHERE id_cliente = :id_cliente";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);

                $sql2 = "DELETE FROM comentario_calzado WHERE id_cliente = :id_cliente";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);

                $sql3 = "DELETE FROM pedido WHERE id_cliente = :id_cliente";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);

                $sql4 = "DELETE FROM cliente WHERE id_cliente = :id_cliente";
                $st4 = $this->db->prepare($sql4);
                $st4->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
                $st->execute();
                $st1->execute();
                $st2->execute();
                $st3->execute();
                $st4->execute();
                $rc = $st4->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idCliente, $data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'UPDATE cliente SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, RFC = :RFC, direccion = :direccion, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento, id_usuario = :id_usuario WHERE id_cliente = :id_cliente';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
                $st->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                $st->bindParam(':apellido_paterno', $data['apellido_paterno'], PDO::PARAM_STR);
                $st->bindParam(':apellido_materno', $data['apellido_materno'], PDO::PARAM_STR);
                $st->bindParam(':RFC', $data['RFC'], PDO::PARAM_STR);
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

        public function newRegister($data, $idUsuario){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'INSERT INTO cliente(nombre, apellido_paterno, apellido_materno, direccion, telefono, fecha_nacimiento, id_usuario) VALUES (:nombre, :apellido_paterno, :apellido_materno, :direccion, :telefono, :fecha_nacimiento, :id_usuario)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                $st->bindParam(':apellido_paterno', $data['apellido_paterno'], PDO::PARAM_STR);
                $st->bindParam(':apellido_materno', $data['apellido_materno'], PDO::PARAM_STR);
                $st->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
                $st->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
                $st->bindParam(':fecha_nacimiento', $data['fecha_nacimiento'], PDO::PARAM_STR);
                $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function getIdCliente($idUsuario){
            $this->db();
            $sql = 'SELECT id_cliente FROM cliente c INNER JOIN usuario u ON c.id_usuario = u.id_usuario WHERE c.id_usuario = :id_usuario';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $st->execute();
            $idCliente = $st->fetchColumn();
            return $idCliente;
        }
	}
	$cliente = new Cliente;
?>