<?php
	require_once(__DIR__.'/sistema.php');

	class ComentarioCalzado extends Sistema 
	{
		public function get($idComentarioCalzado = null){
            $this->db();
            if (is_null($idComentarioCalzado)) {
                $sql = 'SELECT * FROM comentario_calzado cc LEFT JOIN calzado ca ON cc.id_calzado = ca.id_calzado LEFT JOIN cliente c ON cc.id_cliente = c.id_cliente LEFT JOIN usuario u ON c.id_usuario = u.id_usuario ';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM comentario_calzado cc LEFT JOIN calzado ca ON cc.id_calzado = ca.id_calzado LEFT JOIN cliente c ON cc.id_cliente = c.id_cliente LEFT JOIN usuario u ON c.id_usuario = u.id_usuario WHERE id_comentario_calzado = :id_comentario_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_comentario_calzado', $idComentarioCalzado, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'INSERT INTO comentario_calzado(comentario_calzado, fecha_comentario, id_calzado, id_cliente) VALUES (:comentario_calzado, :fecha_comentario, :id_calzado, :id_cliente)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':comentario_calzado', $data['comentario_calzado'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $data['fecha_comentario'], PDO::PARAM_STR);
                $st->bindParam(':id_calzado', $data['id_calzado'], PDO::PARAM_INT);
                $st->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idComentarioCalzado){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql1 = "DELETE FROM comentario_calzado WHERE id_comentario_calzado = :id_comentario_calzado";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_comentario_calzado', $idComentarioCalzado, PDO::PARAM_INT);
                $st1->execute();
                $rc = $st1->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idComentarioCalzado, $data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'UPDATE comentario_calzado SET comentario_calzado = :comentario_calzado, fecha_comentario = :fecha_comentario, id_calzado = :id_calzado, id_cliente = :id_cliente WHERE id_comentario_calzado = :id_comentario_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_comentario_calzado', $idComentarioCalzado, PDO::PARAM_INT);
                $st->bindParam(':comentario_calzado', $data['comentario_calzado'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $data['fecha_comentario'], PDO::PARAM_STR);
                $st->bindParam(':id_calzado', $data['id_calzado'], PDO::PARAM_INT);
                $st->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function newComentario($data, $idCliente){
            $this->db();
            date_default_timezone_set('America/Mexico_City');
            $fecha = date('Y-m-d');
            try {
                $this->db->beginTransaction();
                $sql = 'INSERT INTO comentario_calzado(comentario_calzado, fecha_comentario, id_calzado, id_cliente) VALUES (:comentario_calzado, :fecha_comentario, :id_calzado, :id_cliente)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':comentario_calzado', $data['comentario_calzado'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $fecha, PDO::PARAM_STR);
                $st->bindParam(':id_calzado', $data['id_calzado'], PDO::PARAM_INT);
                $st->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function getComentarioCliente(){
            $this->db();
            $sql = 'SELECT * FROM comentario_calzado cc LEFT JOIN calzado ca ON cc.id_calzado = ca.id_calzado LEFT JOIN cliente c ON cc.id_cliente = c.id_cliente LEFT JOIN usuario u ON c.id_usuario = u.id_usuario WHERE cc.id_cliente = :id_cliente';
            $st = $this->db->prepare($sql);
            $st->bindParam();
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }
	}
	$comentario_calzado = new ComentarioCalzado;
?>