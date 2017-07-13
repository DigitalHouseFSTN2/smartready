<?php

require_once "validaciones.php";
require_once "messages.php";

function usuarioSet($nombre, $apellido, $email, $password, $valPassword){
    // Validar!
    $errores = usuarioVal($nombre, $apellido, $email, $password, $valPassword);

    if (empty($errores)) {
      // No hubo errores
      $errores = usuarioFindMail($email);

      if(empty($errores)){
        $password = sha1($password);
        // Transformarlo a json
        $jsonUser = json_encode([
            'name'      => $nombre,
            'lastname'   => $apellido,
            'email'     => $email,
            'password'  => $password
        ]);

        $fp = fopen("cuentasUsuarios.json", "a+");
        $resultado = fwrite($fp, $jsonUser . PHP_EOL);
        fclose($fp);

        $_SESSION["name"] = $nombre;
        $_SESSION["email"] = $email;
        $_SESSION["lastname"] = $apellido;

        return $resultado;

        var_dump($resultado);

      } else {
      // Hubo errores
        return $errores;
      }
    }
}
function usuarioFindMail($mail){
  $errores = [];
  if (!empty($mail) )  {
    // Se informó el mail

    // buscar archivo json.. recorrerlo hasta encontrar mail.

    $filecuentas = @fopen("cuentasUsuarios.json", "r");
    if ($filecuentas) {
      while (($linea = fgets($filecuentas, 4096)) !== false) {
        $regUsuario = json_decode($linea, true);
        if (trim($regUsuario['email']) == trim($mail))
        {
          $errores['email'] = 'Ya existe una cuenta con este email';
          return $errores;
        }
        // echo 'Usuario ok <br>';
      }
      if (!feof($filecuentas)) {
        $errores['email'] = 'error inesperado';
        return $errores;
        // echo "Error: fallo inesperado de fgets()\n";
      }
      fclose($filecuentas);
      return $errores;  // Buscó y no econtró email
    } else {
        // echo "Ups!!! de file";
        return $errores ; //"Ups!!! detectamos un inconveniente de conección intente mas tarde";
    }
  } else {
    return $errores ; // Debe informar el mail
  }
}

function usuarioAccess($mail,$password)  {

  if (!empty($mail) && !empty($password))  {
      // buscar archivo json.. recorrerlo hasta encontrar mail.
      $filecuentas = @fopen("cuentasUsuarios.json", "r");

      // echo "Lectura archivo <br>";
      var_dump($filecuentas);

      if ($filecuentas) {
        while (($linea = fgets($filecuentas, 4096)) !== false) {

          // echo "Linea" . $linea . '<br>' ;
          $regUsuario = json_decode($linea, true);

          /*echo "array usuario ";
          var_dump($regUsuario);
          echo "<br>";*/

          if (trim($regUsuario['email']) == trim($mail))
          {

            $password = sha1($password);

            if ($regUsuario['password'] == $password){

            $_SESSION["name"] = $regUsuario["name"];
            $_SESSION["lastName"] = $regUsuario["lastname"];
            $_SESSION["email"] = $regUsuario["email"];
            return 1;
          } else {
            return 0;
          }
            // echo 'Usuario ok <br>';
          }
          // Falta interpretar la linea como json y tomar el dato de mail para validar que sea el mismo ..
          // luego comparar con la clave.
        }
        if (!feof($filecuentas)) {
          return 0;
          // echo "Error: fallo inesperado de fgets()\n";
        }
        fclose($filecuentas);
      } else {
        // echo "Ups!!! de file";
        return 0 ; //"Ups!!! detectamos un inconveniente de conección intente mas tarde";
      }
  }
  else  {
      return 0; // "Debe informar usuario y clave";
  }
}


function usuarioVal($nombre, $apellido, $email, $password, $valPassword){
    $errores = [];
    $mensajetipo = "";
    $mensajetexto= "";

    if ( $password <> $valPassword){
        $errores['password'] = 'La clave no coincide con la validación';
    }
    if (! validarNombreOApellido($nombre, 1)) {
    //    $errores['name'] = "El nombre es invalido";
        mensaje('incorrecto', 'El nombre es invalido');

    }

    if (! validarNombreOApellido($apellido, 2)) {
//        $errores['lastname'] = "El apellido no es valido";
        mensaje('incorrecto', 'El apellido no es valido');

    }

    if (! validarEmail($email)) {
//        $errores['email'] = "El mail ingresado no es valido" ;
          mensaje('incorrecto', 'El mail ingresado no es valido');

    }

    if (! validarPassword($password)) {
    //    $errores['password'] = "El password ingresado no es valido";
         mensaje('incorrecto', 'El password ingresado no es valido');
    }



    return $errores;


}
