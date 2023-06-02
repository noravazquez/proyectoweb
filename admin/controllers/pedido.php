<?php
    require_once(__DIR__.'/sistema.php');

    class Pedido extends Sistema{
        public function get($idPedido = null){
            $this->db();
            if (is_null($idPedido)) {
                $sql = 'SELECT * FROM pedido p LEFT JOIN cliente c ON p.id_cliente = c.id_cliente';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM pedido p LEFT JOIN cliente c ON p.id_cliente = c.id_cliente WHERE id_pedido = :id_pedido';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            $pagado = isset($_POST['pagado']) && $_POST['pagado'] == 1 ? 1 : 0;
            $entregado = isset($_POST['entregado']) && $_POST['entregado'] == 1 ? 1 : 0;
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO pedido(id_cliente, fecha_pedido, fecha_entrega, pagado, entregado, direccion_entrega) VALUES (:id_cliente, :fecha_pedido, :fecha_entrega, :pagado, :entregado, :direccion_entrega)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
                $st->bindParam(':fecha_pedido', $data['fecha_pedido'], PDO::PARAM_STR);
                $st->bindParam(':fecha_entrega', $data['fecha_entrega'], PDO::PARAM_STR);
                $st->bindParam(':pagado', $pagado, PDO::PARAM_INT);
                $st->bindParam(':entregado', $entregado, PDO::PARAM_INT);
                $st->bindParam(':direccion_entrega', $data['direccion_entrega'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idPedido){
            $this->db();

            try {
                $this->db->beginTransaction();
                $sql = "DELETE FROM pago WHERE id_pedido = :id_pedido";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);

                $sql1 = "DELETE FROM detalle_pedido_juguete WHERE id_pedido = :id_pedido";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);

                $sql2 = "DELETE FROM detalle_pedido_ropa WHERE id_pedido = :id_pedido";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);

                $sql3 = "DELETE FROM detalle_pedido_calzado WHERE id_pedido = :id_pedido";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);

                $sql4 = "DELETE FROM pedido WHERE id_pedido = :id_pedido";
                $st4 = $this->db->prepare($sql4);
                $st4->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);

                $st->execute();
                $st1->execute();
                $st2->execute();
                $st3->execute();
                $st4->execute();
                $rc = $st4->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idPedido, $data){
            $this->db();
            $pagado_actual = 0; 
            if (isset($data['pagado']) && $data['pagado'] == '1') {
                $pagado_actual = 1; 
            }
            if (isset($_POST['pagado']) && $_POST['pagado'] == '1') {
                $pagado_nuevo = 1;
            } else {
                $pagado_nuevo = 0;
            }
            $entregado_actual = 0; 
            if (isset($data['entregado']) && $data['entregado'] == '1') {
                $entregado_actual = 1; 
            }
            if (isset($_POST['entregado']) && $_POST['entregado'] == '1') {
                $entregado_nuevo = 1;
            } else {
                $entregado_nuevo = 0;
            }
            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE pedido SET id_cliente = :id_cliente, fecha_pedido = :fecha_pedido, fecha_entrega = :fecha_entrega, pagado = :pagado, entregado = :entregado, direccion_entrega = :direccion_entrega WHERE id_pedido = :id_pedido';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $st->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
                $st->bindParam(':fecha_pedido', $data['fecha_pedido'], PDO::PARAM_STR);
                $st->bindParam(':fecha_entrega', $data['fecha_entrega'], PDO::PARAM_STR);
                if ($pagado_nuevo != $pagado_actual) {
                    $st->bindParam(":pagado", $pagado_nuevo, PDO::PARAM_INT);
                }else {
                    $st->bindParam(":pagado", $pagado_actual, PDO::PARAM_INT);
                }
                if ($entregado_nuevo != $entregado_actual) {
                    $st->bindParam(":entregado", $entregado_nuevo, PDO::PARAM_INT);
                }else {
                    $st->bindParam(":entregado", $entregado_actual, PDO::PARAM_INT);
                }
                $st->bindParam(':direccion_entrega', $data['direccion_entrega'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function countPedido() {
            $this->db();
            $sql = 'SELECT COUNT(*) AS total FROM pedido';
            $st = $this->db->prepare($sql);
            $st->execute();
            $count = $st->fetchColumn();
            return $count;
        }

        public function newPedido($idCliente, $fecha, $fechaEntrega, $pagado, $entregado, $direccion){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO pedido(id_cliente, fecha_pedido, fecha_entrega, pagado, entregado, direccion_entrega) VALUES (:id_cliente, :fecha_pedido, :fecha_entrega, :pagado, :entregado, :direccion_entrega)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
                $st->bindParam(':fecha_pedido', $fecha, PDO::PARAM_STR);
                $st->bindParam(':fecha_entrega', $fechaEntrega, PDO::PARAM_STR);
                $st->bindParam(':pagado', $pagado, PDO::PARAM_INT);
                $st->bindParam(':entregado', $entregado, PDO::PARAM_INT);
                $st->bindParam(':direccion_entrega', $direccion, PDO::PARAM_STR);
                $st->execute();
                $idPedido = $this->db->lastInsertId();

                $this->db->commit();

                return $idPedido;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function updatePagado($idPedido){
            $this->db();
            $pagado_actual = 1;
            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE pedido SET pagado = :pagado WHERE id_pedido = :id_pedido';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                
                $st->bindParam(":pagado", $pagado_actual, PDO::PARAM_INT);
               
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

    $pedido = new Pedido;
?>