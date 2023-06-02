<?php
	require_once(__DIR__.'/sistema.php');

	class MarcaJuguete extends Sistema 
	{
		public function get($idMarcaJuguete = null){
            $this->db();
            if (is_null($idMarcaJuguete)) {
                $sql = 'SELECT * FROM marca_juguete mc LEFT JOIN proveedor p ON mc.id_proveedor = p.id_proveedor';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM marca_juguete mc LEFT JOIN proveedor p ON mc.id_proveedor = p.id_proveedor WHERE mc.id_marca_juguete = :id_marca_juguete';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_juguete', $idMarcaJuguete, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO marca_juguete(marca_juguete, id_proveedor) VALUES (:marca_juguete, :id_proveedor)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':marca_juguete', $data['marca_juguete'], PDO::PARAM_STR);
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

        public function delete($idMarcaJuguete){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM juguete WHERE id_marca_juguete = :id_marca_juguete";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_juguete', $idMarcaJuguete, PDO::PARAM_INT);

                $sql2 = "DELETE FROM marca_juguete WHERE id_marca_juguete = :id_marca_juguete";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_marca_juguete', $idMarcaJuguete, PDO::PARAM_INT);
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

        public function edit($idMarcaJuguete, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE marca_juguete SET marca_juguete = :marca_juguete, id_proveedor = :id_proveedor WHERE id_marca_juguete = :id_marca_juguete';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_juguete', $idMarcaJuguete, PDO::PARAM_INT);
                $st->bindParam(':marca_juguete', $data['marca_juguete'], PDO::PARAM_STR);
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
	$marca_juguete = new MarcaJuguete;
?>