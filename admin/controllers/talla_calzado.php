<?php
	require_once(__DIR__.'/sistema.php');

	class TallaCalzado extends Sistema 
	{
		public function get($idTallaCalzado = null){
            $this->db();
            if (is_null($idTallaCalzado)) {
                $sql = 'SELECT * FROM talla_calzado';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM talla_calzado WHERE id_talla_calzado = :id_talla_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_talla_calzado', $idTallaCalzado, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO talla_calzado(talla_calzado) VALUES (:talla_calzado)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':talla_calzado', $data['talla_calzado'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idTallaCalzado){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM calzado WHERE id_talla_calzado = :id_talla_calzado";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_talla_calzado', $idTallaCalzado, PDO::PARAM_INT);

                $sql2 = "DELETE FROM talla_calzado WHERE id_talla_calzado = :id_talla_calzado";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_talla_calzado', $idTallaCalzado, PDO::PARAM_INT);
                $st->execute();
                $st2->execute();
                $rc = $st2->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idTallaCalzado, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE talla_calzado SET talla_calzado = :talla_calzado WHERE id_talla_calzado = :id_talla_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_talla_calzado', $idTallaCalzado, PDO::PARAM_INT);
                $st->bindParam(':talla_calzado', $data['talla_calzado'], PDO::PARAM_STR);
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
	$talla_calzado = new TallaCalzado;
?>