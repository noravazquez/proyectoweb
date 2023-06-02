<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Empleado</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="empleado.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID Empleado</th>
						<th scope="col">Nombre</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">RFC</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Correo</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $empleado): ?>
						<tr>
							<td><?php echo $empleado['id_empleado']; ?></td>
							<td><?php echo $empleado['nombre']; ?></td>
                            <td><?php echo $empleado['apellido_paterno']; ?></td>
                            <td><?php echo $empleado['apellido_materno']; ?></td>
                            <td><?php echo $empleado['RFC']; ?></td>
                            <td><?php echo $empleado['CURP']; ?></td>
                            <td><?php echo $empleado['direccion']; ?></td>
                            <td><?php echo $empleado['telefono']; ?></td>
                            <td><?php echo $empleado['fecha_nacimiento']; ?></td>
                            <td><?php echo $empleado['correo']; ?></td>
							<td>
								<a href="empleado.php?action=edit&id=<?php echo $empleado['id_empleado']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="empleado.php?action=delete&id=<?php echo $empleado['id_empleado']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> empleados.</div>
			</div>
		</div>
	</div>        
</div>