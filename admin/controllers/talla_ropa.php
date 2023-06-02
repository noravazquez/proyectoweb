<?php
	require_once(__DIR__.'/sistema.php');

	class TallaRopa extends Sistema 
	{
		public function get($idTallaRopa = null){
            $this->db();
            if (is_null($idTallaRopa)) {
                $sql = 'SELECT * FROM talla_ropa';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM talla_ropa WHERE id_talla_ropa = :id_talla_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_talla_ropa', $idTallaRopa, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO talla_ropa(talla_ropa) VALUES (:talla_ropa)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':talla_ropa', $data['talla_ropa'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idTallaRopa){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM ropa WHERE id_talla_ropa = :id_talla_ropa";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_talla_ropa', $idTallaRopa, PDO::PARAM_INT);

                $sql2 = "DELETE FROM talla_ropa WHERE id_talla_ropa = :id_talla_ropa";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_talla_ropa', $idTallaRopa, PDO::PARAM_INT);
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

        public function edit($idTallaRopa, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE talla_ropa SET talla_ropa = :talla_ropa WHERE id_talla_ropa = :id_talla_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_talla_ropa', $idTallaRopa, PDO::PARAM_INT);
                $st->bindParam(':talla_ropa', $data['talla_ropa'], PDO::PARAM_STR);
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
	$talla_ropa = new TallaRopa;
?>