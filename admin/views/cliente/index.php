<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Cliente</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="cliente.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID Cliente</th>
						<th scope="col">Nombre</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">RFC</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Correo</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $cliente): ?>
						<tr>
							<td><?php echo $cliente['id_cliente']; ?></td>
							<td><?php echo $cliente['nombre']; ?></td>
                            <td><?php echo $cliente['apellido_paterno']; ?></td>
                            <td><?php echo $cliente['apellido_materno']; ?></td>
                            <td><?php echo $cliente['RFC']; ?></td>
                            <td><?php echo $cliente['direccion']; ?></td>
                            <td><?php echo $cliente['telefono']; ?></td>
                            <td><?php echo $cliente['fecha_nacimiento']; ?></td>
                            <td><?php echo $cliente['correo']; ?></td>
							<td>
								<a href="cliente.php?action=edit&id=<?php echo $cliente['id_cliente']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="cliente.php?action=delete&id=<?php echo $cliente['id_cliente']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> clientes.</div>
			</div>
		</div>
	</div>        
</div>