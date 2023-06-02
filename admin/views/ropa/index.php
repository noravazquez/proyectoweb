<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Ropa</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="ropa.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID Ropa</th>
						<th scope="col">Ropa</th>
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
					<?php foreach($data as $key => $ropa): ?>
						<tr>
							<td><?php echo $ropa['id_ropa']; ?></td>
							<td><?php echo $ropa['ropa']; ?></td>
                            <td><?php echo $ropa['descripcion']; ?></td>
                            <td><?php echo $ropa['precio']; ?></td>
                            <td><?php echo $ropa['stock']; ?></td>
                            <td><?php echo ($ropa['estado'] == 1) ? 'Nuevo' : 'Seminuevo'; ?></td>
                            <td><?php echo $ropa['color']; ?></td>
                            <td><img src="<?php echo $ropa['imagen']; ?>" alt="" width="80%"></td>
                            <td><?php echo $ropa['categoria_ropa']; ?></td>
                            <td><?php echo $ropa['marca_ropa']; ?></td>
                            <td><?php echo $ropa['talla_ropa']; ?></td>
                            <td><?php echo $ropa['sucursal']; ?></td>
							<td>
								<a href="ropa.php?action=edit&id=<?php echo $ropa['id_ropa']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="ropa.php?action=delete&id=<?php echo $ropa['id_ropa']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> de ropa.</div>
			</div>
		</div>
	</div>        
</div>