<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://w.forfun.com/fetch/18/185658a1ff587eb691a692e44e70c26b.jpeg?w=1200&r=0.5625'); height: 200px;"></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>comentario de ropa</h2>
                    <form class="container-fluid" method="POST" action="comentario_ropa.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <textarea name="data[comentario_ropa]" class="form-control" required><?php echo isset($data[0]['comentario_ropa']) ? $data[0]['comentario_ropa'] : ''; ?></textarea>
                            <label class="form-label">Comentario de ropa</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="date" name="data[fecha_comentario]" class="form-control" value="<?php echo isset($data[0]['fecha_comentario']) ? $data[0]['fecha_comentario'] : ''; ?>" required />
                            <label class="form-label">Fecha del comentario</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                <select name="data[id_ropa]" class="form-control" required>
                                <?php
                                    foreach ($data_ropa as $key => $ropa): 
                                    $selected = " ";
                                    if ($ropa['id_ropa']==$data[0]['id_ropa']):
                                        $selected = " selected";
                                    endif;?>
                                    <option value="<?php echo $ropa['id_ropa']; ?>" <?php echo $selected; ?>><?php echo $ropa['ropa']; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <label class="form-label">Ropa</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
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
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <?php if ($action == 'edit'): ?>
                                <input type="hidden" name="data[id_comentario_ropa]" value="<?php echo isset($data[0]['id_comentario_ropa']) ? $data[0]['id_comentario_ropa'] : ''; ?>">
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