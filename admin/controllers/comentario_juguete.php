<?php
	require_once(__DIR__.'/sistema.php');

	class ComentarioJuguete extends Sistema 
	{
		public function get($idComentarioJuguete = null){
            $this->db();
            if (is_null($idComentarioJuguete)) {
                $sql = 'SELECT * FROM comentario_juguete cj LEFT JOIN juguete j ON cj.id_juguete = j.id_juguete LEFT JOIN cliente c ON cj.id_cliente = c.id_cliente LEFT JOIN usuario u ON c.id_usuario = u.id_usuario ';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM comentario_juguete cj LEFT JOIN juguete j ON cj.id_juguete = j.id_juguete LEFT JOIN cliente c ON cj.id_cliente = c.id_cliente LEFT JOIN usuario u ON c.id_usuario = u.id_usuario WHERE id_comentario_juguete = :id_comentario_juguete';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_comentario_juguete', $idComentarioJuguete, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'INSERT INTO comentario_juguete(comentario_juguete, fecha_comentario, id_juguete, id_cliente) VALUES (:comentario_juguete, :fecha_comentario, :id_juguete, :id_cliente)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':comentario_juguete', $data['comentario_juguete'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $data['fecha_comentario'], PDO::PARAM_STR);
                $st->bindParam(':id_juguete', $data['id_juguete'], PDO::PARAM_INT);
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

        public function delete($idComentarioJuguete){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql1 = "DELETE FROM comentario_juguete WHERE id_comentario_juguete = :id_comentario_juguete";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_comentario_juguete', $idComentarioJuguete, PDO::PARAM_INT);
                $st1->execute();
                $rc = $st1->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idComentarioJuguete, $data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'UPDATE comentario_juguete SET comentario_juguete = :comentario_juguete, fecha_comentario = :fecha_comentario, id_juguete = :id_juguete, id_cliente = :id_cliente WHERE id_comentario_juguete = :id_comentario_juguete';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_comentario_juguete', $idComentarioJuguete, PDO::PARAM_INT);
                $st->bindParam(':comentario_juguete', $data['comentario_juguete'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $data['fecha_comentario'], PDO::PARAM_STR);
                $st->bindParam(':id_juguete', $data['id_juguete'], PDO::PARAM_INT);
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
                $sql = 'INSERT INTO comentario_juguete(comentario_juguete, fecha_comentario, id_juguete, id_cliente) VALUES (:comentario_juguete, :fecha_comentario, :id_juguete, :id_cliente)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':comentario_juguete', $data['comentario_juguete'], PDO::PARAM_STR);
                $st->bindParam(':fecha_comentario', $fecha, PDO::PARAM_STR);
                $st->bindParam(':id_juguete', $data['id_juguete'], PDO::PARAM_INT);
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
	$comentario_juguete = new ComentarioJuguete;
?>