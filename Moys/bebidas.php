<?php require_once 'conexion/conector.php';?>
<html>
<head>
    <!-- Required  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

   <title>Los Moys - Bebidas</title>
 </head>
    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/4ddc389f8f.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap"
rel="stylesheet"/>
    <title>Aplicacion Web</title>
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-1 px-lg-1">
                <a class="navbar-brand" href="principal.php">Los Moy's</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="registro.php">Registrate aquí!</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ver las Comidas!</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="carrito.php">Carrito de compras</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="principal.php">Pagina de Inicio!</a></li>
                                <li><a class="dropdown-item" href="comidas.php">Comida Rápida!</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Carrito
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <header class="bg-dark py-5">
            <div class="container px-1 px-lg-1 my-1">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Bebidas</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Disfruta cada gota!</p>
                </div>
            </div>
        </header>
    <div class="container-fluid mt-5">
      <div class="row">
        <!--layout izquierdo-->
    </div>
    <br />
    <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                  <?php
                  $resultado = mysqli_query($link, "SELECT * FROM platillo where prec_platillo<26.00");

                  if( $resultado ){

                    //Ahora valida que la consuta haya traido registros
                    if( mysqli_num_rows( $resultado ) > 0){

                      //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
                      while($fila = mysqli_fetch_array( $resultado ) ){

                        //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
                        //un campo en tu DB llamado NOMBRE, así accederías
                        echo '<div class="col mb-5">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"></div>
                                <!-- Product image-->
                                <img class="card-img-top" src="'.$fila["img_plat"].'" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">'.$fila['tipo_plat'].'</h5>
                                        <!-- Product price-->
                                        '.$fila['prec_platillo'].'
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Agregar al carrito</a></div>
                                </div>
                            </div>
                        </div>';
                      }

                    }
                  }
                  //cve_plat,tipo_plat,prec_platillo,cost_platillo,img_plat

                  mysqli_close($link);

                   ?>

                </div>
            </div>
        </section>
    <br />
    <!--Footer-->
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

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
