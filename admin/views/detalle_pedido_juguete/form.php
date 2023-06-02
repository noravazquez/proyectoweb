<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://blog.softexpert.com/wp-content/uploads/2019/04/gestion-proveedores.png'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>detalle de pedido de juguete</h2>
                    <form method="POST" action="detalle_pedido_juguete.php?action=<?php echo $action; ?>">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <select name="data[id_pedido]" class="form-control" required>
                                        <?php
                                            foreach ($data_pedido as $key => $pedido): 
                                            $selected = " ";
                                            if ($pedido['id_pedido']==$data[0]['id_pedido']):
                                                $selected = " selected";
                                            endif;?>
                                            <option value="<?php echo $pedido['id_pedido']; ?>" <?php echo $selected; ?>><?php echo $pedido['id_pedido']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                <label class="form-label">ID Pedido</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <select name="data[id_juguete]" class="form-control" required>
                                        <?php
                                            foreach ($data_juguete as $key => $juguete): 
                                            $selected = " ";
                                            if ($juguete['id_juguete']==$data[0]['id_juguete']):
                                                $selected = " selected";
                                            endif;?>
                                            <option value="<?php echo $juguete['id_juguete']; ?>" <?php echo $selected; ?>><?php echo $juguete['juguete']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                <label class="form-label">Juguete</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="number" step="1" name="data[cantidad]" class="form-control" value="<?php echo isset($data[0]['cantidad']) ? $data[0]['cantidad'] : ''; ?>" required minlength="3" maxlength="12"/>
                            <label class="form-label">Cantidad</label>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_pedido_actual]" value="<?php echo isset($data[0]['id_pedido']) ? $data[0]['id_pedido'] : ''; ?>">
                                <input type="hidden" name="data[id_juguete_actual]" value="<?php echo isset($data[0]['id_juguete']) ? $data[0]['id_juguete'] : ''; ?>">
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