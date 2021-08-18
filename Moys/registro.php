<?php ?>
<!Doctype html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/4ddc389f8f.js" crossorigin="anonymous"></script>

  <!--Fonts Google-->
  <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet" />
  <style>
    body {
      font: 14px sans-serif;
    }

    .wrapper {
      width: 360px;
      padding: 20px;
    }
  </style>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="javascript" src="https://server/cookies.js"></script>
  <!--<title>Los Moy's - Acceso</title>-->
</head>

<body style="background-color: rgb(218, 218, 218);">
  <!--Navbar header-->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="principal.php" class="navbar-brand"><img src="img/moys.jpg" class="img-fluid" width="30" height="30" />Los Moy's</a>
    </div>
  </nav>
  <!--Logo-->
  <img src="img/moys.jpg" alt="" class="img-fluid mx-auto d-block my-5" />
  <!--Acceso o Login-->
  <!-- login -->

  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="row">
            <h2>Login</h2>
            <p>Porfavor, llena tus datos para ingresar.</p>
          </div>
          <div class="row" id="row_err"></div>
          <div class="row">
            <form method="post">
              <div class="form-group">
                <label>Nombre de Usuario</label>
                <input id="username" type="text" name="username" class="form-control">
                <span id="user_err" class="invalid-feedback"></span>
              </div>
              <div class="form-group">
                <label>Contraseña</label>
                <input id="password" type="password" name="password" class="form-control">
                <span id="pass_err" class="invalid-feedback"></span>
              </div>
              <div class="form-group">
                <input id="login" type="submit" class="btn btn-primary" value="Login">
              </div>
              <p>Que no tines una cuenta? <br /> <a href="nueva_cuenta.php">Registrate ahora!</a>.</p>
            </form>
          </div>
        </div>
      </div>
    </div>

    <br />
    <div class="container">
      <div class="row">
        <div class="card-group">
          <div class="card">
            <img src="img/menu.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card text-center">Comida rápida</h5>
              <p class="card-text"></p>
              <p class="card-text"><small class="text-muted"></small></p>
            </div>
          </div>
          <div class="card">
            <img src="img/michelada.jpg" height="370" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card text-center" text>Cerveza y micheladas</h5>
              <p class="card-text"></p>
              <p class="card-text"><small class="text-muted"></small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer -->
    <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="lead text-center">LosMoys S.A. de C.V. Todos Los Derechos Reservados &copy; <span>App Web</span></p>
          </div>
        </div>
      </div>
    </footer>

    <script type="text/javascript">
      $('#login').click(function() {
        var user = $('#username').val();
        var pass = $('#password').val();
        $.ajax({
          async: true,
          url: 'http://localhost/David/Moys/conexion/login.php',
          data: {
            'username': user,
            'password': pass
          },
          type: 'GET',
          dataType: 'json',
          success: function(json) {
            if(json.status=="500")
              $('#row_err').html('<div class="alert alert-danger">' + json.msj + '</div>');
            else if(json.status=="200"){
              $('#row_err').html('<div class="alert alert-success">' + json.msj + '</div>');
              	setTimeout(function(){ window.location = 'principal.php'; },5000);
            }
          },
          error: function(status) {
            alert('Algo salio mal: ' + json.msj);
          }
        });
      });
    </script>
  </body>

</html>
