<?php
	require_once(__DIR__.'/sistema.php');

	class Pago extends Sistema 
	{
		public function get($idPedido = null, $idMetodoPago = null){
            $this->db();
            if (is_null($idPedido) and is_null($idMetodoPago)) {
                $sql = 'SELECT * FROM pago p LEFT JOIN pedido pe ON p.id_pedido = pe.id_pedido LEFT JOIN metodo_pago mp ON p.id_metodo_pago = mp.id_metodo_pago';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM pago p LEFT JOIN pedido pe ON p.id_pedido = pe.id_pedido LEFT JOIN metodo_pago mp ON p.id_metodo_pago = mp.id_metodo_pago WHERE p.id_pedido = :id_pedido AND p.id_metodo_pago = :id_metodo_pago';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_metodo_pago', $idMetodoPago, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO pago(id_pedido, id_metodo_pago, monto, folio) VALUES (:id_pedido, :id_metodo_pago, :monto, :folio)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $data['id_pedido'], PDO::PARAM_INT);
                $st->bindParam(':id_metodo_pago', $data['id_metodo_pago'], PDO::PARAM_INT);
                $st->bindParam(':monto', $data['monto'], PDO::PARAM_INT);
                $st->bindParam(':folio', $data['folio'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idPedido, $idMetodoPago){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM pago WHERE id_pedido = :id_pedido AND id_metodo_pago = :id_metodo_pago";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_metodo_pago', $idMetodoPago, PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idPedido, $idMetodoPago, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE pago SET id_pedido = :id_pedido, id_metodo_pago = :id_metodo_pago, monto = :monto, folio = :folio WHERE id_pedido = :id_pedido_actual AND id_metodo_pago = :id_metodo_pago_actual';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido_actual', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_metodo_pago_actual', $idMetodoPago, PDO::PARAM_INT);
                $st->bindParam(':id_pedido', $data['id_pedido'], PDO::PARAM_INT);
                $st->bindParam(':id_metodo_pago', $data['id_metodo_pago'], PDO::PARAM_INT);
                $st->bindParam(':monto', $data['monto'], PDO::PARAM_INT);
                $st->bindParam(':folio', $data['folio'], PDO::PARAM_STR);
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
	$pago = new Pago;
?>