<section class="vh-100" style="background-color: #B6E2D3;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://media.vogue.es/photos/606dbcec8381e111eecd2813/2:3/w_2560%2Cc_limit/07_MINI_MAYORAL.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="POST" action="login.php?action=login">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h2 fw-bold mb-0" style = "color: #FEEDAA">PiccoliGlam & Piccolino's </span>
                  </div>

                  <h6 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login</h6>

                  <div class="form-outline mb-4">
                    <input type="email" id="form2Example17" name="correo" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Correo electronico</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example27" name="contrasena" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Contraseña</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <input type="submit" name="enviar" value="Login" class="btn btn-dark">
                  </div>

                  <a class="mb-5 pb-lg-2" href="login.php?action=forgot" style="color: #616D69;">¿Olvidaste tu contraseña?</a>
                  <p class="mb-5 pb-lg-2" style="color: #616D69;">¿No tienes cuenta? <a href="login.php?action=register"style="color: #616D69;">Registrate aqui</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>