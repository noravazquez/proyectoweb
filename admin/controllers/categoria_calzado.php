<?php
	require_once(__DIR__.'/sistema.php');

	class CategoriaCalzado extends Sistema 
	{
		public function get($idCategoriaCalzado = null){
            $this->db();
            if (is_null($idCategoriaCalzado)) {
                $sql = 'SELECT * FROM categoria_calzado';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM categoria_calzado WHERE id_categoria_calzado = :id_categoria_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_calzado', $idCategoriaCalzado, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO categoria_calzado(categoria_calzado) VALUES (:categoria_calzado)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':categoria_calzado', $data['categoria_calzado'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idCategoriaCalzado){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM calzado WHERE id_categoria_calzado = :id_categoria_calzado";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_calzado', $idCategoriaCalzado, PDO::PARAM_INT);

                $sql2 = "DELETE FROM categoria_calzado WHERE id_categoria_calzado = :id_categoria_calzado";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_categoria_calzado', $idCategoriaCalzado, PDO::PARAM_INT);
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

        public function edit($idCategoriaCalzado, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE categoria_calzado SET categoria_calzado = :categoria_calzado WHERE id_categoria_calzado = :id_categoria_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_categoria_calzado', $idCategoriaCalzado, PDO::PARAM_INT);
                $st->bindParam(':categoria_calzado', $data['categoria_calzado'], PDO::PARAM_STR);
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
	$categoria_calzado = new CategoriaCalzado;
?>