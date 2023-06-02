<?php
    require_once(__DIR__.'/controllers/sistema.php');
    require_once ('../vendor/autoload.php');
    use Spipu\Html2Pdf\Html2Pdf;
    $html2pdf = new Html2Pdf();

    $action = (isset($_GET['action'])) ? $_GET['action'] : null;
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

    $sistema->db();

    switch ($action) {
        case 'ropa':
          $sql = "SELECT r.ropa, r.descripcion, r.precio, r.stock, r.color, r.imagen, cr.categoria_ropa, mr.marca_ropa, tr.talla_ropa, SUM(dpr.cantidad) AS cantidad_vendida FROM ropa r INNER JOIN categoria_ropa cr ON r.id_categoria_ropa = cr.id_categoria_ropa INNER JOIN talla_ropa tr ON r.id_talla_ropa = tr.id_talla_ropa INNER JOIN marca_ropa mr ON r.id_marca_ropa = mr.id_marca_ropa INNER JOIN detalle_pedido_ropa dpr ON r.id_ropa = dpr.id_ropa GROUP BY r.ropa ORDER BY cantidad_vendida DESC";
          $st = $sistema->db->prepare($sql);
          $st->execute();
          $data = $st->fetchAll(PDO::FETCH_ASSOC);
          $idUsuario = $_SESSION['id_usuario'];
          $sql = 'SELECT * FROM empleado e INNER JOIN usuario u ON e.id_usuario = u.id_usuario WHERE e.id_usuario = :id_usuario';
          $st = $sistema->db->prepare($sql);
          $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
          $st->execute();
          $data2 = $st->fetchAll(PDO::FETCH_ASSOC);
          $fecha = date('d/m/Y');
          $html="
          <div style='display: flex;'>
            <div style='float: left; margin-right: 30px;'>
              <img src='images/logo.png' alt='Imagen' width='200'>
            </div>
            <div style='text-align: right;'>
              <p style='margin: 0;'>Reporte generado por: </p>
              <h4 style='margin: 0;'>Nombre: ".$data2[0]['nombre']." ".$data2[0]['apellido_paterno']." ".$data2[0]['apellido_materno']."</h4>
              <h4 style='margin: 0;'>Correo: ".$data2[0]['correo']."</h4>
              <p style='margin: 0;'>Fecha: ".$fecha."</p>
            </div>
          </div>
          <h3 style='text-align: center; color: #616D69;'>Reporte de ropa vendida</h3>
          <table style='border-collapse: collapse;'>
            <thead>
              <tr style='background-color: #FEEDAA;'>
                <th style='border: 1px solid black; padding: 10px;'>Ropa</th>
                <th style='border: 1px solid black; padding: 10px;'>Precio</th>
                <th style='border: 1px solid black; padding: 10px;'>Stock</th>
                <th style='border: 1px solid black; padding: 10px;'>Color</th>
                <th style='border: 1px solid black; padding: 10px;'>Imagen</th>
                <th style='border: 1px solid black; padding: 10px;'>Cantidad Vendida</th>
              </tr>
            </thead>
            <tbody>";
            foreach($data as $key => $ropa):
            $html.=
              "<tr>
                <td style='border: 1px solid black; padding: 10px;'>".$ropa['ropa']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ropa['precio']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ropa['stock']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ropa['color']."</td>
                <td style='border: 1px solid black; padding: 10px;'><img src='".$ropa['imagen']."' alt='Imagen' width='200'></td>
                <td style='border: 1px solid black; padding: 10px;'>".$ropa['cantidad_vendida']."</td>
              </tr>";
            endforeach;
            $html.="</tbody>
          </table>";
        break;
        case 'calzado':
          $sql = "SELECT c.calzado, c.descripcion, c.precio, c.stock, c.color, c.imagen, cc.categoria_calzado, mc.marca_calzado, tc.talla_calzado, SUM(dpc.cantidad) AS cantidad_vendida FROM calzado c INNER JOIN categoria_calzado cc ON c.id_categoria_calzado = cc.id_categoria_calzado INNER JOIN talla_calzado tc ON c.id_talla_calzado = tc.id_talla_calzado INNER JOIN marca_calzado mc ON c.id_marca_calzado = mc.id_marca_calzado INNER JOIN detalle_pedido_calzado dpc ON c.id_calzado = dpc.id_calzado GROUP BY c.calzado ORDER BY cantidad_vendida DESC";
          $st = $sistema->db->prepare($sql);
          $st->execute();
          $data = $st->fetchAll(PDO::FETCH_ASSOC);
          $idUsuario = $_SESSION['id_usuario'];
          $sql = 'SELECT * FROM empleado e INNER JOIN usuario u ON e.id_usuario = u.id_usuario WHERE e.id_usuario = :id_usuario';
          $st = $sistema->db->prepare($sql);
          $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
          $st->execute();
          $data2 = $st->fetchAll(PDO::FETCH_ASSOC);
          $fecha = date('d/m/Y');
          $html="
          <div style='display: flex;'>
            <div style='float: left; margin-right: 30px;'>
              <img src='images/logo.png' alt='Imagen' width='200'>
            </div>
            <div style='text-align: right;'>
              <p style='margin: 0;'>Reporte generado por: </p>
              <h4 style='margin: 0;'>Nombre: ".$data2[0]['nombre']." ".$data2[0]['apellido_paterno']." ".$data2[0]['apellido_materno']."</h4>
              <h4 style='margin: 0;'>Correo: ".$data2[0]['correo']."</h4>
              <p style='margin: 0;'>Fecha: ".$fecha."</p>
            </div>
          </div>
          <h3 style='text-align: center; color: #616D69;'>Reporte de calzado vendido</h3>
          <table style='border-collapse: collapse;'>
            <thead>
              <tr style='background-color: #FEEDAA;'>
                <th style='border: 1px solid black; padding: 10px;'>Calzado</th>
                <th style='border: 1px solid black; padding: 10px;'>Precio</th>
                <th style='border: 1px solid black; padding: 10px;'>Stock</th>
                <th style='border: 1px solid black; padding: 10px;'>Color</th>
                <th style='border: 1px solid black; padding: 10px;'>Imagen</th>
                <th style='border: 1px solid black; padding: 10px;'>Cantidad Vendida</th>
              </tr>
            </thead>
            <tbody>";
            foreach($data as $key => $calzado):
            $html.=
              "<tr>
                <td style='border: 1px solid black; padding: 10px;'>".$calzado['calzado']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$calzado['precio']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$calzado['stock']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$calzado['color']."</td>
                <td style='border: 1px solid black; padding: 10px;'><img src='".$calzado['imagen']."' alt='Imagen' width='200'></td>
                <td style='border: 1px solid black; padding: 10px;'>".$calzado['cantidad_vendida']."</td>
              </tr>";
            endforeach;
            $html.="</tbody>
          </table>";
        break;     
        case 'juguete':
          $sql = "SELECT j.juguete, j.descripcion, j.precio, j.stock, j.edad_recomendada, j.imagen, SUM(dpj.cantidad) AS cantidad_vendida FROM juguete j INNER JOIN categoria_juguete cj ON j.id_categoria_juguete = cj.id_categoria_juguete INNER JOIN marca_juguete mj ON j.id_marca_juguete = mj.id_marca_juguete INNER JOIN detalle_pedido_juguete dpj ON j.id_juguete = dpj.id_juguete GROUP BY j.id_juguete ORDER BY cantidad_vendida DESC";
          $st = $sistema->db->prepare($sql);
          $st->execute();
          $data = $st->fetchAll(PDO::FETCH_ASSOC);
          $idUsuario = $_SESSION['id_usuario'];
          $sql = 'SELECT * FROM empleado e INNER JOIN usuario u ON e.id_usuario = u.id_usuario WHERE e.id_usuario = :id_usuario';
          $st = $sistema->db->prepare($sql);
          $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
          $st->execute();
          $data2 = $st->fetchAll(PDO::FETCH_ASSOC);
          $fecha = date('d/m/Y');
          $html="
          <div style='display: flex;'>
            <div style='float: left; margin-right: 30px;'>
              <img src='images/logo.png' alt='Imagen' width='200'>
            </div>
            <div style='text-align: right;'>
              <p style='margin: 0;'>Reporte generado por: </p>
              <h4 style='margin: 0;'>Nombre: ".$data2[0]['nombre']." ".$data2[0]['apellido_paterno']." ".$data2[0]['apellido_materno']."</h4>
              <h4 style='margin: 0;'>Correo: ".$data2[0]['correo']."</h4>
              <p style='margin: 0;'>Fecha: ".$fecha."</p>
            </div>
          </div>
          <h3 style='text-align: center; color: #616D69;'>Reporte de juguete vendido</h3>
          <table style='border-collapse: collapse;'>
            <thead>
              <tr style='background-color: #FEEDAA;'>
                <th style='border: 1px solid black; padding: 10px;'>Juguete</th>
                <th style='border: 1px solid black; padding: 10px;'>Precio</th>
                <th style='border: 1px solid black; padding: 10px;'>Stock</th>
                <th style='border: 1px solid black; padding: 10px;'>Edad recomendada</th>
                <th style='border: 1px solid black; padding: 10px;'>Imagen</th>
                <th style='border: 1px solid black; padding: 10px;'>Cantidad Vendida</th>
              </tr>
            </thead>
            <tbody>";
            foreach($data as $key => $juguete):
            $html.=
              "<tr>
                <td style='border: 1px solid black; padding: 10px;'>".$juguete['juguete']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$juguete['precio']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$juguete['stock']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$juguete['edad_recomendada']."</td>
                <td style='border: 1px solid black; padding: 10px;'><img src='".$juguete['imagen']."' alt='Imagen' width='200'></td>
                <td style='border: 1px solid black; padding: 10px;'>".$juguete['cantidad_vendida']."</td>
              </tr>";
            endforeach;
            $html.="</tbody>
          </table>";
        break; 
        case 'ventasJuguete':
          $sql = "SELECT YEAR(p.fecha_pedido) AS anio, MONTHNAME(p.fecha_pedido) AS mes, SUM(dpj.cantidad * j.precio) AS ventas FROM pedido p JOIN detalle_pedido_juguete dpj ON p.id_pedido = dpj.id_pedido JOIN juguete j ON dpj.id_juguete = j.id_juguete GROUP BY YEAR(p.fecha_pedido), MONTHNAME(p.fecha_pedido) ORDER BY YEAR(p.fecha_pedido), MONTH(p.fecha_pedido)";
          $st = $sistema->db->prepare($sql);
          $st->execute();
          $data = $st->fetchAll(PDO::FETCH_ASSOC);
          $idUsuario = $_SESSION['id_usuario'];
          $sql = 'SELECT * FROM empleado e INNER JOIN usuario u ON e.id_usuario = u.id_usuario WHERE e.id_usuario = :id_usuario';
          $st = $sistema->db->prepare($sql);
          $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
          $st->execute();
          $data2 = $st->fetchAll(PDO::FETCH_ASSOC);
          $fecha = date('d/m/Y');
          $html="
          <div style='display: flex;'>
            <div style='float: left; margin-right: 30px;'>
              <img src='images/logo.png' alt='Imagen' width='200'>
            </div>
            <div style='text-align: right;'>
              <p style='margin: 0;'>Reporte generado por: </p>
              <h4 style='margin: 0;'>Nombre: ".$data2[0]['nombre']." ".$data2[0]['apellido_paterno']." ".$data2[0]['apellido_materno']."</h4>
              <h4 style='margin: 0;'>Correo: ".$data2[0]['correo']."</h4>
              <p style='margin: 0;'>Fecha: ".$fecha."</p>
            </div>
          </div>
          <h3 style='text-align: center; color: #616D69;'>Reporte ventas por mes del juguete</h3>
          <table style='border-collapse: collapse;'>
            <thead>
              <tr style='background-color: #FEEDAA;'>
                <th style='border: 1px solid black; padding: 10px;'>Año</th>
                <th style='border: 1px solid black; padding: 10px;'>Mes</th>
                <th style='border: 1px solid black; padding: 10px;'>Ventas</th>
              </tr>
            </thead>
            <tbody>";
            foreach($data as $key => $ventasJuguete):
            $html.=
              "<tr>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasJuguete['anio']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasJuguete['mes']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasJuguete['ventas']."</td>
              </tr>";
            endforeach;
            $html.="</tbody>
          </table>";
        break;
        case 'ventasRopa':
          $sql = "SELECT YEAR(p.fecha_pedido) AS anio, MONTHNAME(p.fecha_pedido) AS mes, SUM(dpr.cantidad * r.precio) AS ventas FROM pedido p JOIN detalle_pedido_ropa dpr ON p.id_pedido = dpr.id_pedido JOIN ropa r ON dpr.id_ropa = r.id_ropa GROUP BY YEAR(p.fecha_pedido), MONTHNAME(p.fecha_pedido) ORDER BY YEAR(p.fecha_pedido), MONTH(p.fecha_pedido)";
          $st = $sistema->db->prepare($sql);
          $st->execute();
          $data = $st->fetchAll(PDO::FETCH_ASSOC);
          $idUsuario = $_SESSION['id_usuario'];
          $sql = 'SELECT * FROM empleado e INNER JOIN usuario u ON e.id_usuario = u.id_usuario WHERE e.id_usuario = :id_usuario';
          $st = $sistema->db->prepare($sql);
          $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
          $st->execute();
          $data2 = $st->fetchAll(PDO::FETCH_ASSOC);
          $fecha = date('d/m/Y');
          $html="
          <div style='display: flex;'>
            <div style='float: left; margin-right: 30px;'>
              <img src='images/logo.png' alt='Imagen' width='200'>
            </div>
            <div style='text-align: right;'>
              <p style='margin: 0;'>Reporte generado por: </p>
              <h4 style='margin: 0;'>Nombre: ".$data2[0]['nombre']." ".$data2[0]['apellido_paterno']." ".$data2[0]['apellido_materno']."</h4>
              <h4 style='margin: 0;'>Correo: ".$data2[0]['correo']."</h4>
              <p style='margin: 0;'>Fecha: ".$fecha."</p>
            </div>
          </div>
          <h3 style='text-align: center; color: #616D69;'>Reporte ventas por mes de la ropa</h3>
          <table style='border-collapse: collapse;'>
            <thead>
              <tr style='background-color: #FEEDAA;'>
                <th style='border: 1px solid black; padding: 10px;'>Año</th>
                <th style='border: 1px solid black; padding: 10px;'>Mes</th>
                <th style='border: 1px solid black; padding: 10px;'>Ventas</th>
              </tr>
            </thead>
            <tbody>";
            foreach($data as $key => $ventasJuguete):
            $html.=
              "<tr>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasJuguete['anio']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasJuguete['mes']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasJuguete['ventas']."</td>
              </tr>";
            endforeach;
            $html.="</tbody>
          </table>";
        break;
        case 'ventasCalzado':
          $sql = "SELECT YEAR(p.fecha_pedido) AS anio, MONTHNAME(p.fecha_pedido) AS mes, SUM(dpc.cantidad * c.precio) AS ventas FROM pedido p JOIN detalle_pedido_calzado dpc ON p.id_pedido = dpc.id_pedido JOIN calzado c ON dpc.id_calzado = c.id_calzado GROUP BY YEAR(p.fecha_pedido), MONTHNAME(p.fecha_pedido) ORDER BY YEAR(p.fecha_pedido), MONTH(p.fecha_pedido)";
          $st = $sistema->db->prepare($sql);
          $st->execute();
          $data = $st->fetchAll(PDO::FETCH_ASSOC);
          $idUsuario = $_SESSION['id_usuario'];
          $sql = 'SELECT * FROM empleado e INNER JOIN usuario u ON e.id_usuario = u.id_usuario WHERE e.id_usuario = :id_usuario';
          $st = $sistema->db->prepare($sql);
          $st->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
          $st->execute();
          $data2 = $st->fetchAll(PDO::FETCH_ASSOC);
          $fecha = date('d/m/Y');
          $html="
          <div style='display: flex;'>
            <div style='float: left; margin-right: 30px;'>
              <img src='images/logo.png' alt='Imagen' width='200'>
            </div>
            <div style='text-align: right;'>
              <p style='margin: 0;'>Reporte generado por: </p>
              <h4 style='margin: 0;'>Nombre: ".$data2[0]['nombre']." ".$data2[0]['apellido_paterno']." ".$data2[0]['apellido_materno']."</h4>
              <h4 style='margin: 0;'>Correo: ".$data2[0]['correo']."</h4>
              <p style='margin: 0;'>Fecha: ".$fecha."</p>
            </div>
          </div>
          <h3 style='text-align: center; color: #616D69;'>Reporte ventas por mes del calzado</h3>
          <table style='border-collapse: collapse;'>
            <thead>
              <tr style='background-color: #FEEDAA;'>
                <th style='border: 1px solid black; padding: 10px;'>Año</th>
                <th style='border: 1px solid black; padding: 10px;'>Mes</th>
                <th style='border: 1px solid black; padding: 10px;'>Ventas</th>
              </tr>
            </thead>
            <tbody>";
            foreach($data as $key => $ventasCalzado):
            $html.=
              "<tr>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasCalzado['anio']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasCalzado['mes']."</td>
                <td style='border: 1px solid black; padding: 10px;'>".$ventasCalzado['ventas']."</td>
              </tr>";
            endforeach;
            $html.="</tbody>
          </table>";
        break;
        default:
          $html='<h1>Sin reporte</h1>No hay ningun reporte para generar';
        break;
    }
    $html2pdf->writeHTML($html);
    $html2pdf->output();
?>