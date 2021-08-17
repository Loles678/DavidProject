<?php require_once 'conexion/conector.php';?>
<html>
<head>
    <!-- Required meta tags   -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

   <title>Los Moys/Carrito de Compras</title>
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
                        <li class="nav-item"><a class="nav-link" href="bebidas.php">Bebidas!</a></li>
                        <li class="nav-item"><a class="nav-link" href="comidas.php">Comidas!</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="bg-dark py-5">
            <div class="container px-1 px-lg-1 my-1">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Carrito</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Checa antes de comprar, no olvides nada!</p>
                </div>
            </div>
        </header>
    <div class="container-fluid mt-5">
      <div class="row">
        <!--layout izquierdo-->
    </div>
    <table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Precio</th>
      <th scope="col">Nro. de Orden</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Total</th>
    </tr>
  </thead>

  <tbody>

    <?php
    //CONSULTA PARA OBTENER ORDENES DEL CLIENTE EN SESION
    $resultado = mysqli_query($link, 'SELECT tipo_plat,cant_plat,prec_platillo,detalle_orden.id_orden,id_clie
    FROM moys.detalle_orden,moys.platillo,moys.orden
    where moys.platillo.cve_plat=moys.detalle_orden.cve_plat
    and moys.detalle_orden.id_orden=moys.orden.id_orden
    and moys.orden.id_clie="C_006"');

    if( $resultado ){

      //Ahora valida que la consuta haya traido registros
      if( mysqli_num_rows( $resultado ) > 0){

        //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
        while($fila = mysqli_fetch_array( $resultado ) ){

          //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
          //un campo en tu DB llamado NOMBRE, así accederías

          // CAMPOS DE LA BASE DE DATOS ->> tipo_plat,cant_plat,prec_platillo,detalle_orden.id_orden,id_clie
          $total = $fila['cant_plat'] *$fila['prec_platillo'];
          echo '  <tr>
              <td>'.$fila['tipo_plat'].'</td>
              <td>$'.$fila['prec_platillo'].'</td>
              <td>'.$fila['id_orden'].'</td>
              <td>'.$fila['cant_plat'].'</td>
              <td>$'.$total.'</td>
            </tr>';
        }

      }
    }


    mysqli_close($link);
    ?>
  </tbody>
</table>
<button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off">Comprar!</button>
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
