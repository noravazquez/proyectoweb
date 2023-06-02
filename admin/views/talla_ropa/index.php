<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Tallas de ropa</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="talla_ropa.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-3">ID Talla</th>
						<th scope="col" class="col-md-5">Talla de ropa</th>
						<th scope="col" class="col-md-4">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $talla_ropa): ?>
						<tr>
							<td><?php echo $talla_ropa['id_talla_ropa']; ?></td>
							<td><?php echo $talla_ropa['talla_ropa']; ?></td>
							<td>
								<a href="talla_ropa.php?action=edit&id=<?php echo $talla_ropa['id_talla_ropa']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="talla_ropa.php?action=delete&id=<?php echo $talla_ropa['id_talla_ropa']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> tallas de ropa.</div>
			</div>
		</div>
	</div>        
</div>