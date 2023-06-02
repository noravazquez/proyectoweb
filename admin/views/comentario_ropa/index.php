<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Comentario ropa</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="comentario_ropa.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID Comentario</th>
						<th scope="col">Comentario ropa</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Ropa</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $comentario_ropa): ?>
						<tr>
							<td><?php echo $comentario_ropa['id_comentario_ropa']; ?></td>
							<td><?php echo $comentario_ropa['comentario_ropa']; ?></td>
                            <td><?php echo $comentario_ropa['fecha_comentario']; ?></td>
                            <td><?php echo $comentario_ropa['nombre']; ?></td>
                            <td><?php echo $comentario_ropa['apellido_paterno']; ?></td>
                            <td><?php echo $comentario_ropa['apellido_materno']; ?></td>
                            <td><?php echo $comentario_ropa['correo']; ?></td>
                            <td><?php echo $comentario_ropa['ropa']; ?></td>
							<td>
								<a href="comentario_ropa.php?action=edit&id=<?php echo $comentario_ropa['id_comentario_ropa']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="comentario_ropa.php?action=delete&id=<?php echo $comentario_ropa['id_comentario_ropa']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
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