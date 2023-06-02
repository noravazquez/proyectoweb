<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Tallas de calzado</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="talla_calzado.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-3">ID Talla</th>
						<th scope="col" class="col-md-5">Talla de calzado</th>
						<th scope="col" class="col-md-4">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $talla_calzado): ?>
						<tr>
							<td><?php echo $talla_calzado['id_talla_calzado']; ?></td>
							<td><?php echo $talla_calzado['talla_calzado']; ?></td>
							<td>
								<a href="talla_calzado.php?action=edit&id=<?php echo $talla_calzado['id_talla_calzado']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="talla_calzado.php?action=delete&id=<?php echo $talla_calzado['id_talla_calzado']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> tallas de calzado.</div>
			</div>
		</div>
	</div>        
</div>