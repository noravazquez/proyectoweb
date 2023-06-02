<?php
	require_once(__DIR__.'/sistema.php');

	class DetallePedidoCalzado extends Sistema 
	{
		public function get($idPedido = null, $idCalzado = null){
            $this->db();
            if (is_null($idPedido) and is_null($idCalzado)) {
                $sql = 'SELECT * FROM detalle_pedido_calzado dpc LEFT JOIN pedido pe ON dpc.id_pedido = pe.id_pedido LEFT JOIN calzado c ON dpc.id_calzado = c.id_calzado';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM detalle_pedido_calzado dpc LEFT JOIN pedido pe ON dpc.id_pedido = pe.id_pedido LEFT JOIN calzado c ON dpc.id_calzado = c.id_calzado WHERE dpc.id_pedido = :id_pedido AND dpc.id_calzado = :id_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO detalle_pedido_calzado(id_pedido, id_calzado, cantidad) VALUES (:id_pedido, :id_calzado, :cantidad)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $data['id_pedido'], PDO::PARAM_INT);
                $st->bindParam(':id_calzado', $data['id_calzado'], PDO::PARAM_INT);
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

        public function delete($idPedido, $idCalzado){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM detalle_pedido_calzado WHERE id_pedido = :id_pedido AND id_calzado = :id_calzado";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idPedido, $idCalzado, $data){
            $this->db();
            try {
                $this->db->beginTransaction();
                $sql = 'UPDATE detalle_pedido_calzado SET id_pedido = :id_pedido, id_calzado = :id_calzado, cantidad = :cantidad WHERE id_pedido = :id_pedido_actual AND id_calzado = :id_calzado_actual';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido_actual', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_calzado_actual', $idCalzado, PDO::PARAM_INT);
                $st->bindParam(':id_pedido', $data['id_pedido'], PDO::PARAM_INT);
                $st->bindParam(':id_calzado', $data['id_calzado'], PDO::PARAM_INT);
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

        public function newDPC($idPedido, $idCalzado, $cantidad){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO detalle_pedido_calzado(id_pedido, id_calzado, cantidad) VALUES (:id_pedido, :id_calzado, :cantidad)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);
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
	$detalle_pedido_calzado = new DetallePedidoCalzado;
?>