<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://w.forfun.com/fetch/18/185658a1ff587eb691a692e44e70c26b.jpeg?w=1200&r=0.5625'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>calzado</h2>
                    <form class="container-fluid" method="POST" action="calzado.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <input type="text" name="data[calzado]" class="form-control" value="<?php echo isset($data[0]['calzado']) ? $data[0]['calzado'] : ''; ?>" required minlength="3" maxlength="100"/>
                            <label class="form-label">Calzado</label>
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
                                <input type="text" name="data[color]" class="form-control" value="<?php echo isset($data[0]['color']) ? $data[0]['color'] : ''; ?>" required minlength="1" maxlength="20"/>
                                <label class="form-label">Color</label>
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
                                <select name="data[id_categoria_calzado]" class="form-control" required>
                                <?php
                                    foreach ($data_categoria_calzado as $key => $categoria_calzado): 
                                    $selected = " ";
                                    if ($categoria_calzado['id_categoria_calzado']==$data[0]['id_categoria_calzado']):
                                        $selected = " selected";
                                    endif;?>
                                    <option value="<?php echo $categoria_calzado['id_categoria_calzado']; ?>" <?php echo $selected; ?>><?php echo $categoria_calzado['categoria_calzado']; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <label class="form-label">Categoria</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <select name="data[id_marca_calzado]" class="form-control" required>
                                <?php
                                    foreach ($data_marca_calzado as $key => $marca_calzado): 
                                    $selected = " ";
                                    if ($marca_calzado['id_marca_calzado']==$data[0]['id_marca_calzado']):
                                        $selected = " selected";
                                    endif;?>
                                    <option value="<?php echo $marca_calzado['id_marca_calzado']; ?>" <?php echo $selected; ?>><?php echo $marca_calzado['marca_calzado']; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <label class="form-label">Marca</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <select name="data[id_talla_calzado]" class="form-control" required>
                                <?php
                                    foreach ($data_talla_calzado as $key => $talla_calzado): 
                                    $selected = " ";
                                    if ($talla_calzado['id_talla_calzado']==$data[0]['id_talla_calzado']):
                                        $selected = " selected";
                                    endif;?>
                                    <option value="<?php echo $talla_calzado['id_talla_calzado']; ?>" <?php echo $selected; ?>><?php echo $talla_calzado['talla_calzado']; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <label class="form-label">Talla</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
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
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_calzado]" value="<?php echo isset($data[0]['id_calzado']) ? $data[0]['id_calzado'] : ''; ?>">
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