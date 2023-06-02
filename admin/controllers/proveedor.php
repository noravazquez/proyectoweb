<?php
    require_once(__DIR__.'/sistema.php');

    class Proveedor extends Sistema{
        public function get($idProveedor = null){
            $this->db();
            if (is_null($idProveedor)) {
                $sql = 'SELECT * FROM proveedor';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM proveedor WHERE id_proveedor = :id_proveedor';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_proveedor', $idProveedor, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO proveedor(proveedor, RFC, telefono, correo) VALUES (:proveedor, :rfc, :telefono, :correo)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':proveedor', $data['proveedor'], PDO::PARAM_STR);
                $st->bindParam(':rfc', $data['RFC'], PDO::PARAM_STR);
                $st->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
                $st->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idProveedor){
            $this->db();

            try {
                $this->db->beginTransaction();
                $sql = "DELETE FROM marca_calzado WHERE id_proveedor = :id_proveedor";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_proveedor', $idProveedor, PDO::PARAM_INT);

                $sql1 = "DELETE FROM marca_ropa WHERE id_proveedor = :id_proveedor";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_proveedor', $idProveedor, PDO::PARAM_INT);

                $sql2 = "DELETE FROM marca_juguete WHERE id_proveedor = :id_proveedor";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_proveedor', $idProveedor, PDO::PARAM_INT);

                $sql3 = "DELETE FROM proveedor WHERE id_proveedor = :id_proveedor";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_proveedor', $idProveedor, PDO::PARAM_INT);
                $st->execute();
                $st1->execute();
                $st2->execute();
                $st3->execute();
                $rc = $st3->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idProveedor, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE proveedor SET proveedor = :proveedor, RFC = :rfc, telefono = :telefono, correo = :correo WHERE id_proveedor = :id_proveedor';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_proveedor', $idProveedor, PDO::PARAM_INT);
                $st->bindParam(':proveedor', $data['proveedor'], PDO::PARAM_STR);
                $st->bindParam(':rfc', $data['RFC'], PDO::PARAM_STR);
                $st->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
                $st->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function countProveedor() {
            $this->db();
            $sql = 'SELECT COUNT(*) AS total FROM proveedor';
            $st = $this->db->prepare($sql);
            $st->execute();
            $count = $st->fetchColumn();
            return $count;
        }
    }

    $proveedor = new Proveedor;
?>