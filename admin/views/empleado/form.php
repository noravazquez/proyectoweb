<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://w.forfun.com/fetch/18/185658a1ff587eb691a692e44e70c26b.jpeg?w=1200&r=0.5625'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>empleado</h2>
                    <form class="container-fluid" method="POST" action="empleado.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <input type="text" name="data[nombre]" class="form-control" value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>" required minlength="3" maxlength="30"/>
                            <label class="form-label">Nombre</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[apellido_paterno]" class="form-control" value="<?php echo isset($data[0]['apellido_paterno']) ? $data[0]['apellido_paterno'] : ''; ?>" required minlength="3" maxlength="20"/>
                                <label class="form-label">Apellido paterno</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[apellido_materno]" class="form-control" value="<?php echo isset($data[0]['apellido_materno']) ? $data[0]['apellido_materno'] : ''; ?>" minlength="3" maxlength="20"/>
                                <label class="form-label">Apellido materno</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[RFC]" class="form-control" value="<?php echo isset($data[0]['RFC']) ? $data[0]['RFC'] : ''; ?>" required minlength="12" maxlength="13"/>
                                <label class="form-label">RFC</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[CURP]" class="form-control" value="<?php echo isset($data[0]['CURP']) ? $data[0]['CURP'] : ''; ?>" required minlength="17" maxlength="18"/>
                                <label class="form-label">CURP</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[direccion]" class="form-control" value="<?php echo isset($data[0]['direccion']) ? $data[0]['direccion'] : ''; ?>" required minlength="3" maxlength="100"/>
                                <label class="form-label">Direccion</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="text" name="data[telefono]" class="form-control" value="<?php echo isset($data[0]['telefono']) ? $data[0]['telefono'] : ''; ?>" required minlength="10" maxlength="10"/>
                                <label class="form-label">Telefono</label>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <input type="date" name="data[fecha_nacimiento]" class="form-control" value="<?php echo isset($data[0]['fecha_nacimiento']) ? $data[0]['fecha_nacimiento'] : ''; ?>" required />
                                <label class="form-label">Fecha de nacimiento</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <select name="data[id_usuario]" class="form-control" required>
                                <?php
                                    foreach ($data_usuario as $key => $usuario): 
                                    $selected = " ";
                                    if ($usuario['id_usuario']==$data[0]['id_usuario']):
                                        $selected = " selected";
                                    endif;?>
                                    <option value="<?php echo $usuario['id_usuario']; ?>" <?php echo $selected; ?>><?php echo $usuario['correo']; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <label class="form-label">Correo</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_empleado]" value="<?php echo isset($data[0]['id_empleado']) ? $data[0]['id_empleado'] : ''; ?>">
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