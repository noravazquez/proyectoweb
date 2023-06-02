<?php
	require_once(__DIR__.'/sistema.php');

	class Calzado extends Sistema 
	{
		public function get($idCalzado = null){
            $this->db();
            if (is_null($idCalzado)) {
                $sql = 'SELECT * FROM calzado c LEFT JOIN categoria_calzado cc ON c.id_categoria_calzado = cc.id_categoria_calzado LEFT JOIN marca_calzado mc ON c.id_marca_calzado = mc.id_marca_calzado LEFT JOIN talla_calzado tc ON c.id_talla_calzado = tc.id_talla_calzado LEFT JOIN sucursal s ON c.id_sucursal = s.id_sucursal';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM calzado c LEFT JOIN categoria_calzado cc ON c.id_categoria_calzado = cc.id_categoria_calzado LEFT JOIN marca_calzado mc ON c.id_marca_calzado = mc.id_marca_calzado LEFT JOIN talla_calzado tc ON c.id_talla_calzado = tc.id_talla_calzado LEFT JOIN sucursal s ON c.id_sucursal = s.id_sucursal WHERE id_calzado = :id_calzado';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);
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
                $nombrearchivo = str_replace(" ","_", $data['calzado']);
                $nombrearchivo = substr($nombrearchivo, 0,20);
                $sql = 'INSERT INTO calzado(calzado, descripcion, precio, stock, estado, color, imagen, id_categoria_calzado, id_marca_calzado, id_talla_calzado, id_sucursal) VALUES (:calzado, :descripcion, :precio, :stock, :estado, :color, :imagen, :id_categoria_calzado, :id_marca_calzado, :id_talla_calzado, :id_sucursal)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':calzado', $data['calzado'], PDO::PARAM_STR);
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
                $st->bindParam(':id_categoria_calzado', $data['id_categoria_calzado'], PDO::PARAM_INT);
                $st->bindParam(':id_marca_calzado', $data['id_marca_calzado'], PDO::PARAM_INT);
                $st->bindParam(':id_talla_calzado', $data['id_talla_calzado'], PDO::PARAM_INT);
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

        public function delete($idCalzado){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM detalle_pedido_calzado WHERE id_calzado = :id_calzado";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);

                $sql1 = "DELETE FROM comentario_calzado WHERE id_calzado = :id_calzado";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);

                $sql3 = "DELETE FROM calzado WHERE id_calzado = :id_calzado";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);
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

        public function edit($idCalzado, $data){
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
                $nombrearchivo = str_replace(" ","_", $data['calzado']);
                $nombrearchivo = substr($nombrearchivo, 0,20);
                $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);

                if ($secargo) {
                    $sql = 'UPDATE calzado SET calzado = :calzado, descripcion = :descripcion, precio = :precio, stock = :stock, estado = :estado, color = :color, imagen = :imagen, id_categoria_calzado = :id_categoria_calzado, id_marca_calzado = :id_marca_calzado, id_talla_calzado = :id_talla_calzado, id_sucursal = :id_sucursal WHERE id_calzado = :id_calzado';
                } else {
                    $sql = 'UPDATE calzado SET calzado = :calzado, descripcion = :descripcion, precio = :precio, stock = :stock, estado = :estado, color = :color, id_categoria_calzado = :id_categoria_calzado, id_marca_calzado = :id_marca_calzado, id_talla_calzado = :id_talla_calzado, id_sucursal = :id_sucursal WHERE id_calzado = :id_calzado';
                }
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);
                $st->bindParam(':calzado', $data['calzado'], PDO::PARAM_STR);
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
                $st->bindParam(':id_categoria_calzado', $data['id_categoria_calzado'], PDO::PARAM_INT);
                $st->bindParam(':id_marca_calzado', $data['id_marca_calzado'], PDO::PARAM_INT);
                $st->bindParam(':id_talla_calzado', $data['id_talla_calzado'], PDO::PARAM_INT);
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

        public function countCalzado() {
            $this->db();
            $sql = 'SELECT COUNT(*) AS total FROM calzado';
            $st = $this->db->prepare($sql);
            $st->execute();
            $count = $st->fetchColumn();
            return $count;
        }

        public function calzadoVendido(){
            $this->db();
            $sql = 'SELECT c.calzado AS nombre_calzado, SUM(dpc.cantidad) AS cantidad_vendida FROM detalle_pedido_calzado dpc INNER JOIN calzado c ON dpc.id_calzado = c.id_calzado GROUP BY c.calzado ORDER BY cantidad_vendida DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function totalVentasCalzado(){
            $this->db();
            $fechaActual = date('Y-m-d');
            $fechaInicio = date('Y-m-01', strtotime('first day of this month', strtotime($fechaActual)));
            $fechaFin = date('Y-m-t', strtotime('last day of this month', strtotime($fechaActual)));
            $sql = "SELECT SUM(dpc.cantidad * c.precio) AS total_ventas FROM pedido pe JOIN detalle_pedido_calzado dpc ON pe.id_pedido = dpc.id_pedido JOIN calzado c ON dpc.id_calzado = c.id_calzado WHERE pe.fecha_pedido BETWEEN '$fechaInicio' AND '$fechaFin'";
    
            $st = $this->db->prepare($sql);
            $st->execute();
            
            // Obtener el resultado de la consulta
            $resultado = $st->fetch(PDO::FETCH_ASSOC);
            $totalVentas = $resultado['total_ventas'];
            
            return $totalVentas;
        }

        public function proveedoresCalzado(){
            $this->db();
            $sql = 'SELECT p.proveedor AS proveedor, SUM(d.cantidad) AS cantidad_vendida, SUM(d.cantidad * c.precio) AS total_vendido FROM proveedor p JOIN marca_calzado m ON p.id_proveedor = m.id_proveedor JOIN calzado c ON m.id_marca_calzado = c.id_marca_calzado JOIN detalle_pedido_calzado d ON c.id_calzado = d.id_calzado JOIN pedido pe ON d.id_pedido = pe.id_pedido GROUP BY p.proveedor ORDER BY total_vendido DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function clientesCalzado(){
            $this->db();
            $sql = 'SELECT CONCAT(c.nombre, " ", c.apellido_paterno, " ", c.apellido_materno) AS cliente, SUM(d.cantidad) AS cantidad, SUM(d.cantidad * ca.precio) AS total_comprado FROM cliente c JOIN pedido p ON c.id_cliente = p.id_cliente JOIN detalle_pedido_calzado d ON p.id_pedido = d.id_pedido JOIN calzado ca ON d.id_calzado = ca.id_calzado GROUP BY cliente ORDER BY total_comprado DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function getComentarios($idCalzado)
        {
            $this->db();
            $sql = 'SELECT * FROM comentario_calzado cc 
                    LEFT JOIN cliente c ON cc.id_cliente = c.id_cliente 
                    LEFT JOIN usuario u ON c.id_usuario = u.id_usuario 
                    WHERE cc.id_calzado = :id_calzado';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_calzado', $idCalzado, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
	}
	$calzado = new Calzado;
?>