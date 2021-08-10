<?php
require_once "conexion/conector.php";
$username  = $password ='';
$username_err = $password_err ='';

session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
// Include config file
// require_once "config.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Check if username is empty
if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
} else{
    $username = trim($_POST["username"]);
}

// Check if password is empty
if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
} else{
    $password = trim($_POST["password"]);
}

// Validate credentials
if(empty($username_err) && empty($password_err)){
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = $username;

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);

            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        // Password is correct, so start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;

                        // Redirect user to welcome page
                        header("location: principal.php");
                    } else{
                        // Password is not valid, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                }
            } else{
                // Username doesn't exist, display a generic error message
                $login_err = "Invalid username or password.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($link);
}
?>
<!Doctype html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   <!-- Bootstrap CSS -->
   <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">-->
   <!--Kits code-->
   <script src="https://kit.fontawesome.com/4ddc389f8f.js" crossorigin="anonymous"></script>
   <!--Custom CSS-->
   <link rel="stylesheet" href="css/estilos.css">
   <!--Fonts Google-->
   <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap"
    rel="stylesheet"/>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <!--<title>Los Moy's - Acceso</title>-->
</head>
  <body style="background-color: rgb(218, 218, 218);">
    <!--Navbar header-->
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
          <div class="container">
              <a href="principal.php" class="navbar-brand"><img src="img/moys.jpg"  class="img-fluid" width="30" height="30"/>Los Moy's</a>
          </div>
      </nav>
    <!--Logo-->
    <img src="img/moys.jpg" alt="" class="img-fluid mx-auto d-block my-5"/>
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
          <div class="row">
            <?php
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nombre de Usuario</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p>Que no tines una cuenta? <br/> <a href="nueva_cuenta.php">Registrate ahora!</a>.</p>
            </form>
          </div>
        </div>
      </div>
    </div>

    <br/>
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
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    </body>
</html>
