<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://blog.softexpert.com/wp-content/uploads/2019/04/gestion-proveedores.png'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5">Agregar rol al usuario: <?php echo $data[0]['correo']; ?></h2>
                    <form method="POST" action="usuario.php?action=newrol&id=<?php echo($data[0]['id_usuario']); ?>">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <select name="data[id_rol]" class="form-control" required>
                                <?php
                                    foreach ($roles_disponibles as $key => $roles): 
                                    $selected = " ";
                                    if ($roles['id_rol']==$roles[0]['id_rol']):
                                        $selected = " selected";
                                    endif;?>
                                <option value="<?php echo $roles['id_rol']; ?>" <?php echo $selected; ?>><?php echo $roles['rol']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label class="form-label">Rol</label>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                        <input type="hidden" name="data[id_usuario]" value="<?php echo($data[0]['id_usuario']); ?>">
                            <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<br>