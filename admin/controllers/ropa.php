<?php
	require_once(__DIR__.'/sistema.php');

	class Ropa extends Sistema 
	{
		public function get($idRopa = null){
            $this->db();
            if (is_null($idRopa)) {
                $sql = 'SELECT * FROM ropa c LEFT JOIN categoria_ropa cc ON c.id_categoria_ropa = cc.id_categoria_ropa LEFT JOIN marca_ropa mc ON c.id_marca_ropa = mc.id_marca_ropa LEFT JOIN talla_ropa tc ON c.id_talla_ropa = tc.id_talla_ropa LEFT JOIN sucursal s ON c.id_sucursal = s.id_sucursal';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM ropa c LEFT JOIN categoria_ropa cc ON c.id_categoria_ropa = cc.id_categoria_ropa LEFT JOIN marca_ropa mc ON c.id_marca_ropa = mc.id_marca_ropa LEFT JOIN talla_ropa tc ON c.id_talla_ropa = tc.id_talla_ropa LEFT JOIN sucursal s ON c.id_sucursal = s.id_sucursal WHERE id_ropa = :id_ropa';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            $estado = isset($_POST['estado']) && $_POST['estado'] == 1 ? 1 : 0;
            try {
                $this->db->beginTransaction();
                $nombrearchivo = str_replace(" ","_", $data['ropa']);
                $nombrearchivo = substr($nombrearchivo, 0,20);
                $sql = 'INSERT INTO ropa(ropa, descripcion, precio, stock, estado, color, imagen, id_categoria_ropa, id_marca_ropa, id_talla_ropa, id_sucursal) VALUES (:ropa, :descripcion, :precio, :stock, :estado, :color, :imagen, :id_categoria_ropa, :id_marca_ropa, :id_talla_ropa, :id_sucursal)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':ropa', $data['ropa'], PDO::PARAM_STR);
                $st->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
                $st->bindParam(':precio', $data['precio'], PDO::PARAM_INT);
                $st->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
                $st->bindParam(':estado', $estado, PDO::PARAM_INT);
                $st->bindParam(':color', $data['color'], PDO::PARAM_STR);
                $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);
                $imagen = "images/default-image.png";
                if ($secargo) {
                    $imagen = $secargo;
                }
                $st->bindParam(':imagen', $imagen, PDO::PARAM_STR);
                $st->bindParam(':id_categoria_ropa', $data['id_categoria_ropa'], PDO::PARAM_INT);
                $st->bindParam(':id_marca_ropa', $data['id_marca_ropa'], PDO::PARAM_INT);
                $st->bindParam(':id_talla_ropa', $data['id_talla_ropa'], PDO::PARAM_INT);
                $st->bindParam(':id_sucursal', $data['id_sucursal'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idRopa){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM detalle_pedido_ropa WHERE id_ropa = :id_ropa";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);

                $sql1 = "DELETE FROM comentario_ropa WHERE id_ropa = :id_ropa";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);

                $sql3 = "DELETE FROM ropa WHERE id_ropa = :id_ropa";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);
                $st->execute();
                $st1->execute();
                $st3->execute();
                $rc = $st3->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idRopa, $data){
            $this->db();
            $estado_actual = 0; 
            if (isset($data['estado']) && $data['estado'] == '1') {
                $estado_actual = 1; 
            }
            if (isset($_POST['estado']) && $_POST['estado'] == '1') {
                $estado_nuevo = 1;
            } else {
                $estado_nuevo = 0;
            }
            try {
                $this->db->beginTransaction();
                $nombrearchivo = str_replace(" ","_", $data['ropa']);
                $nombrearchivo = substr($nombrearchivo, 0,20);
                $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);

                if ($secargo) {
                    $sql = 'UPDATE ropa SET ropa = :ropa, descripcion = :descripcion, precio = :precio, stock = :stock, estado = :estado, color = :color, imagen = :imagen, id_categoria_ropa = :id_categoria_ropa, id_marca_ropa = :id_marca_ropa, id_talla_ropa = :id_talla_ropa, id_sucursal = :id_sucursal WHERE id_ropa = :id_ropa';
                } else {
                    $sql = 'UPDATE ropa SET ropa = :ropa, descripcion = :descripcion, precio = :precio, stock = :stock, estado = :estado, color = :color, id_categoria_ropa = :id_categoria_ropa, id_marca_ropa = :id_marca_ropa, id_talla_ropa = :id_talla_ropa, id_sucursal = :id_sucursal WHERE id_ropa = :id_ropa';
                }
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);
                $st->bindParam(':ropa', $data['ropa'], PDO::PARAM_STR);
                $st->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
                $st->bindParam(':precio', $data['precio'], PDO::PARAM_INT);
                $st->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
                if ($estado_nuevo != $estado_actual) {
                    $st->bindParam(":estado", $estado_nuevo, PDO::PARAM_INT);
                }else {
                    $st->bindParam(":estado", $estado_actual, PDO::PARAM_INT);
                }
                $st->bindParam(':color', $data['color'], PDO::PARAM_STR);
                if ($secargo) {
                    $st->bindParam(":imagen", $secargo, PDO::PARAM_STR);
                }
                $st->bindParam(':id_categoria_ropa', $data['id_categoria_ropa'], PDO::PARAM_INT);
                $st->bindParam(':id_marca_ropa', $data['id_marca_ropa'], PDO::PARAM_INT);
                $st->bindParam(':id_talla_ropa', $data['id_talla_ropa'], PDO::PARAM_INT);
                $st->bindParam(':id_sucursal', $data['id_sucursal'], PDO::PARAM_INT);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function countRopa() {
            $this->db();
            $sql = 'SELECT COUNT(*) AS total FROM ropa';
            $st = $this->db->prepare($sql);
            $st->execute();
            $count = $st->fetchColumn();
            return $count;
        }

        public function ropaVendida(){
            $this->db();
            $sql = 'SELECT r.ropa AS nombre_ropa, SUM(dpr.cantidad) AS cantidad_vendida FROM detalle_pedido_ropa dpr INNER JOIN ropa r ON dpr.id_ropa = r.id_ropa GROUP BY r.ropa ORDER BY cantidad_vendida DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function totalVentasRopa(){
            $this->db();
            $fechaActual = date('Y-m-d');
            $fechaInicio = date('Y-m-01', strtotime('first day of this month', strtotime($fechaActual)));
            $fechaFin = date('Y-m-t', strtotime('last day of this month', strtotime($fechaActual)));
            $sql = "SELECT SUM(dpr.cantidad * r.precio) AS total_ventas FROM pedido pe JOIN detalle_pedido_ropa dpr ON pe.id_pedido = dpr.id_pedido JOIN ropa r ON dpr.id_ropa = r.id_ropa WHERE pe.fecha_pedido BETWEEN '$fechaInicio' AND '$fechaFin'";
    
            $st = $this->db->prepare($sql);
            $st->execute();
            
            // Obtener el resultado de la consulta
            $resultado = $st->fetch(PDO::FETCH_ASSOC);
            $totalVentas = $resultado['total_ventas'];
            
            return $totalVentas;
        }

        public function proveedoresRopa(){
            $this->db();
            $sql = 'SELECT p.proveedor AS proveedor, SUM(d.cantidad) AS cantidad_vendida, SUM(d.cantidad * r.precio) AS total_vendido FROM proveedor p JOIN marca_ropa m ON p.id_proveedor = m.id_proveedor JOIN ropa r ON m.id_marca_ropa = r.id_marca_ropa JOIN detalle_pedido_ropa d ON r.id_ropa = d.id_ropa JOIN pedido pe ON d.id_pedido = pe.id_pedido GROUP BY p.proveedor ORDER BY total_vendido DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function clientesRopa(){
            $this->db();
            $sql = 'SELECT CONCAT(c.nombre, " ", c.apellido_paterno, " ", c.apellido_materno) AS cliente, SUM(d.cantidad) AS cantidad, SUM(d.cantidad * r.precio) AS total_comprado FROM cliente c JOIN pedido p ON c.id_cliente = p.id_cliente JOIN detalle_pedido_ropa d ON p.id_pedido = d.id_pedido JOIN ropa r ON d.id_ropa = r.id_ropa GROUP BY cliente ORDER BY total_comprado DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function getComentarios($idRopa)
        {
            $this->db();
            $sql = 'SELECT * FROM comentario_ropa cr 
                    LEFT JOIN cliente c ON cr.id_cliente = c.id_cliente 
                    LEFT JOIN usuario u ON c.id_usuario = u.id_usuario 
                    WHERE cr.id_ropa = :id_ropa';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_ropa', $idRopa, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
	}
	$ropa = new Ropa;
?>