<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tars - Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
    }
    .left-side {
      background-image: url('media/background-login.png'); /* Reemplaza con tu imagen */
      background-size: cover;
      background-position: center;
    }
    .form-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 100vh;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Left side with image and slogan -->
      <div class="col-md-6 left-side d-flex align-items-center text-white text-center">
        <div class="p-4">
          <h2 class="fw-bold">Una mejor organización para cualquier renta de propiedad</h2>
          <p class="lead">All you need is money $$</p>
        </div>
      </div>

      <!-- Right side with registration form -->
      <div class="col-md-6 form-container">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="text-center mb-4">
                <h2><span class="text-success">*</span> Tars</h2>
                <p class="lead">Crea tu cuenta</p>
              </div>

              <form>
                <div class="mb-3">
                  <label for="name" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="name" placeholder="Ingresa tu nombre" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Correo</label>
                  <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
                </div>
                <div class="mb-3">
                  <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                  <input type="password" class="form-control" id="confirm-password" placeholder="Confirma tu contraseña" required>
                </div>
                <a href="/proyectos" type="submit" class="btn btn-primary w-100">Crear Cuenta</a>
                <hr>
                <p class="text-center">o regístrate con</p>
                <div class="d-flex justify-content-center">
                  <button type="button" class="btn btn-outline-danger me-2"><i class="bi bi-google"></i> Google</button>
                  <button type="button" class="btn btn-outline-dark"><i class="bi bi-apple"></i> Apple</button>
                </div>
                <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="/">Inicia sesión</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
