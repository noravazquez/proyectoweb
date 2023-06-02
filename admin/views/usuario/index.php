<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Usuario</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="usuario.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-2">ID Usuario</th>
						<th scope="col" class="col-md-3">Correo</th>
                        <th scope="col" class="col-md-2">Contraseña</th>
                        <th scope="col" class="col-md-3">Imagen</th>
						<th scope="col" class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $usuario): ?>
						<tr>
							<td><?php echo $usuario['id_usuario']; ?></td>
							<td><?php echo $usuario['correo']; ?></td>
                            <td><?php echo $usuario['contrasena']; ?></td>
                            <td><img src="<?php echo $usuario['imagen']; ?>" alt="" width="80%"></td>
							<td>
								<a href="usuario.php?action=edit&id=<?php echo $usuario['id_usuario']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="usuario.php?action=delete&id=<?php echo $usuario['id_usuario']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
                                <a href="usuario.php?action=rol&id=<?php echo $usuario['id_usuario']?>" class="icon" data-toggle="modal"><i class="bi bi-person-rolodex" data-toggle="tooltip" title="Rol"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> usuarios.</div>
			</div>
		</div>
	</div>        
</div>