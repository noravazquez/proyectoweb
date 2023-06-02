<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Pagos</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="pago.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-1">ID Pedido</th>
						<th scope="col" class="col-md-3">ID Metodo de pago</th>
                        <th scope="col" class="col-md-2">Metodo de pago</th>
						<th scope="col" class="col-md-2">Monto</th>
						<th scope="col" class="col-md-2">Folio</th>
						<th scope="col" class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $pago): ?>
						<tr>
							<td><?php echo $pago['id_pedido']; ?></td>
							<td><?php echo $pago['id_metodo_pago']; ?></td>
							<td><?php echo $pago['metodo_pago']; ?></td>
							<td><?php echo $pago['monto']; ?></td>
							<td><?php echo $pago['folio']; ?></td>
							<td>
								<a href="pago.php?action=edit&id_pedido=<?php echo $pago['id_pedido']?>&id_metodo_pago=<?php echo $pago['id_metodo_pago'] ?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="pago.php?action=delete&id_pedido=<?php echo $pago['id_pedido']?>&id_metodo_pago=<?php echo $pago['id_metodo_pago'] ?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> pagos.</div>
			</div>
		</div>
	</div>        
</div>