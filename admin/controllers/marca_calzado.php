<?php
	require_once(__DIR__.'/sistema.php');

	class MarcaCalzado extends Sistema 
	{
		public function get($idMarcaCalzado = null){
            $this->db();
            if (is_null($idMarcaCalzado)) {
                $sql = 'SELECT * FROM marca_calzado mc LEFT JOIN proveedor p ON mc.id_proveedor = p.id_proveedor';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM marca_calzado mc LEFT JOIN proveedor p ON mc.id_proveedor = p.id_proveedor WHERE mc.id_marca_calzado = :id_marca_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_calzado', $idMarcaCalzado, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO marca_calzado(marca_calzado, id_proveedor) VALUES (:marca_calzado, :id_proveedor)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':marca_calzado', $data['marca_calzado'], PDO::PARAM_STR);
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

        public function delete($idMarcaCalzado){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM calzado WHERE id_marca_calzado = :id_marca_calzado";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_calzado', $idMarcaCalzado, PDO::PARAM_INT);

                $sql2 = "DELETE FROM marca_calzado WHERE id_marca_calzado = :id_marca_calzado";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_marca_calzado', $idMarcaCalzado, PDO::PARAM_INT);
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

        public function edit($idMarcaCalzado, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE marca_calzado SET marca_calzado = :marca_calzado, id_proveedor = :id_proveedor WHERE id_marca_calzado = :id_marca_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_marca_calzado', $idMarcaCalzado, PDO::PARAM_INT);
                $st->bindParam(':marca_calzado', $data['marca_calzado'], PDO::PARAM_STR);
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
	$marca_calzado = new MarcaCalzado;
?>