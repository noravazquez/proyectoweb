<?php
    require_once(__DIR__.'/controllers/sistema.php');
    require_once ('../vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $action = (isset($_GET['action'])) ? $_GET['action'] : null;

    $sistema->db();

    switch ($action) {
        case 'ropa':
            $sql = "SELECT r.ropa, r.descripcion, r.precio, r.stock, r.color, r.imagen, cr.categoria_ropa, mr.marca_ropa, tr.talla_ropa, SUM(dpr.cantidad) AS cantidad_vendida FROM ropa r INNER JOIN categoria_ropa cr ON r.id_categoria_ropa = cr.id_categoria_ropa INNER JOIN talla_ropa tr ON r.id_talla_ropa = tr.id_talla_ropa INNER JOIN marca_ropa mr ON r.id_marca_ropa = mr.id_marca_ropa INNER JOIN detalle_pedido_ropa dpr ON r.id_ropa = dpr.id_ropa GROUP BY r.ropa ORDER BY cantidad_vendida DESC";
            $st = $sistema->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            
            $excel = new Spreadsheet();
            $hojaActiva = $excel->getActiveSheet();
            $hojaActiva->setTitle('Ropa vendida');

            $hojaActiva->getColumnDimension('A')->setWidth(20);
            $hojaActiva->setCellValue('A1', 'Ropa');
            $hojaActiva->getColumnDimension('B')->setWidth(50);
            $hojaActiva->setCellValue('B1', 'Descripcion');
            $hojaActiva->getColumnDimension('C')->setWidth(10);
            $hojaActiva->setCellValue('C1', 'Precio');
            $hojaActiva->getColumnDimension('D')->setWidth(10);
            $hojaActiva->setCellValue('D1', 'Stock');
            $hojaActiva->getColumnDimension('E')->setWidth(15);
            $hojaActiva->setCellValue('E1', 'Color');
            $hojaActiva->getColumnDimension('F')->setWidth(20);
            $hojaActiva->setCellValue('F1', 'Categoria');
            $hojaActiva->getColumnDimension('G')->setWidth(20);
            $hojaActiva->setCellValue('G1', 'Marca');
            $hojaActiva->getColumnDimension('H')->setWidth(15);
            $hojaActiva->setCellValue('H1', 'Talla');
            $hojaActiva->getColumnDimension('I')->setWidth(20);
            $hojaActiva->setCellValue('I1', 'Cantidad Vendida');

            $fila = 2;

            foreach ($data as $key => $ropa) {
                $hojaActiva->setCellValue('A'.$fila, $ropa['ropa']);
                $hojaActiva->setCellValue('B'.$fila, $ropa['descripcion']);
                $hojaActiva->setCellValue('C'.$fila, $ropa['precio']);
                $hojaActiva->setCellValue('D'.$fila, $ropa['stock']);
                $hojaActiva->setCellValue('E'.$fila, $ropa['color']);
                $hojaActiva->setCellValue('F'.$fila, $ropa['categoria_ropa']);
                $hojaActiva->setCellValue('G'.$fila, $ropa['marca_ropa']);
                $hojaActiva->setCellValue('H'.$fila, $ropa['talla_ropa']);
                $hojaActiva->setCellValue('I'.$fila, $ropa['cantidad_vendida']);
                $fila ++;
            }
        break;
        case 'calzado':
            $sql = "SELECT c.calzado, c.descripcion, c.precio, c.stock, c.color, c.imagen, cc.categoria_calzado, mc.marca_calzado, tc.talla_calzado, SUM(dpc.cantidad) AS cantidad_vendida FROM calzado c INNER JOIN categoria_calzado cc ON c.id_categoria_calzado = cc.id_categoria_calzado INNER JOIN talla_calzado tc ON c.id_talla_calzado = tc.id_talla_calzado INNER JOIN marca_calzado mc ON c.id_marca_calzado = mc.id_marca_calzado INNER JOIN detalle_pedido_calzado dpc ON c.id_calzado = dpc.id_calzado GROUP BY c.calzado ORDER BY cantidad_vendida DESC";
            $st = $sistema->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            
            $excel = new Spreadsheet();
            $hojaActiva = $excel->getActiveSheet();
            $hojaActiva->setTitle('Calzado vendido');

            $hojaActiva->getColumnDimension('A')->setWidth(20);
            $hojaActiva->setCellValue('A1', 'Calzado');
            $hojaActiva->getColumnDimension('B')->setWidth(50);
            $hojaActiva->setCellValue('B1', 'Descripcion');
            $hojaActiva->getColumnDimension('C')->setWidth(10);
            $hojaActiva->setCellValue('C1', 'Precio');
            $hojaActiva->getColumnDimension('D')->setWidth(10);
            $hojaActiva->setCellValue('D1', 'Stock');
            $hojaActiva->getColumnDimension('E')->setWidth(15);
            $hojaActiva->setCellValue('E1', 'Color');
            $hojaActiva->getColumnDimension('F')->setWidth(20);
            $hojaActiva->setCellValue('F1', 'Categoria');
            $hojaActiva->getColumnDimension('G')->setWidth(20);
            $hojaActiva->setCellValue('G1', 'Marca');
            $hojaActiva->getColumnDimension('H')->setWidth(15);
            $hojaActiva->setCellValue('H1', 'Talla');
            $hojaActiva->getColumnDimension('I')->setWidth(20);
            $hojaActiva->setCellValue('I1', 'Cantidad Vendida');

            $fila = 2;

            foreach ($data as $key => $calzado) {
                $hojaActiva->setCellValue('A'.$fila, $calzado['calzado']);
                $hojaActiva->setCellValue('B'.$fila, $calzado['descripcion']);
                $hojaActiva->setCellValue('C'.$fila, $calzado['precio']);
                $hojaActiva->setCellValue('D'.$fila, $calzado['stock']);
                $hojaActiva->setCellValue('E'.$fila, $calzado['color']);
                $hojaActiva->setCellValue('F'.$fila, $calzado['categoria_calzado']);
                $hojaActiva->setCellValue('G'.$fila, $calzado['marca_calzado']);
                $hojaActiva->setCellValue('H'.$fila, $calzado['talla_calzado']);
                $hojaActiva->setCellValue('I'.$fila, $calzado['cantidad_vendida']);
                $fila ++;
            }
        break;
        case 'juguete':
            $sql = "SELECT j.juguete, j.descripcion, j.precio, j.stock, j.edad_recomendada, j.imagen, SUM(dpj.cantidad) AS cantidad_vendida FROM juguete j INNER JOIN categoria_juguete cj ON j.id_categoria_juguete = cj.id_categoria_juguete INNER JOIN marca_juguete mj ON j.id_marca_juguete = mj.id_marca_juguete INNER JOIN detalle_pedido_juguete dpj ON j.id_juguete = dpj.id_juguete GROUP BY j.id_juguete ORDER BY cantidad_vendida DESC";
            $st = $sistema->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            
            $excel = new Spreadsheet();
            $hojaActiva = $excel->getActiveSheet();
            $hojaActiva->setTitle('Juguete vendido');

            $hojaActiva->getColumnDimension('A')->setWidth(20);
            $hojaActiva->setCellValue('A1', 'Juguete');
            $hojaActiva->getColumnDimension('B')->setWidth(50);
            $hojaActiva->setCellValue('B1', 'Descripcion');
            $hojaActiva->getColumnDimension('C')->setWidth(10);
            $hojaActiva->setCellValue('C1', 'Precio');
            $hojaActiva->getColumnDimension('D')->setWidth(10);
            $hojaActiva->setCellValue('D1', 'Stock');
            $hojaActiva->getColumnDimension('E')->setWidth(20);
            $hojaActiva->setCellValue('E1', 'Edad recomendada');
            $hojaActiva->getColumnDimension('F')->setWidth(20);
            $hojaActiva->setCellValue('F1', 'Categoria');
            $hojaActiva->getColumnDimension('G')->setWidth(20);
            $hojaActiva->setCellValue('G1', 'Marca');
            $hojaActiva->getColumnDimension('H')->setWidth(20);
            $hojaActiva->setCellValue('H1', 'Cantidad Vendida');

            $fila = 2;

            foreach ($data as $key => $juguete) {
                $hojaActiva->setCellValue('A'.$fila, $juguete['juguete']);
                $hojaActiva->setCellValue('B'.$fila, $juguete['descripcion']);
                $hojaActiva->setCellValue('C'.$fila, $juguete['precio']);
                $hojaActiva->setCellValue('D'.$fila, $juguete['stock']);
                $hojaActiva->setCellValue('E'.$fila, $juguete['edad_recomendada']);
                $hojaActiva->setCellValue('F'.$fila, $juguete['categoria_juguete']);
                $hojaActiva->setCellValue('G'.$fila, $juguete['marca_juguete']);
                $hojaActiva->setCellValue('H'.$fila, $juguete['cantidad_vendida']);
                $fila ++;
            }
        break;
        case 'ventasJuguete':
            $sql = "SELECT YEAR(p.fecha_pedido) AS anio, MONTHNAME(p.fecha_pedido) AS mes, SUM(dpj.cantidad * j.precio) AS ventas FROM pedido p JOIN detalle_pedido_juguete dpj ON p.id_pedido = dpj.id_pedido JOIN juguete j ON dpj.id_juguete = j.id_juguete GROUP BY YEAR(p.fecha_pedido), MONTHNAME(p.fecha_pedido) ORDER BY YEAR(p.fecha_pedido), MONTH(p.fecha_pedido)";
            $st = $sistema->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            
            $excel = new Spreadsheet();
            $hojaActiva = $excel->getActiveSheet();
            $hojaActiva->setTitle('Ventas juguete');

            $hojaActiva->getColumnDimension('A')->setWidth(20);
            $hojaActiva->setCellValue('A1', 'Anio');
            $hojaActiva->getColumnDimension('B')->setWidth(20);
            $hojaActiva->setCellValue('B1', 'Mes');
            $hojaActiva->getColumnDimension('C')->setWidth(20);
            $hojaActiva->setCellValue('C1', 'Ventas');

            $fila = 2;

            foreach ($data as $key => $jugueteVentas) {
                $hojaActiva->setCellValue('A'.$fila, $jugueteVentas['anio']);
                $hojaActiva->setCellValue('B'.$fila, $jugueteVentas['mes']);
                $hojaActiva->setCellValue('C'.$fila, $jugueteVentas['ventas']);
                $fila ++;
            }
        break;
        case 'ventasRopa':
            $sql = "SELECT YEAR(p.fecha_pedido) AS anio, MONTHNAME(p.fecha_pedido) AS mes, SUM(dpr.cantidad * r.precio) AS ventas FROM pedido p JOIN detalle_pedido_ropa dpr ON p.id_pedido = dpr.id_pedido JOIN ropa r ON dpr.id_ropa = r.id_ropa GROUP BY YEAR(p.fecha_pedido), MONTHNAME(p.fecha_pedido) ORDER BY YEAR(p.fecha_pedido), MONTH(p.fecha_pedido)";
            $st = $sistema->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            
            $excel = new Spreadsheet();
            $hojaActiva = $excel->getActiveSheet();
            $hojaActiva->setTitle('Ventas ropa');

            $hojaActiva->getColumnDimension('A')->setWidth(20);
            $hojaActiva->setCellValue('A1', 'Anio');
            $hojaActiva->getColumnDimension('B')->setWidth(20);
            $hojaActiva->setCellValue('B1', 'Mes');
            $hojaActiva->getColumnDimension('C')->setWidth(20);
            $hojaActiva->setCellValue('C1', 'Ventas');

            $fila = 2;

            foreach ($data as $key => $jugueteVentas) {
                $hojaActiva->setCellValue('A'.$fila, $jugueteVentas['anio']);
                $hojaActiva->setCellValue('B'.$fila, $jugueteVentas['mes']);
                $hojaActiva->setCellValue('C'.$fila, $jugueteVentas['ventas']);
                $fila ++;
            }
        break;
        case 'ventasCalzado':
            $sql = "SELECT YEAR(p.fecha_pedido) AS anio, MONTHNAME(p.fecha_pedido) AS mes, SUM(dpc.cantidad * c.precio) AS ventas FROM pedido p JOIN detalle_pedido_calzado dpc ON p.id_pedido = dpc.id_pedido JOIN calzado c ON dpc.id_calzado = c.id_calzado GROUP BY YEAR(p.fecha_pedido), MONTHNAME(p.fecha_pedido) ORDER BY YEAR(p.fecha_pedido), MONTH(p.fecha_pedido)";
            $st = $sistema->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            
            $excel = new Spreadsheet();
            $hojaActiva = $excel->getActiveSheet();
            $hojaActiva->setTitle('Ventas calzado');

            $hojaActiva->getColumnDimension('A')->setWidth(20);
            $hojaActiva->setCellValue('A1', 'Anio');
            $hojaActiva->getColumnDimension('B')->setWidth(20);
            $hojaActiva->setCellValue('B1', 'Mes');
            $hojaActiva->getColumnDimension('C')->setWidth(20);
            $hojaActiva->setCellValue('C1', 'Ventas');

            $fila = 2;

            foreach ($data as $key => $jugueteVentas) {
                $hojaActiva->setCellValue('A'.$fila, $jugueteVentas['anio']);
                $hojaActiva->setCellValue('B'.$fila, $jugueteVentas['mes']);
                $hojaActiva->setCellValue('C'.$fila, $jugueteVentas['ventas']);
                $fila ++;
            }
        break;
        default:
                $sistema->alert('danger', 'bi bi-exclamation-circle-fill', 'ERROR', 'No se pudo generar el excel');
            break;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="reporte.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
?>