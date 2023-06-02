<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Privilegios</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="privilegio.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-3">ID Privilegio</th>
						<th scope="col" class="col-md-6">Privilegio</th>
						<th scope="col" class="col-md-3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $privilegio): ?>
						<tr>
							<td><?php echo $privilegio['id_privilegio']; ?></td>
							<td><?php echo $privilegio['privilegio']; ?></td>
							<td>
								<a href="privilegio.php?action=edit&id=<?php echo $privilegio['id_privilegio']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="privilegio.php?action=delete&id=<?php echo $privilegio['id_privilegio']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> privilegios.</div>
			</div>
		</div>
	</div>        
</div>