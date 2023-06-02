<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://www.expofranquicias.com.pe/wp-content/uploads/2023/02/franquicias-internacionales-1536x945.jpg'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nueva ' ?>sucursal</h2>
                    <form method="POST" action="sucursal.php?action=<?php echo $action; ?>">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <input type="text" name="data[sucursal]" class="form-control" value="<?php echo isset($data[0]['sucursal']) ? $data[0]['sucursal'] : ''; ?>" required minlength="3" maxlength="20"/>
                            <label class="form-label">Sucursal</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" name="data[direccion]" class="form-control" value="<?php echo isset($data[0]['direccion']) ? $data[0]['direccion'] : ''; ?>" required minlength="3" maxlength="100"/>
                            <label class="form-label">Dirección</label>
                        </div>
                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_sucursal]" value="<?php echo isset($data[0]['id_sucursal']) ? $data[0]['id_sucursal'] : ''; ?>">
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