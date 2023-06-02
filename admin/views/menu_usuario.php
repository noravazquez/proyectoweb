<header>
    <nav>
      <div class="navbar-top">
        <div class="logo">
          <a class="navbar-brand" href="index_usuario.php">
            <img id="logo" src="/picco/admin/images/logo.png" alt="Logo" draggable="false" height="100"/>
          </a>
        </div>
        <div class="logout"> <!-- Aquí se debe aplicar la clase "logout" -->
          <ul> <!-- Quita la clase "navbar-nav" -->
            <li class="nav-item"><a class="nav-link" href="cart.php" style="font-size: 15px;"> <i class="bi bi-cart-fill" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>Cart</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php?action=logout" style="font-size: 15px;"> <i class="bi bi-box-arrow-in-left" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>Logout</a></li>
          </ul>
        </div>
      </div>

      <div class="navbar-bottom">
        <ul>
          <li><a href="index_usuario.php">Inicio</a></li>
          <li><a href="listCalzado.php">Calzado</a></li>
          <li><a href="listRopa.php">Ropa</a></li>
          <li><a href="listJuguete.php">Juguetes</a></li>
          <li><a href="comentarios.php">Comentarios</a></li>
          <li><a href="sucursales.php">¿Dónde nos ubicamos?</a></li>
        </ul>
      </div>
    </nav>
</header>