<section class="vh-100" style="background-color: #B6E2D3;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://img.freepik.com/free-vector/secure-login-concept-illustration_114360-4685.jpg?w=740&t=st=1685338673~exp=1685339273~hmac=2a85d08c7627a8ce31f7fa8361166f72986eee42e1e40b1568293621f6e8e35e"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="POST" action="login.php?action=reset">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h2 fw-bold mb-0" style = "color: #FEEDAA">PiccoliGlam & Piccolino's </span>
                  </div>

                  <h6 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Reset password</h6>

                  <div class="form-outline mb-4">
                  <input type="password" id="form1Example13" name="contrasena" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Nueva contraseña</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <input type="hidden" name="correo" value="<?php echo $data['correo']; ?>"/>
                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>"/>
                    <input type="submit" name="enviar" value="Reset password" class="btn btn-dark">
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>