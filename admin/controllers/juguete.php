<?php
	require_once(__DIR__.'/sistema.php');

	class Juguete extends Sistema 
	{
		public function get($idJuguete = null){
            $this->db();
            if (is_null($idJuguete)) {
                $sql = 'SELECT * FROM juguete c LEFT JOIN categoria_juguete cc ON c.id_categoria_juguete = cc.id_categoria_juguete LEFT JOIN marca_juguete mc ON c.id_marca_juguete = mc.id_marca_juguete LEFT JOIN sucursal s ON c.id_sucursal = s.id_sucursal';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM juguete c LEFT JOIN categoria_juguete cc ON c.id_categoria_juguete = cc.id_categoria_juguete LEFT JOIN marca_juguete mc ON c.id_marca_juguete = mc.id_marca_juguete LEFT JOIN sucursal s ON c.id_sucursal = s.id_sucursal WHERE id_juguete = :id_juguete';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);
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
                $nombrearchivo = str_replace(" ","_", $data['juguete']);
                $nombrearchivo = substr($nombrearchivo, 0,20);
                $sql = 'INSERT INTO juguete(juguete, descripcion, precio, stock, estado, edad_recomendada, imagen, id_categoria_juguete, id_marca_juguete, id_sucursal) VALUES (:juguete, :descripcion, :precio, :stock, :estado, :edad_recomendada, :imagen, :id_categoria_juguete, :id_marca_juguete, :id_sucursal)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':juguete', $data['juguete'], PDO::PARAM_STR);
                $st->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
                $st->bindParam(':precio', $data['precio'], PDO::PARAM_INT);
                $st->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
                $st->bindParam(':estado', $estado, PDO::PARAM_INT);
                $st->bindParam(':edad_recomendada', $data['edad_recomendada'], PDO::PARAM_INT);
                $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);
                $imagen = "images/default-image.png";
                if ($secargo) {
                    $imagen = $secargo;
                }
                $st->bindParam(':imagen', $imagen, PDO::PARAM_STR);
                $st->bindParam(':id_categoria_juguete', $data['id_categoria_juguete'], PDO::PARAM_INT);
                $st->bindParam(':id_marca_juguete', $data['id_marca_juguete'], PDO::PARAM_INT);
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

        public function delete($idJuguete){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM detalle_pedido_juguete WHERE id_juguete = :id_juguete";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);

                $sql1 = "DELETE FROM comentario_juguete WHERE id_juguete = :id_juguete";
                $st1 = $this->db->prepare($sql1);
                $st1->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);

                $sql3 = "DELETE FROM juguete WHERE id_juguete = :id_juguete";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);
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

        public function edit($idJuguete, $data){
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
                $nombrearchivo = str_replace(" ","_", $data['juguete']);
                $nombrearchivo = substr($nombrearchivo, 0,20);
                $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);

                if ($secargo) {
                    $sql = 'UPDATE juguete SET juguete = :juguete, descripcion = :descripcion, precio = :precio, stock = :stock, estado = :estado, edad_recomendada = :edad_recomendada, imagen = :imagen, id_categoria_juguete = :id_categoria_juguete, id_marca_juguete = :id_marca_juguete, id_sucursal = :id_sucursal WHERE id_juguete = :id_juguete';
                } else {
                    $sql = 'UPDATE juguete SET juguete = :juguete, descripcion = :descripcion, precio = :precio, stock = :stock, estado = :estado, edad_recomendada = :edad_recomendada, id_categoria_juguete = :id_categoria_juguete, id_marca_juguete = :id_marca_juguete, id_sucursal = :id_sucursal WHERE id_juguete = :id_juguete';
                }
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);
                $st->bindParam(':juguete', $data['juguete'], PDO::PARAM_STR);
                $st->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
                $st->bindParam(':precio', $data['precio'], PDO::PARAM_INT);
                $st->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
                if ($estado_nuevo != $estado_actual) {
                    $st->bindParam(":estado", $estado_nuevo, PDO::PARAM_INT);
                }else {
                    $st->bindParam(":estado", $estado_actual, PDO::PARAM_INT);
                }
                $st->bindParam(':edad_recomendada', $data['edad_recomendada'], PDO::PARAM_INT);
                if ($secargo) {
                    $st->bindParam(":imagen", $secargo, PDO::PARAM_STR);
                }
                $st->bindParam(':id_categoria_juguete', $data['id_categoria_juguete'], PDO::PARAM_INT);
                $st->bindParam(':id_marca_juguete', $data['id_marca_juguete'], PDO::PARAM_INT);
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

        public function countJuguete() {
            $this->db();
            $sql = 'SELECT COUNT(*) AS total FROM juguete';
            $st = $this->db->prepare($sql);
            $st->execute();
            $count = $st->fetchColumn();
            return $count;
        }

        public function jugueteVendido(){
            $this->db();
            $sql = 'SELECT j.juguete AS nombre_juguete, SUM(dpj.cantidad) AS cantidad_vendida FROM detalle_pedido_juguete dpj INNER JOIN juguete j ON dpj.id_juguete = j.id_juguete GROUP BY j.juguete ORDER BY cantidad_vendida DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function totalVentasJuguete(){
            $this->db();
            $fechaActual = date('Y-m-d');
            $fechaInicio = date('Y-m-01', strtotime('first day of this month', strtotime($fechaActual)));
            $fechaFin = date('Y-m-t', strtotime('last day of this month', strtotime($fechaActual)));
            $sql = "SELECT SUM(dpj.cantidad * j.precio) AS total_ventas FROM pedido pe JOIN detalle_pedido_juguete dpj ON pe.id_pedido = dpj.id_pedido JOIN juguete j ON dpj.id_juguete = j.id_juguete WHERE pe.fecha_pedido BETWEEN '$fechaInicio' AND '$fechaFin'";
    
            $st = $this->db->prepare($sql);
            $st->execute();
            
            // Obtener el resultado de la consulta
            $resultado = $st->fetch(PDO::FETCH_ASSOC);
            $totalVentas = $resultado['total_ventas'];
            
            return $totalVentas;
        }

        public function proveedoresJuguete(){
            $this->db();
            $sql = 'SELECT p.proveedor AS proveedor, SUM(d.cantidad) AS cantidad_vendida, SUM(d.cantidad * j.precio) AS total_vendido FROM proveedor p JOIN marca_juguete m ON p.id_proveedor = m.id_proveedor JOIN juguete j ON m.id_marca_juguete = j.id_marca_juguete JOIN detalle_pedido_juguete d ON j.id_juguete = d.id_juguete JOIN pedido pe ON d.id_pedido = pe.id_pedido GROUP BY p.proveedor ORDER BY total_vendido DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function clientesJuguete(){
            $this->db();
            $sql = 'SELECT CONCAT(c.nombre, " ", c.apellido_paterno, " ", c.apellido_materno) AS cliente, SUM(d.cantidad) AS cantidad, SUM(d.cantidad * j.precio) AS total_comprado FROM cliente c JOIN pedido p ON c.id_cliente = p.id_cliente JOIN detalle_pedido_juguete d ON p.id_pedido = d.id_pedido JOIN juguete j ON d.id_juguete = j.id_juguete GROUP BY cliente ORDER BY total_comprado DESC LIMIT 5';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function getComentarios($idJuguete)
        {
            $this->db();
            $sql = 'SELECT * FROM comentario_juguete cj 
                    LEFT JOIN cliente c ON cj.id_cliente = c.id_cliente 
                    LEFT JOIN usuario u ON c.id_usuario = u.id_usuario 
                    WHERE cj.id_juguete = :id_juguete';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_juguete', $idJuguete, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
	}
	$juguete = new Juguete;
?>