<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://w.forfun.com/fetch/18/185658a1ff587eb691a692e44e70c26b.jpeg?w=1200&r=0.5625'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>pedido</h2>
                    <form class="container-fluid" method="POST" action="pedido.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <select name="data[id_cliente]" class="form-control" required>
                                <?php
                                    foreach ($data_cliente as $key => $cliente): 
                                    $selected = " ";
                                    if ($cliente['id_cliente']==$data[0]['id_cliente']):
                                        $selected = " selected";
                                    endif;?>
                                    <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo $selected; ?>><?php echo $cliente['nombre']; ?> <?php echo $cliente['apellido_paterno']; ?> <?php echo $cliente['apellido_materno']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label class="form-label">Cliente</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="date" name="data[fecha_pedido]" class="form-control" value="<?php echo isset($data[0]['fecha_pedido']) ? $data[0]['fecha_pedido'] : ''; ?>" required />
                                <label class="form-label">Fecha del pedido</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="date" name="data[fecha_entrega]" class="form-control" value="<?php echo isset($data[0]['fecha_entrega']) ? $data[0]['fecha_entrega'] : ''; ?>" required />
                                <label class="form-label">Fecha de entrega</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="checkbox" name="pagado" value="1" <?php if (!empty($data) && $data[0]['pagado'] == 1) echo "checked"; ?>/>
                                <label class="form-label">Pagado</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="checkbox" name="entregado" value="1" <?php if (!empty($data) && $data[0]['entregado'] == 1) echo "checked"; ?>/>
                                <label class="form-label">Entregado</label>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-outline mb-4">
                            <input type="text" name="data[direccion_entrega]" class="form-control" value="<?php echo isset($data[0]['direccion_entrega']) ? $data[0]['direccion_entrega'] : ''; ?>" required minlength="3" maxlength="100"/>
                            <label class="form-label">Direccion de entrega</label>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_pedido]" value="<?php echo isset($data[0]['id_pedido']) ? $data[0]['id_pedido'] : ''; ?>">
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