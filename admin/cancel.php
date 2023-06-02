<?php include_once(__DIR__."/controllers/sistema.php"); 
      require_once (__DIR__."/controllers/pedido.php"); ?>
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="background-color: #f8f8f8; padding: 20px; border-radius: 5px; text-align: center;">
        <h2 style="font-size: 24px; color: #333;">Pedido cancelado</h2>
        <p style="font-size: 16px; color: #666;">El pedido fue cancelado, vuelve a la página de compra dando clic <a href="http://localhost/picco/admin/index_usuario.php" style="color: #007bff;">aquí</a></p>

        <?php
        // Verificar si el pedido está almacenado en la variable de sesión
        if (isset($_SESSION['pedido'])) {
            // Obtener el ID del pedido almacenado en la variable de sesión
            $idPedido = $_SESSION['pedido'];

            // Eliminar el pedido utilizando la función correspondiente de tu sistema
            // Supongamos que la función se llama "eliminarPedido" en la clase "Pedido"
            $eliminado = $pedido->delete($idPedido);

            // Eliminar la variable de sesión del pedido
            unset($_SESSION['pedido']);
        }
        ?>
    </div>
</div>
