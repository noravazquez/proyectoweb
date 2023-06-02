<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://blog.softexpert.com/wp-content/uploads/2019/04/gestion-proveedores.png'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>proveedor</h2>
                    <form method="POST" action="proveedor.php?action=<?php echo $action; ?>">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[proveedor]" class="form-control" value="<?php echo isset($data[0]['proveedor']) ? $data[0]['proveedor'] : ''; ?>" required minlength="3" maxlength="50"/>
                                <label class="form-label">Proveedor</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[RFC]" class="form-control" value="<?php echo isset($data[0]['RFC']) ? $data[0]['RFC'] : ''; ?>" required minlength="12" maxlength="13"/>
                                <label class="form-label">RFC</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="tel" name="data[telefono]" class="form-control" value="<?php echo isset($data[0]['telefono']) ? $data[0]['telefono'] : ''; ?>" required minlength="10" maxlength="10"/>
                                <label class="form-label">Teléfono</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="email" name="data[correo]" class="form-control" value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>" required minlength="3" maxlength="100"/>
                                <label class="form-label">Correo electrónico</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_proveedor]" value="<?php echo isset($data[0]['id_proveedor']) ? $data[0]['id_proveedor'] : ''; ?>">
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