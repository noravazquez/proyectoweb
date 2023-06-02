<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Calzado</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="calzado.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID Calzado</th>
						<th scope="col">Calzado</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Color</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Talla</th>
                        <th scope="col">Sucursal</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $calzado): ?>
						<tr>
							<td><?php echo $calzado['id_calzado']; ?></td>
							<td><?php echo $calzado['calzado']; ?></td>
                            <td><?php echo $calzado['descripcion']; ?></td>
                            <td><?php echo $calzado['precio']; ?></td>
                            <td><?php echo $calzado['stock']; ?></td>
                            <td><?php echo ($calzado['estado'] == 1) ? 'Nuevo' : 'Seminuevo'; ?></td>
                            <td><?php echo $calzado['color']; ?></td>
                            <td><img src="<?php echo $calzado['imagen']; ?>" alt="" width="80%"></td>
                            <td><?php echo $calzado['categoria_calzado']; ?></td>
                            <td><?php echo $calzado['marca_calzado']; ?></td>
                            <td><?php echo $calzado['talla_calzado']; ?></td>
                            <td><?php echo $calzado['sucursal']; ?></td>
							<td>
								<a href="calzado.php?action=edit&id=<?php echo $calzado['id_calzado']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="calzado.php?action=delete&id=<?php echo $calzado['id_calzado']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> calzados.</div>
			</div>
		</div>
	</div>        
</div>