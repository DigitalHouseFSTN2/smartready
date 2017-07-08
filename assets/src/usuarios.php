<?php

require_once "validaciones.php";

function usuarioSet($nombre, $apellido, $email, $password)
{
    // Validar!
    $errores = validarUsuario($nombre, $apellido, $email, $password);

    if (empty($errores)) {
        // No hubo errores
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

        $_SESSION["name"] = $regUsuario["name"];
        $_SESSION["email"] = $regUsuario["email"];
        $_SESSION["lastname"] = $regUsuario["lastname"];
        return $resultado;
    } else {
        // Hubo errores
        return $errores;
    }
}

function usuarioAccess($mail,$password)  {
  echo "Entra con usuario->" . $mail . ' y clave->' . $password . "<br>";

  if (!empty($mail) && !empty($password))  {
      // buscar archivo json.. recorrerlo hasta encontrar mail.
      $filecuentas = @fopen("cuentasUsuarios.json", "r");

      echo "Lectura archivo <br>";
      var_dump($filecuentas);

      if ($filecuentas) {
        while (($linea = fgets($filecuentas, 4096)) !== false) {

          echo "Linea" . $linea . '<br>' ;
          $regUsuario = json_decode($linea, true);

          /*echo "array usuario ";
          var_dump($regUsuario);
          echo "<br>";*/

          if (trim($regUsuario['email']) == trim($mail))
          {

            $_SESSION["name"] = $regUsuario["name"];
            $_SESSION["email"] = $regUsuario["email"];
            $_SESSION["lastname"] = $regUsuario["lastname"];
            return 1;
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
        echo "Ups!!! de file";
        return "Ups!!! detectamos un inconveniente de conección intente mas tarde";
      }
  }
  else  {
      return 0; // "Debe informar usuario y clave";
  }
}
function usuarioVal($nombre, $apellido, $email, $password)
{
    $errores = [];

    if (! validarNombreOApellido($nombre, 1)) {
        $errores['name'] = "El nombre es invalido";
    }

    if (! validarNombreOApellido($apellido, 2)) {
        $errores['lastname'] = "El apellido no es valido";
    }

    if (! validarEmail($email)) {
        $errores['email'] = "El mail ingresado no es valido" ;
    }

    if (! validarPassword($password)) {
        $errores['password'] = "El password ingresado no es valido";
    }

    return $errores;
}
