<section class="vh-100" style="background-color: #B6E2D3;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-12 col-lg-11 d-flex align-items-center">
              <div class="card-body p-4 p-lg-10 text-black">

                <form method="POST" action="login.php?action=register">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h2 fw-bold mb-0" style = "color: #FEEDAA">PiccoliGlam & Piccolino's </span>
                  </div>

                  <h6 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register</h6>

                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="data[nombre]" required minlength="3" maxlength="30"/>
                            <label class="form-label">Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="data[apellido_paterno]" required minlength="3" maxlength="20"/>
                            <label class="form-label">Apellido paterno</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="data[apellido_materno]" minlength="3" maxlength="20"/>
                            <label class="form-label">Apellido materno</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                            <input type="email" name="data[correo]" class="form-control form-control-lg" required minlength="3" maxlength="100"/>
                            <label class="form-label" >Correo electronico</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                            <input type="password" name="data[contrasena]" class="form-control form-control-lg" required minlength="1" maxlength="10"/>
                            <label class="form-label" >Contraseña</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="data[direccion]" required minlength="3" maxlength="100"/>
                            <label class="form-label">Direccion</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="data[telefono]" required minlength="10" maxlength="10"/>
                            <label class="form-label">Telefono</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="form-outline">
                            <input type="date" class="form-control form-control-lg" name="data[fecha_nacimiento]" required/>
                            <label class="form-label">Fecha de nacimiento</label>
                            </div>
                        </div>
                    </div>

                    <div class="pt-1 mb-4">
                        <input type="submit" name="enviar" value="Register" class="btn btn-dark">
                    </div>

                    <p class="mb-5 pb-lg-2" style="color: #616D69;">¿Ya tienes cuenta? <a href="login.php"style="color: #616D69;">Ingresa aqui</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>