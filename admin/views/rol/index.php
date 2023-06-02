<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Roles</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="rol.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-3">ID Rol</th>
						<th scope="col" class="col-md-6">Rol</th>
						<th scope="col" class="col-md-3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $rol): ?>
						<tr>
							<td><?php echo $rol['id_rol']; ?></td>
							<td><?php echo $rol['rol']; ?></td>
							<td>
								<a href="rol.php?action=edit&id=<?php echo $rol['id_rol']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="rol.php?action=delete&id=<?php echo $rol['id_rol']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
                                <a href="rol.php?action=privilegio&id=<?php echo $rol['id_rol']?>" class="icon" data-toggle="modal"><i class="bi bi-clipboard2-check-fill" data-toggle="tooltip" title="Privilegio"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> roles.</div>
			</div>
		</div>
	</div>        
</div>