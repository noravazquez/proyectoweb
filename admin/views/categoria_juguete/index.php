<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Categorias de juguetes</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="categoria_juguete.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="col-md-3">ID Categoria</th>
						<th scope="col" class="col-md-5">Categoria de juguete</th>
						<th scope="col" class="col-md-4">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $categoria_juguete): ?>
						<tr>
							<td><?php echo $categoria_juguete['id_categoria_juguete']; ?></td>
							<td><?php echo $categoria_juguete['categoria_juguete']; ?></td>
							<td>
								<a href="categoria_juguete.php?action=edit&id=<?php echo $categoria_juguete['id_categoria_juguete']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="categoria_juguete.php?action=delete&id=<?php echo $categoria_juguete['id_categoria_juguete']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> categorias de juguetes.</div>
			</div>
		</div>
	</div>        
</div>