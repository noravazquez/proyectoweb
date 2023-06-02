<?php
    require_once(__DIR__.'/sistema.php');

    class MetodoPago extends Sistema{
        public function get($idMetodoPago = null){
            $this->db();
            if (is_null($idMetodoPago)) {
                $sql = 'SELECT * FROM metodo_pago';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM metodo_pago WHERE id_metodo_pago = :id_metodo_pago';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_metodo_pago', $idMetodoPago, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            $estatus = isset($_POST['estatus']) && $_POST['estatus'] == 1 ? 1 : 0;
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO metodo_pago(metodo_pago, estatus) VALUES (:metodo_pago, :estatus)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':metodo_pago', $data['metodo_pago'], PDO::PARAM_STR);
                $st->bindParam(':estatus', $estatus, PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idMetodoPago){
            $this->db();

            try {
                $this->db->beginTransaction();
                $sql = "DELETE FROM pago WHERE id_metodo_pago = :id_metodo_pago";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_metodo_pago', $idMetodoPago, PDO::PARAM_INT);

                $sql1 = "DELETE FROM metodo_pago WHERE id_metodo_pago = :id_metodo_pago";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_metodo_pago', $idMetodoPago, PDO::PARAM_INT);

                $st->execute();
                $st1->execute();
                $rc = $st1->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idMetodoPago, $data){
            $this->db();
            $estatus_actual = 0; 
            if (isset($data['estatus']) && $data['estatus'] == '1') {
                $estatus_actual = 1; 
            }
            if (isset($_POST['estatus']) && $_POST['estatus'] == '1') {
                $estatus_nuevo = 1;
            } else {
                $estatus_nuevo = 0;
            }
            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE metodo_pago SET metodo_pago = :metodo_pago, estatus = :estatus WHERE id_metodo_pago = :id_metodo_pago';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_metodo_pago', $idMetodoPago, PDO::PARAM_INT);
                $st->bindParam(':metodo_pago', $data['metodo_pago'], PDO::PARAM_STR);
                if ($estatus_nuevo != $estatus_actual) {
                    $st->bindParam(":estatus", $estatus_nuevo, PDO::PARAM_INT);
                }else {
                    $st->bindParam(":estatus", $estatus_actual, PDO::PARAM_INT);
                }
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

    $metodo_pago = new MetodoPago;
?>