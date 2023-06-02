<header>
    <div class="container-fluid px-lg-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            <div class="container d-flex justify-content-center">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mb-3">
                        <a class="navbar-brand" href="#">
                            <img id="logo" src="/picco/admin/images/logo2.png" alt="Logo" draggable="false" height="50"/>
                        </a>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="login.php?action=logout" style="font-size: 15px;"> <i class="bi bi-box-arrow-in-left" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>Logout</a></li>
                        </ul>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link mx-2" href="index_admin.php" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';"><i class="bi bi-house-fill"></i> Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-2" href="proveedor.php" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Proveedor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-2" href="sucursal.php" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Sucursal</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link mx-2 dropdown-toggle" href="calzado.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Calzado</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="calzado.php">Calzado</a></li>
                                        <li><a class="dropdown-item" href="categoria_calzado.php">Categoria</a></li>
                                        <li><a class="dropdown-item" href="marca_calzado.php">Marca</a></li>
                                        <li><a class="dropdown-item" href="talla_calzado.php">Talla</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link mx-2 dropdown-toggle" href="juguete.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Juguete</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="juguete.php">Juguete</a></li>
                                        <li><a class="dropdown-item" href="categoria_juguete.php">Categoria</a></li>
                                        <li><a class="dropdown-item" href="marca_juguete.php">Marca</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link mx-2 dropdown-toggle" href="ropa.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Ropa</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="ropa.php">Ropa</a></li>
                                        <li><a class="dropdown-item" href="categoria_ropa.php">Categoria</a></li>
                                        <li><a class="dropdown-item" href="marca_ropa.php">Marca</a></li>
                                        <li><a class="dropdown-item" href="talla_ropa.php">Talla</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Comentarios</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="comentario_juguete.php">Juguete</a></li>
                                        <li><a class="dropdown-item" href="comentario_calzado.php">Calzado</a></li>
                                        <li><a class="dropdown-item" href="comentario_ropa.php">Ropa</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link mx-2 dropdown-toggle" href="usuario.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Usuarios</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="usuario.php">Usuario</a></li>
                                        <li><a class="dropdown-item" href="rol.php">Rol</a></li>
                                        <li><a class="dropdown-item" href="privilegio.php">Privilegio</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
                                        <li><a class="dropdown-item" href="cliente.php">Cliente</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link mx-2 dropdown-toggle" href="pago.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Pagos</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="metodo_pago.php">Metodo pago</a></li>
                                        <li><a class="dropdown-item" href="pago.php">Pago</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                <a class="nav-link mx-2 dropdown-toggle" href="pedido.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" onmouseover="this.style.backgroundColor='#494949'; this.style.textTransform='uppercase';" onmouseout="this.style.backgroundColor=''; this.style.textTransform='';">Pedidos</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="pedido.php">Pedido</a></li>
                                        <li><a class="dropdown-item" href="detalle_pedido_juguete.php">Detalle pedido juguete</a></li>
                                        <li><a class="dropdown-item" href="detalle_pedido_ropa.php">Detalle pedido ropa</a></li>
                                        <li><a class="dropdown-item" href="detalle_pedido_calzado.php">Detalle pedido calzado</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>