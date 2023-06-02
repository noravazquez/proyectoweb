<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Proveedores</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="proveedor.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-1">ID Proveedor</th>
						<th scope="col" class="col-md-3">Proveedor</th>
						<th scope="col" class="col-md-2">RFC</th>
						<th scope="col" class="col-md-2">Teléfono</th>
						<th scope="col" class="col-md-2">Correo</th>
						<th scope="col" class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $proveedor): ?>
						<tr>
							<td><?php echo $proveedor['id_proveedor']; ?></td>
							<td><?php echo $proveedor['proveedor']; ?></td>
							<td><?php echo $proveedor['RFC']; ?></td>
							<td><?php echo $proveedor['telefono']; ?></td>
							<td><?php echo $proveedor['correo']; ?></td>
							<td>
								<a href="proveedor.php?action=edit&id=<?php echo $proveedor['id_proveedor']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="proveedor.php?action=delete&id=<?php echo $proveedor['id_proveedor']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> proveedores.</div>
			</div>
		</div>
	</div>        
</div>