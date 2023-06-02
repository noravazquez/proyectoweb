<?php
	require_once(__DIR__.'/sistema.php');

	class RespuestaRopa extends Sistema 
	{
		public function get($idRespuestaRopa = null){
            $this->db();
            if (is_null($idRespuestaRopa)) {
                $sql = 'SELECT * FROM respuesta_ropa rr LEFT JOIN comentario_ropa cr ON rr.id_comentario_ropa = cr.id_comentario_ropa LEFT JOIN empleado e ON rr.id_empleado = e.id_empleado LEFT JOIN usuario u ON e.id_usuario = u.id_usuario ';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM respuesta_ropa rr LEFT JOIN comentario_ropa cr ON rr.id_comentario_ropa = cr.id_comentario_ropa LEFT JOIN empleado e ON rr.id_empleado = e.id_empleado LEFT JOIN usuario u ON e.id_usuario = u.id_usuario WHERE id_respuesta_ropa = :id_respuesta_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_respuesta_ropa', $idRespuestaRopa, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'INSERT INTO respuesta_ropa(respuesta_ropa, fecha_respuesta, id_comentario_ropa, id_empleado) VALUES (:respuesta_ropa, :fecha_respuesta, :id_comentario_ropa, :id_empleado)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':respuesta_ropa', $data['respuesta_ropa'], PDO::PARAM_STR);
                $st->bindParam(':fecha_respuesta', $data['fecha_respuesta'], PDO::PARAM_STR);
                $st->bindParam(':id_comentario_ropa', $data['id_comentario_ropa'], PDO::PARAM_INT);
                $st->bindParam(':id_empleado', $data['id_empleado'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idRespuestaRopa){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM respuesta_ropa WHERE id_respuesta_ropa = :id_respuesta_ropa";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_respuesta_ropa', $idRespuestaRopa, PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idRespuestaRopa, $data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'UPDATE respuesta_ropa SET respuesta_ropa = :respuesta_ropa, fecha_respuesta = :fecha_respuesta, id_comentario_ropa = :id_comentario_ropa, id_empleado = :id_empleado WHERE id_respuesta_ropa = :id_respuesta_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_respuesta_ropa', $idRespuestaRopa, PDO::PARAM_INT);
                $st->bindParam(':respuesta_ropa', $data['respuesta_ropa'], PDO::PARAM_STR);
                $st->bindParam(':fecha_respuesta', $data['fecha_respuesta'], PDO::PARAM_STR);
                $st->bindParam(':id_comentario_ropa', $data['id_comentario_ropa'], PDO::PARAM_INT);
                $st->bindParam(':id_empleado', $data['id_empleado'], PDO::PARAM_INT);
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
	$respuesta_ropa = new RespuestaRopa;
?>