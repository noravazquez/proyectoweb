<div style="display: flex; justify-content: center;">
  <form action="detalle_calzado.php" method="post" style="max-width: 500px;">
    <label for="comentario" style="margin-bottom: 5px;">Comentario: </label>
    <textarea id="comentario" name="data[comentario_calzado]" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 10px;"></textarea>

    <input href="detalle_calzado.php?id=<?php echo $data[0]['id_calzado']; ?>" type="submit" name="enviar" value="Guardar" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
    <input type="hidden" name="data[id_calzado]" value="<?php echo($data[0]['id_calzado']); ?>">
  </form>
</div>
