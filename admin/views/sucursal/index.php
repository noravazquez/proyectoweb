<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Sucursales</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="sucursal.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-2">ID Sucursal</th>
						<th scope="col" class="col-md-3">Sucursal</th>
						<th scope="col" class="col-md-4">Direccion</th>
						<th scope="col" class="col-md-3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $sucursal): ?>
						<tr>
							<td><?php echo $sucursal['id_sucursal']; ?></td>
							<td><?php echo $sucursal['sucursal']; ?></td>
							<td><?php echo $sucursal['direccion']; ?></td>
							<td>
								<a href="sucursal.php?action=edit&id=<?php echo $sucursal['id_sucursal']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="sucursal.php?action=delete&id=<?php echo $sucursal['id_sucursal']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> sucursales.</div>
			</div>
		</div>
	</div>        
</div>