<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Pedidos</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="pedido.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" >ID Pedido</th>
						<th scope="col" >Nombre</th>
                        <th scope="col" >Apellido paterno</th>
                        <th scope="col" >Apellido materno</th>
                        <th scope="col" >Fecha del pedido</th>
                        <th scope="col" >Fecha de entrega</th>
						<th scope="col" >Pagado</th>
                        <th scope="col" >Entregado</th>
                        <th scope="col" >Direccion de entrega</th>
						<th scope="col" >Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $pedido): ?>
						<tr>
							<td><?php echo $pedido['id_pedido']; ?></td>
							<td><?php echo $pedido['nombre']; ?></td>
                            <td><?php echo $pedido['apellido_paterno']; ?></td>
                            <td><?php echo $pedido['apellido_materno']; ?></td>
                            <td><?php echo $pedido['fecha_pedido']; ?></td>
                            <td><?php echo $pedido['fecha_entrega']; ?></td>
							<td><?php echo ($pedido['pagado'] == 1) ? 'Pagado' : 'No pagado'; ?></td>
                            <td><?php echo ($pedido['entregado'] == 1) ? 'Entregado' : 'No entregado'; ?></td>
                            <td><?php echo $pedido['direccion_entrega']; ?></td>
							<td>
								<a href="pedido.php?action=edit&id=<?php echo $pedido['id_pedido']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="pedido.php?action=delete&id=<?php echo $pedido['id_pedido']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> pedidos.</div>
			</div>
		</div>
	</div>        
</div>