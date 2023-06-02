<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Detalle pedido ropa</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="detalle_pedido_ropa.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-1">ID Pedido</th>
						<th scope="col" class="col-md-3">ID Ropa</th>
                        <th scope="col" class="col-md-4">Ropa</th>
						<th scope="col" class="col-md-2">Cantidad</th>
						<th scope="col" class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $detalle_pedido_ropa): ?>
						<tr>
							<td><?php echo $detalle_pedido_ropa['id_pedido']; ?></td>
							<td><?php echo $detalle_pedido_ropa['id_ropa']; ?></td>
							<td><?php echo $detalle_pedido_ropa['ropa']; ?></td>
							<td><?php echo $detalle_pedido_ropa['cantidad']; ?></td>
							<td>
								<a href="detalle_pedido_ropa.php?action=edit&id_pedido=<?php echo $detalle_pedido_ropa['id_pedido']?>&id_ropa=<?php echo $detalle_pedido_ropa['id_ropa'] ?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="detalle_pedido_ropa.php?action=delete&id_pedido=<?php echo $detalle_pedido_ropa['id_pedido']?>&id_ropa=<?php echo $detalle_pedido_ropa['id_ropa'] ?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> detalles de pedidos de ropa.</div>
			</div>
		</div>
	</div>        
</div>