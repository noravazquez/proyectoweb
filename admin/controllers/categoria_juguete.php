<?php
	require_once(__DIR__.'/sistema.php');

	class CategoriaJuguete extends Sistema 
	{
		public function get($idCategoriaJuguete = null){
            $this->db();
            if (is_null($idCategoriaJuguete)) {
                $sql = 'SELECT * FROM categoria_juguete';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM categoria_juguete WHERE id_categoria_juguete = :id_categoria_juguete';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_juguete', $idCategoriaJuguete, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO categoria_juguete(categoria_juguete) VALUES (:categoria_juguete)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':categoria_juguete', $data['categoria_juguete'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idCategoriaJuguete){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM juguete WHERE id_categoria_juguete = :id_categoria_juguete";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_juguete', $idCategoriaJuguete, PDO::PARAM_INT);

                $sql2 = "DELETE FROM categoria_juguete WHERE id_categoria_juguete = :id_categoria_juguete";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_categoria_juguete', $idCategoriaJuguete, PDO::PARAM_INT);
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

        public function edit($idCategoriaJuguete, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE categoria_juguete SET categoria_juguete = :categoria_juguete WHERE id_categoria_juguete = :id_categoria_juguete';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_juguete', $idCategoriaJuguete, PDO::PARAM_INT);
                $st->bindParam(':categoria_juguete', $data['categoria_juguete'], PDO::PARAM_STR);
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
	$categoria_juguete = new CategoriaJuguete;
?>