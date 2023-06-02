<div class="alert alert-<?php echo $tipo; ?> alert-dismissible fade show" role="alert">
    <strong>
        <i class="<?php echo $icono; ?>"></i>
        <?php echo str_repeat('&nbsp;', 4); // Inserta 4 espacios ?>
        <?php echo $titulo; ?>
    </strong>
    <?php echo str_repeat('&nbsp;', 4); // Inserta 4 espacios ?>
    <?php echo $mensaje; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>