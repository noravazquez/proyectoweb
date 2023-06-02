<?php
	require_once(__DIR__.'/sistema.php');

	class DetallePedidoJuguete extends Sistema 
	{
		public function get($idPedido = null, $idJuguete = null){
            $this->db();
            if (is_null($idPedido) and is_null($idJuguete)) {
                $sql = 'SELECT * FROM detalle_pedido_juguete dpj LEFT JOIN pedido pe ON dpj.id_pedido = pe.id_pedido LEFT JOIN juguete j ON dpj.id_juguete = j.id_juguete';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM detalle_pedido_juguete dpj LEFT JOIN pedido pe ON dpj.id_pedido = pe.id_pedido LEFT JOIN juguete j ON dpj.id_juguete = j.id_juguete WHERE dpj.id_pedido = :id_pedido AND dpj.id_juguete = :id_juguete';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO detalle_pedido_juguete(id_pedido, id_juguete, cantidad) VALUES (:id_pedido, :id_juguete, :cantidad)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $data['id_pedido'], PDO::PARAM_INT);
                $st->bindParam(':id_juguete', $data['id_juguete'], PDO::PARAM_INT);
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

        public function delete($idPedido, $idJuguete){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM detalle_pedido_juguete WHERE id_pedido = :id_pedido AND id_juguete = :id_juguete";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idPedido, $idJuguete, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE detalle_pedido_juguete SET id_pedido = :id_pedido, id_juguete = :id_juguete, cantidad = :cantidad WHERE id_pedido = :id_pedido_actual AND id_juguete = :id_juguete_actual';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido_actual', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_juguete_actual', $idJuguete, PDO::PARAM_INT);
                $st->bindParam(':id_pedido', $data['id_pedido'], PDO::PARAM_INT);
                $st->bindParam(':id_juguete', $data['id_juguete'], PDO::PARAM_INT);
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

        public function newDPJ($idPedido, $idJuguete, $cantidad){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO detalle_pedido_juguete(id_pedido, id_juguete, cantidad) VALUES (:id_pedido, :id_juguete, :cantidad)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);
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
	$detalle_pedido_juguete = new DetallePedidoJuguete;
?>