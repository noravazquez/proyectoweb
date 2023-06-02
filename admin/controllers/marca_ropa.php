<?php
	require_once(__DIR__.'/sistema.php');

	class MarcaRopa extends Sistema 
	{
		public function get($idMarcaRopa = null){
            $this->db();
            if (is_null($idMarcaRopa)) {
                $sql = 'SELECT * FROM marca_ropa mc LEFT JOIN proveedor p ON mc.id_proveedor = p.id_proveedor';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM marca_ropa mc LEFT JOIN proveedor p ON mc.id_proveedor = p.id_proveedor WHERE mc.id_marca_ropa = :id_marca_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_ropa', $idMarcaRopa, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO marca_ropa(marca_ropa, id_proveedor) VALUES (:marca_ropa, :id_proveedor)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':marca_ropa', $data['marca_ropa'], PDO::PARAM_STR);
                $st->bindParam(':id_proveedor', $data['id_proveedor'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idMarcaRopa){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM ropa WHERE id_marca_ropa = :id_marca_ropa";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_ropa', $idMarcaRopa, PDO::PARAM_INT);

                $sql2 = "DELETE FROM marca_ropa WHERE id_marca_ropa = :id_marca_ropa";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_marca_ropa', $idMarcaRopa, PDO::PARAM_INT);
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

        public function edit($idMarcaRopa, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE marca_ropa SET marca_ropa = :marca_ropa, id_proveedor = :id_proveedor WHERE id_marca_ropa = :id_marca_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_ropa', $idMarcaRopa, PDO::PARAM_INT);
                $st->bindParam(':marca_ropa', $data['marca_ropa'], PDO::PARAM_STR);
                $st->bindParam(':id_proveedor', $data['id_proveedor'], PDO::PARAM_INT);
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
	$marca_ropa = new MarcaRopa;
?>