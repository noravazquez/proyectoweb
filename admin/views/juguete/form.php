<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://w.forfun.com/fetch/18/185658a1ff587eb691a692e44e70c26b.jpeg?w=1200&r=0.5625'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>juguete</h2>
                    <form class="container-fluid" method="POST" action="juguete.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <input type="text" name="data[juguete]" class="form-control" value="<?php echo isset($data[0]['juguete']) ? $data[0]['juguete'] : ''; ?>" required minlength="3" maxlength="100"/>
                            <label class="form-label">Juguete</label>
                        </div>

                        <div class="form-outline mb-4">
                            <textarea name="data[descripcion]" class="form-control" required><?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?></textarea>
                            <label class="form-label">Descripcion</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="number" step="any" name="data[precio]" class="form-control" value="<?php echo isset($data[0]['precio']) ? $data[0]['precio'] : ''; ?>" required minlength="3" maxlength="10"/>
                                <label class="form-label">Precio</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="number" step="1" name="data[stock]" class="form-control" value="<?php echo isset($data[0]['stock']) ? $data[0]['stock'] : ''; ?>" required minlength="1" maxlength="10"/>
                                <label class="form-label">Stock</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="checkbox" name="estado" value="1" <?php if (!empty($data) && $data[0]['estado'] == 1) echo "checked"; ?>/>
                                <label class="form-label">Nuevo</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="number" step="1" name="data[edad_recomendada]" class="form-control" value="<?php echo isset($data[0]['edad_recomendada']) ? $data[0]['edad_recomendada'] : ''; ?>" required minlength="1" maxlength="20"/>
                                <label class="form-label">Edad recomendada</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="file" class="form-control" name="imagen" />
                            <label class="form-label">Imagen</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <select name="data[id_categoria_juguete]" class="form-control" required>
                                <?php
                                    foreach ($data_categoria_juguete as $key => $categoria_juguete): 
                                    $selected = " ";
                                    if ($categoria_juguete['id_categoria_juguete']==$data[0]['id_categoria_juguete']):
                                        $selected = " selected";
                                    endif;?>
                                    <option value="<?php echo $categoria_juguete['id_categoria_juguete']; ?>" <?php echo $selected; ?>><?php echo $categoria_juguete['categoria_juguete']; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <label class="form-label">Categoria</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <select name="data[id_marca_juguete]" class="form-control" required>
                                <?php
                                    foreach ($data_marca_juguete as $key => $marca_juguete): 
                                    $selected = " ";
                                    if ($marca_juguete['id_marca_juguete']==$data[0]['id_marca_juguete']):
                                        $selected = " selected";
                                    endif;?>
                                    <option value="<?php echo $marca_juguete['id_marca_juguete']; ?>" <?php echo $selected; ?>><?php echo $marca_juguete['marca_juguete']; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <label class="form-label">Marca</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <select name="data[id_sucursal]" class="form-control" required>
                            <?php
                                foreach ($data_sucursal as $key => $sucursal): 
                                $selected = " ";
                                if ($sucursal['id_sucursal']==$data[0]['id_sucursal']):
                                    $selected = " selected";
                                endif;?>
                                <option value="<?php echo $sucursal['id_sucursal']; ?>" <?php echo $selected; ?>><?php echo $sucursal['sucursal']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <label class="form-label">Sucursal</label>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_juguete]" value="<?php echo isset($data[0]['id_juguete']) ? $data[0]['id_juguete'] : ''; ?>">
                            <?php endif; ?>
                            <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<br>