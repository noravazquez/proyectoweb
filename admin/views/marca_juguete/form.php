<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://w.forfun.com/fetch/19/19f3dfbdcb82e9e6a20bb98e98755c84.jpeg?w=1200&r=0.5625'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nueva ' ?>marca de juguete</h2>
                    <form method="POST" action="marca_juguete.php?action=<?php echo $action; ?>">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <input type="text" name="data[marca_juguete]" class="form-control" value="<?php echo isset($data[0]['marca_juguete']) ? $data[0]['marca_juguete'] : ''; ?>" required minlength="3" maxlength="50"/>
                            <label class="form-label">Marca de juguete</label>
                        </div>

                        <div class="form-outline mb-4">
                            <select name="data[id_proveedor]" class="form-control" required>
                            <?php
                                foreach ($data_proveedor as $key => $proveedor): 
                                $selected = " ";
                                if ($proveedor['id_proveedor']==$data[0]['id_proveedor']):
                                    $selected = " selected";
                                endif;?>
                                <option value="<?php echo $proveedor['id_proveedor']; ?>" <?php echo $selected; ?>><?php echo $proveedor['proveedor']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <label class="form-label">Proveedor</label>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_marca_juguete]" value="<?php echo isset($data[0]['id_marca_juguete']) ? $data[0]['id_marca_juguete'] : ''; ?>">
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