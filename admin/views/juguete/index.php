<div class="container-xl mt-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Juguete</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="juguete.php?action=new" class="btn btn-success" data-toggle="modal"><i class="bi bi-plus-square-fill"></i></a>		
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID Juguete</th>
						<th scope="col">Juguete</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Edad recomendada</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Sucursal</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key => $juguete): ?>
						<tr>
							<td><?php echo $juguete['id_juguete']; ?></td>
							<td><?php echo $juguete['juguete']; ?></td>
                            <td><?php echo $juguete['descripcion']; ?></td>
                            <td><?php echo $juguete['precio']; ?></td>
                            <td><?php echo $juguete['stock']; ?></td>
                            <td><?php echo ($juguete['estado'] == 1) ? 'Nuevo' : 'Seminuevo'; ?></td>
                            <td><?php echo $juguete['edad_recomendada']; ?></td>
                            <td><img src="<?php echo $juguete['imagen']; ?>" alt="" width="80%"></td>
                            <td><?php echo $juguete['categoria_juguete']; ?></td>
                            <td><?php echo $juguete['marca_juguete']; ?></td>
                            <td><?php echo $juguete['sucursal']; ?></td>
							<td>
								<a href="juguete.php?action=edit&id=<?php echo $juguete['id_juguete']?>" class="edit" data-toggle="modal"><i class="bi bi-pencil-fill" data-toggle="tooltip" title="Edit"></i></a>
								<a href="juguete.php?action=delete&id=<?php echo $juguete['id_juguete']?>" class="delete" data-toggle="modal"><i class="bi bi-trash-fill" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Se encontraron <b><?php echo sizeof($data); ?></b> juguetes.</div>
			</div>
		</div>
	</div>        
</div>