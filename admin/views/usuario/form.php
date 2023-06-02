<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://w.forfun.com/fetch/18/185658a1ff587eb691a692e44e70c26b.jpeg?w=1200&r=0.5625'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>usuario</h2>
                    <form class="container-fluid" method="POST" action="usuario.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="email" name="data[correo]" class="form-control" value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>" required minlength="3" maxlength="100"/>
                                <label class="form-label">Correo</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="password" name="data[contrasena]" class="form-control" value="<?php echo isset($data[0]['contrasena']) ? $data[0]['contrasena'] : ''; ?>" required minlength="1" maxlength="10"/>
                                <label class="form-label">Contraseña</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="file" class="form-control" name="imagen" />
                            <label class="form-label">Imagen</label>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_usuario]" value="<?php echo isset($data[0]['id_usuario']) ? $data[0]['id_usuario'] : ''; ?>">
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