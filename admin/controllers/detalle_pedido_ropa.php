<?php
	require_once(__DIR__.'/sistema.php');

	class DetallePedidoRopa extends Sistema 
	{
		public function get($idPedido = null, $idRopa = null){
            $this->db();
            if (is_null($idPedido) and is_null($idRopa)) {
                $sql = 'SELECT * FROM detalle_pedido_ropa dpr LEFT JOIN pedido pe ON dpr.id_pedido = pe.id_pedido LEFT JOIN ropa r ON dpr.id_ropa = r.id_ropa';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM detalle_pedido_ropa dpr LEFT JOIN pedido pe ON dpr.id_pedido = pe.id_pedido LEFT JOIN ropa r ON dpr.id_ropa = r.id_ropa WHERE dpr.id_pedido = :id_pedido AND dpr.id_ropa = :id_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO detalle_pedido_ropa(id_pedido, id_ropa, cantidad) VALUES (:id_pedido, :id_ropa, :cantidad)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $data['id_pedido'], PDO::PARAM_INT);
                $st->bindParam(':id_ropa', $data['id_ropa'], PDO::PARAM_INT);
                $st->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idPedido, $idRopa){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM detalle_pedido_ropa WHERE id_pedido = :id_pedido AND id_ropa = :id_ropa";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idPedido, $idRopa, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE detalle_pedido_ropa SET id_pedido = :id_pedido, id_ropa = :id_ropa, cantidad = :cantidad WHERE id_pedido = :id_pedido_actual AND id_ropa = :id_ropa_actual';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido_actual', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_ropa_actual', $idRopa, PDO::PARAM_INT);
                $st->bindParam(':id_pedido', $data['id_pedido'], PDO::PARAM_INT);
                $st->bindParam(':id_ropa', $data['id_ropa'], PDO::PARAM_INT);
                $st->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function newDPR($idPedido, $idRopa, $cantidad){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO detalle_pedido_ropa(id_pedido, id_ropa, cantidad) VALUES (:id_pedido, :id_ropa, :cantidad)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);
                $st->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
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
	$detalle_pedido_ropa = new DetallePedidoRopa;
?>