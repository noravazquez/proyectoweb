<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Privilegios del rol: <?php echo $data[0]['rol']; ?></b></h2>
					</div>
					<div class="col-sm-6">
						<a href="rol.php?action=newprivilegio&id=<?php echo $data[0]['id_rol']; ?>" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th scope="col" class="col-md-2">ID Rol</th>
                        <th scope="col" class="col-md-3">Rol</th>
                        <th scope="col" class="col-md-2">ID Privilegio</th>
                        <th scope="col" class="col-md-3">Privilegio</th>
						<th scope="col" class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_privilegio as $key => $rol_privilegio): ?>
						<tr>
							<td><?php echo $rol_privilegio['id_rol']; ?></td>
							<td><?php echo $rol_privilegio['rol']; ?></td>
                            <td><?php echo $rol_privilegio['id_privilegio']; ?></td>
                            <td><?php echo $rol_privilegio['privilegio']; ?></td>
							<td>
								<a href="rol.php?action=deleteprivilegio&id=<?php echo $data[0]["id_rol"]; ?>&id_privilegio=<?php echo $rol_privilegio["id_privilegio"];?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data_privilegio); ?></b> privilegios.</div>
			</div>
		</div>
	</div>        
</div>