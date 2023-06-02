<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Marcas de ropa</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="marca_ropa.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-2">ID Marca</th>
						<th scope="col" class="col-md-4">Marca de ropa</th>
                        <th scope="col" class="col-md-4">Proveedor</th>
						<th scope="col" class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $marca_ropa): ?>
						<tr>
							<td><?php echo $marca_ropa['id_marca_ropa']; ?></td>
							<td><?php echo $marca_ropa['marca_ropa']; ?></td>
                            <td><?php echo $marca_ropa['proveedor']; ?></td>
							<td>
								<a href="marca_ropa.php?action=edit&id=<?php echo $marca_ropa['id_marca_ropa']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="marca_ropa.php?action=delete&id=<?php echo $marca_ropa['id_marca_ropa']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> marcas de ropa.</div>
			</div>
		</div>
	</div>        
</div>