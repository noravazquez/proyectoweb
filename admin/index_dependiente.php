<?php include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Dependiente');
      require_once (__DIR__."/controllers/calzado.php");
      require_once (__DIR__."/controllers/ropa.php");
      require_once (__DIR__."/controllers/juguete.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css"> 
    <style>
      .my-container {
        margin: 15px; /* Ajusta el valor según tus necesidades */
      }
      .panel-default >.panel-heading{
        background-color: #f5f5f5;
        border-bottom: 2px solid #3498DB;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 15px;
      }
    </style> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawCharts);

      function drawCharts() {
        // Obtener los datos desde la base de datos
        var dataFromCalzado = <?php echo json_encode($calzado->calzadoVendido()); ?>;
        var dataFromRopa = <?php echo json_encode($ropa->ropaVendida()); ?>;
        var dataFromJuguete = <?php echo json_encode($juguete->jugueteVendido()); ?>;
        
        // Crear un array para almacenar los datos de cada gráfico
        var chartDataCalzado = [['Calzado', 'Cantidad vendida']];
        var chartDataRopa = [['Ropa', 'Cantidad vendida']];
        var chartDataJuguete = [['Juguete', 'Cantidad vendida']];
        
        // Recorrer los datos de la base de datos y agregarlos a los arrays de cada gráfico
        dataFromCalzado.forEach(function(item) {
          chartDataCalzado.push([item.nombre_calzado, parseInt(item.cantidad_vendida)]);
        });
        
        dataFromRopa.forEach(function(item) {
          chartDataRopa.push([item.nombre_ropa, parseInt(item.cantidad_vendida)]);
        });

        dataFromJuguete.forEach(function(item) {
          chartDataJuguete.push([item.nombre_juguete, parseInt(item.cantidad_vendida)]);
        });

        // Convertir los arrays en DataTables
        var dataCalzado = google.visualization.arrayToDataTable(chartDataCalzado);
        var dataRopa = google.visualization.arrayToDataTable(chartDataRopa);
        var dataJuguete = google.visualization.arrayToDataTable(chartDataJuguete);

        // Opciones y configuraciones de cada gráfico
        var optionsCalzado = {
          title: 'Calzado mas vendido',
          is3D: true,
        };

        var optionsRopa = {
          title: 'Ropa mas vendida',
          is3D: true,
        };

        var optionsJuguete = {
          title: 'Juguetes mas vendidos',
          is3D: true,
        };

        // Crear los gráficos y mostrarlos en los elementos correspondientes
        var chartCalzado = new google.visualization.PieChart(document.getElementById('piechart_calzado'));
        chartCalzado.draw(dataCalzado, optionsCalzado);

        var chartRopa = new google.visualization.PieChart(document.getElementById('piechart_ropa'));
        chartRopa.draw(dataRopa, optionsRopa);

        var chartJuguete = new google.visualization.PieChart(document.getElementById('piechart_juguete'));
        chartJuguete.draw(dataJuguete, optionsJuguete);
      }
    </script>
  </head>
  <body>
    <?php
        include_once('views/menu_dependiente.php'); 
    ?>
    <div class ="row my-container">
      <div id="piechart_calzado" class = "col-md-4" style="width: 400px; height: 300px;" ></div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Calzado más vendido</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Calzado</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $calzado->calzadoVendido(); foreach($data as $key => $calzadoMasVendido): ?>
                  <tr>
                    <td><?php echo $calzadoMasVendido['nombre_calzado']; ?></td>
                    <td><?php echo $calzadoMasVendido['cantidad_vendida']; ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
          <a class="btn btn-dark" href="reporte.php?action=calzado" target="_blank">Imprimir calzado vendido</a>
          <a class="btn btn-dark mt-2" href="excel.php?action=calzado" target="_blank">Excel calzado vendido</a>
      </div>
    </div>
    <div class ="row my-container">
      <div id="piechart_ropa" class = "col-md-4" style="width: 400px; height: 300px;"></div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Prendas más vendidas</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Prenda</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $ropa->ropaVendida(); foreach($data as $key => $ropaMasVendida): ?>
                  <tr>
                    <td><?php echo $ropaMasVendida['nombre_ropa']; ?></td>
                    <td><?php echo $ropaMasVendida['cantidad_vendida']; ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
          <a class="btn btn-dark" href="reporte.php?action=ropa" target="_blank">Imprimir ropa vendida</a>
          <a class="btn btn-dark mt-2" href="excel.php?action=ropa" target="_blank">Excel ropa vendida</a>
      </div>
    </div>
    <div class ="row my-container">
      <div id="piechart_juguete" class = "col-md-4" style="width: 400px; height: 300px;"></div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Juguetes más vendidos</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Juguete</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $juguete->jugueteVendido(); foreach($data as $key => $jugueteMasVendido): ?>
                  <tr>
                    <td><?php echo $jugueteMasVendido['nombre_juguete']; ?></td>
                    <td><?php echo $jugueteMasVendido['cantidad_vendida']; ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
          <a class="btn btn-dark" href="reporte.php?action=juguete" target="_blank">Imprimir juguete vendido</a>
          <a class="btn btn-dark mt-2" href="excel.php?action=juguete" target="_blank">Excel juguete vendido</a>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>