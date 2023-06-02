<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Comentario juguete</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="comentario_juguete.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID Comentario</th>
						<th scope="col">Comentario juguete</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Juguete</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $comentario_juguete): ?>
						<tr>
							<td><?php echo $comentario_juguete['id_comentario_juguete']; ?></td>
							<td><?php echo $comentario_juguete['comentario_juguete']; ?></td>
                            <td><?php echo $comentario_juguete['fecha_comentario']; ?></td>
                            <td><?php echo $comentario_juguete['nombre']; ?></td>
                            <td><?php echo $comentario_juguete['apellido_paterno']; ?></td>
                            <td><?php echo $comentario_juguete['apellido_materno']; ?></td>
                            <td><?php echo $comentario_juguete['correo']; ?></td>
                            <td><?php echo $comentario_juguete['juguete']; ?></td>
							<td>
								<a href="comentario_juguete.php?action=edit&id=<?php echo $comentario_juguete['id_comentario_juguete']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="comentario_juguete.php?action=delete&id=<?php echo $comentario_juguete['id_comentario_juguete']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
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