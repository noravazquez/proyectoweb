<?php
	require_once(__DIR__.'/sistema.php');

	class CategoriaRopa extends Sistema 
	{
		public function get($idCategoriaRopa = null){
            $this->db();
            if (is_null($idCategoriaRopa)) {
                $sql = 'SELECT * FROM categoria_ropa';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM categoria_ropa WHERE id_categoria_ropa = :id_categoria_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_ropa', $idCategoriaRopa, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO categoria_ropa(categoria_ropa) VALUES (:categoria_ropa)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':categoria_ropa', $data['categoria_ropa'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idCategoriaRopa){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM ropa WHERE id_categoria_ropa = :id_categoria_ropa";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_ropa', $idCategoriaRopa, PDO::PARAM_INT);

                $sql2 = "DELETE FROM categoria_ropa WHERE id_categoria_ropa = :id_categoria_ropa";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_categoria_ropa', $idCategoriaRopa, PDO::PARAM_INT);
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

        public function edit($idCategoriaRopa, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE categoria_ropa SET categoria_ropa = :categoria_ropa WHERE id_categoria_ropa = :id_categoria_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_ropa', $idCategoriaRopa, PDO::PARAM_INT);
                $st->bindParam(':categoria_ropa', $data['categoria_ropa'], PDO::PARAM_STR);
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
	$categoria_ropa = new CategoriaRopa;
?>