<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tars - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
    }
    .left-side {
      background-image: url('media/background-login.png'); /* Replace with your image URL */
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
      <div class="col-md-6 left-side d-flex align-items-end text-white text-center" >
        <div class="p-4"style="background:#111827">
          <h2 class="fw-bold">Una mejor organización para cualquier renta de propiedad</h2>
          <p class="lead">All you need is money $$</p>
        </div>
      </div>

      <!-- Right side with login form -->
      <div class="col-md-6 form-container">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="text-center mb-4">
                <h2><span class="text-success">*</span> Tars</h2>
                <p class="lead">Ingresa a tu cuenta</p>
              </div>

              {{ $slot }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
