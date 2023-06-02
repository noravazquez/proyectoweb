<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Comentario calzado</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="comentario_calzado.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID Comentario</th>
						<th scope="col">Comentario calzado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Calzado</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $comentario_calzado): ?>
						<tr>
							<td><?php echo $comentario_calzado['id_comentario_calzado']; ?></td>
							<td><?php echo $comentario_calzado['comentario_calzado']; ?></td>
                            <td><?php echo $comentario_calzado['fecha_comentario']; ?></td>
                            <td><?php echo $comentario_calzado['nombre']; ?></td>
                            <td><?php echo $comentario_calzado['apellido_paterno']; ?></td>
                            <td><?php echo $comentario_calzado['apellido_materno']; ?></td>
                            <td><?php echo $comentario_calzado['correo']; ?></td>
                            <td><?php echo $comentario_calzado['calzado']; ?></td>
							<td>
								<a href="comentario_calzado.php?action=edit&id=<?php echo $comentario_calzado['id_comentario_calzado']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="comentario_calzado.php?action=delete&id=<?php echo $comentario_calzado['id_comentario_calzado']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> comentarios.</div>
			</div>
		</div>
	</div>        
</div>