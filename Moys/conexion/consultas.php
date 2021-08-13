<?php
require_once 'conector.php';

$resultado = mysqli_query($link, "SELECT * FROM platillo");

if( $resultado ){

  //Ahora valida que la consuta haya traido registros
  if( mysqli_num_rows( $resultado ) > 0){

    //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
    while($fila = mysqli_fetch_array( $resultado ) ){

      //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
      //un campo en tu DB llamado NOMBRE, así accederías
      echo $fila['cve_plat'];
      echo $fila['tipo_plat'];
      echo $fila['prec_platillo'];
      echo $fila['cost_platillo'];
      echo $fila['img_plat'];
    }

  }
}
//cve_plat,tipo_plat,prec_platillo,cost_platillo,img_plat

mysqli_close($link);
?>
