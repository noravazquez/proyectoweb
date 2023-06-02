<?php include_once(__DIR__."/controllers/sistema.php"); 
      require_once (__DIR__."/controllers/pedido.php"); ?>
<h2>Pedido cancelado</h2>
<p>El pedido fue cancelado, vuelve a la página de compra dando clic <a href="http://localhost/picco/admin/index_usuario.php">aquí</a></p>
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