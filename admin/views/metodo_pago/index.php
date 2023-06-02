<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Metodos de pago</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="metodo_pago.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-2">ID Metodo de pago</th>
						<th scope="col" class="col-md-4">Metodo de pago</th>
						<th scope="col" class="col-md-2">Estatus</th>
						<th scope="col" class="col-md-4">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $metodo_pago): ?>
						<tr>
							<td><?php echo $metodo_pago['id_metodo_pago']; ?></td>
							<td><?php echo $metodo_pago['metodo_pago']; ?></td>
							<td><?php echo ($metodo_pago['estatus'] == 1) ? 'Activo' : 'No activo'; ?></td>
							<td>
								<a href="metodo_pago.php?action=edit&id=<?php echo $metodo_pago['id_metodo_pago']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="metodo_pago.php?action=delete&id=<?php echo $metodo_pago['id_metodo_pago']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> metodos de pago.</div>
			</div>
		</div>
	</div>        
</div>