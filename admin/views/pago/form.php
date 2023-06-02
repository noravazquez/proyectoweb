<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://blog.softexpert.com/wp-content/uploads/2019/04/gestion-proveedores.png'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>pago</h2>
                    <form method="POST" action="pago.php?action=<?php echo $action; ?>">
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
                                    <select name="data[id_metodo_pago]" class="form-control" required>
                                        <?php
                                            foreach ($data_metodo_pago as $key => $metodo_pago): 
                                            $selected = " ";
                                            if ($metodo_pago['id_metodo_pago']==$data[0]['id_metodo_pago']):
                                                $selected = " selected";
                                            endif;?>
                                            <option value="<?php echo $metodo_pago['id_metodo_pago']; ?>" <?php echo $selected; ?>><?php echo $metodo_pago['metodo_pago']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                <label class="form-label">Metodo de pago</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="number" step="any" name="data[monto]" class="form-control" value="<?php echo isset($data[0]['monto']) ? $data[0]['monto'] : ''; ?>" required minlength="3" maxlength="12"/>
                                <label class="form-label">Monto</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[folio]" class="form-control" value="<?php echo isset($data[0]['folio']) ? $data[0]['folio'] : ''; ?>" required minlength="3" maxlength="10"/>
                                <label class="form-label">Folio</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_pedido_actual]" value="<?php echo isset($data[0]['id_pedido']) ? $data[0]['id_pedido'] : ''; ?>">
                                <input type="hidden" name="data[id_metodo_pago_actual]" value="<?php echo isset($data[0]['id_metodo_pago']) ? $data[0]['id_metodo_pago'] : ''; ?>">
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