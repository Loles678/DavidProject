<?php require_once 'conexion/conector.php';?>
<html>
<head>
    <!-- Required met  tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   <!-- Place your kit's code here -->
   <script src="https://kit.fontawesome.com/4ddc389f8f.js" crossorigin="anonymous"></script>
   <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap"
rel="stylesheet"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

   <title>Los Moys - Pagina de inicio</title>
 </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="principal.php">Los Moy's</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="registro.php">Registrate aquí!</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ver Todos Los Alimentos</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="carrito.php">Carrito de compras</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="bebidas.php">Bebidas!</a></li>
                                <li><a class="dropdown-item" href="comidas.php">Comida Rápida!</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Carrito
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><a id="count">0</a></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Los Moy's Restaurant</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Ve las ofertas y el especial del día!</p>
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
                      $resultado = mysqli_query($link, "SELECT * FROM platillo");

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
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Especial</div>
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
                                        <div class="text-center"><a name="carrito" id="'.$fila['cve_plat'].'" class="btn btn-outline-dark mt-auto" href="#">Agregar al carrito</a></div>
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
      </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script type="text/javascript">
    //Creamos funcion a partir del click de las etiqueas <a> con el cual podremos hacer uso del carrito
    var array_carrito = new Array();
     $('a').click(function(){
       if($(this).attr('name') == "carrito"){
         var cve_platillo = $(this).attr('id');
         var contador = Number.parseInt($('#count').html()) + 1;
         $('#count').html(contador);

         if(array_carrito == null ||array_carrito == ""){
           array_carrito[1] ={"cve_plat":cve_platillo,"cont":1}
         }else{
           for (var i = 1; i <= array_carrito.length; i++) {
             console.log(array_carrito[i].val());
             var plat = (array_carrito[i].cve_plat);
             if(plat == cve_platillo){
               var suma = Number.parseInt(array_carrito[i].cont+1);

               array_carrito.map(function(dato){
                 if(dato.cve_plat == cve_platillo){
                   dato.cont = suma;
                 }
                 return dato;
               });
             }
             else {
               array_carrito[i+1] ={"cve_plat":cve_platillo,"cont":1}
             }
           }
         }
         console.log(array_carrito);
         /*$.ajax({
           // la URL para la petición
           url : 'conexion/setOrden.php',
           // la información a enviar
           // (también es posible utilizar una cadena de datos)
           data : { 'cve_plat' : cve_platillo, },
           // especifica si será una petición POST o GET
           type : 'GET',
           // el tipo de información que se espera de respuesta
           dataType : 'json',
           // código a ejecutar si la petición es satisfactoria;
           // la respuesta es pasada como argumento a la función
           success : function(json) {
            $('<h1/>').text(json.title).appendTo('body');
            $('<div class="content"/>')
                .html(json.html).appendTo('body');
          },
          // código a ejecutar si la petición falla;
          // son pasados como argumentos a la función
          // el objeto de la petición en crudo y código de estatus de la petición
          error : function(xhr, status) {
            alert('Disculpe, existió un problema');
          },
          // código a ejecutar sin importar si la petición falló o no
          complete : function(xhr, status) {
            alert('Petición realizada');
          }
        });*/
         //alert("funciona!"+elem);
       }
     });
    </script>
  </body>
  </html>
