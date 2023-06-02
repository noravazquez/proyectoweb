<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://w.forfun.com/fetch/eb/eb88a703b6be0d2030bd52bfb2cbe3e6.jpeg?w=1200&r=0.5625'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nueva ' ?>categoria de calzado</h2>
                    <form method="POST" action="categoria_calzado.php?action=<?php echo $action; ?>">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <input type="text" name="data[categoria_calzado]" class="form-control" value="<?php echo isset($data[0]['categoria_calzado']) ? $data[0]['categoria_calzado'] : ''; ?>" required minlength="3" maxlength="50"/>
                            <label class="form-label">Categoria de calzado</label>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_categoria_calzado]" value="<?php echo isset($data[0]['id_categoria_calzado']) ? $data[0]['id_categoria_calzado'] : ''; ?>">
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