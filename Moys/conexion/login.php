<?php
 require_once 'conector.php';
 session_start();

 //MBA_04     ratkaw07
 $myusername = $_GET['username'];
 $mypassword = $_GET['password'];
 $consulta = "SELECT * FROM usuario U JOIN  cliente C
   where U.nom_usu=C.nom_usu and U.nom_usu = '".$myusername."' and  contr_usu = '".$mypassword."'";
 $resultado = mysqli_query($link, $consulta);

 if( $resultado ){

   $count = mysqli_num_rows($resultado);
    if($count == 1) {
      while($fila = mysqli_fetch_assoc($resultado)){
        $_SESSION['nm_clien'] = $fila['nom_clie'];
        $_SESSION['ap_clien'] = $fila['ap_clie'];
        $_SESSION['am_clien'] = $fila['am_clie'];
        $_SESSION['rfc_clien'] = $fila['rfc_clie'];
        $_SESSION['nom_usu'] = $fila['nom_usu'];
        $_SESSION['id_clien'] = $fila['id_clie'];
      }
         $json['status'] = '200';
         $json['msj'] = "¡Bienvenido!";
         //header("location: localhost/David/Moys/principal.php");
      }else {
         $json["msj"] = "Tu nombre o password son incorrectos";
         $json["status"] = "500";
      }
 }else {
   $json["msj"] = "Ocurrio un error";
   $json["status"] = "700";
 }
echo json_encode($json);
?>
