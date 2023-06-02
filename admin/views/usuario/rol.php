<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Roles del usuario: <?php echo $data[0]['correo']; ?></b></h2>
					</div>
					<div class="col-sm-6">
						<a href="usuario.php?action=newrol&id=<?php echo $data[0]['id_usuario']; ?>" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th scope="col" class="col-md-2">ID Usuario</th>
                        <th scope="col" class="col-md-3">Correo</th>
                        <th scope="col" class="col-md-2">ID Rol</th>
                        <th scope="col" class="col-md-3">Rol</th>
						<th scope="col" class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($data_rol as $key => $rol_usuario): ?>
                        <tr>
                            <th scope="row"><?php echo $rol_usuario['id_usuario']; ?></th>
                            <td><?php echo $rol_usuario['correo']; ?></td>
                            <td><?php echo $rol_usuario['id_rol']; ?></td>
                            <td><?php echo $rol_usuario['rol']; ?></td>
							<td>
								<a href="usuario.php?action=deleterol&id=<?php echo $data[0]["id_usuario"]; ?>&id_rol=<?php echo $rol_usuario["id_rol"];?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data_rol); ?></b> roles.</div>
			</div>
		</div>
	</div>        
</div>