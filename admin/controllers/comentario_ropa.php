<?php
	require_once(__DIR__.'/sistema.php');

	class ComentarioRopa extends Sistema 
	{
		public function get($idComentarioRopa = null){
            $this->db();
            if (is_null($idComentarioRopa)) {
                $sql = 'SELECT * FROM comentario_ropa cr LEFT JOIN ropa r ON cr.id_ropa = r.id_ropa LEFT JOIN cliente c ON cr.id_cliente = c.id_cliente LEFT JOIN usuario u ON c.id_usuario = u.id_usuario ';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM comentario_ropa cr LEFT JOIN ropa r ON cr.id_ropa = r.id_ropa LEFT JOIN cliente c ON cr.id_cliente = c.id_cliente LEFT JOIN usuario u ON c.id_usuario = u.id_usuario WHERE id_comentario_ropa = :id_comentario_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_comentario_ropa', $idComentarioRopa, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'INSERT INTO comentario_ropa(comentario_ropa, fecha_comentario, id_ropa, id_cliente) VALUES (:comentario_ropa, :fecha_comentario, :id_ropa, :id_cliente)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':comentario_ropa', $data['comentario_ropa'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $data['fecha_comentario'], PDO::PARAM_STR);
                $st->bindParam(':id_ropa', $data['id_ropa'], PDO::PARAM_INT);
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

        public function delete($idComentarioRopa){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql1 = "DELETE FROM comentario_ropa WHERE id_comentario_ropa = :id_comentario_ropa";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_comentario_ropa', $idComentarioRopa, PDO::PARAM_INT);
                $st1->execute();
                $rc = $st1->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idComentarioRopa, $data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'UPDATE comentario_ropa SET comentario_ropa = :comentario_ropa, fecha_comentario = :fecha_comentario, id_ropa = :id_ropa, id_cliente = :id_cliente WHERE id_comentario_ropa = :id_comentario_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_comentario_ropa', $idComentarioRopa, PDO::PARAM_INT);
                $st->bindParam(':comentario_ropa', $data['comentario_ropa'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $data['fecha_comentario'], PDO::PARAM_STR);
                $st->bindParam(':id_ropa', $data['id_ropa'], PDO::PARAM_INT);
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
                $sql = 'INSERT INTO comentario_ropa(comentario_ropa, fecha_comentario, id_ropa, id_cliente) VALUES (:comentario_ropa, :fecha_comentario, :id_ropa, :id_cliente)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':comentario_ropa', $data['comentario_ropa'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $fecha, PDO::PARAM_STR);
                $st->bindParam(':id_ropa', $data['id_ropa'], PDO::PARAM_INT);
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
	}
	$comentario_ropa = new ComentarioRopa;
?>