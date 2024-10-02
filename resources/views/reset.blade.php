<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tars - Restablecer Contraseña</title>
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

      <!-- Right side with password reset form -->
      <div class="col-md-6 form-container">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="text-center mb-4">
                <h2><span class="text-success">*</span> Tars</h2>
                <p class="lead">Restablecer Contraseña</p>
              </div>

              <form>
                <div class="mb-3">
                  <label for="email" class="form-label">Correo</label>
                  <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar enlace de restablecimiento</button>
                <p class="text-center mt-3">¿Recordaste tu contraseña? <a href="/">Inicia sesión</a></p>
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
