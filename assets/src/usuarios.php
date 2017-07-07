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

        $fp = fopen("users.json", "a+");
        $resultado = fwrite($fp, $jsonUser . PHP_EOL);
        fclose($fp);
        return $resultado;
    } else {
        // Hubo errores
        return $errores;
    }
}
function usuarioAccess($mail,$password)  {
  echo $mail . ' y clave ' . $password;

  if (!empty($mail) && !empty($password))  {

    // buscar archivo json.. recorrerlo hasta encontrar mail.
      $filecuentas = @fopen("cuentasUsuarios.txt", "r");
      var_dump($filecuentas);
      if ($filecuentas) {
        while (($linea = fgets($filecuentas, 4096)) !== false) {
          echo "<br> " . $linea . 'linea' ;

          $regUsuario = json_decode($linea, true);
          echo "<br> array usuario <br>";
          var_dump($regUsuario);

          if (trim($regUsuario['mail']) == trim($mail))
          {
            echo 'ok';
          }
          echo $linea;
          echo "<br>";
          // Falta interpretar la linea como json y tomar el dato de mail para validar que sea el mismo ..
          // luego comparar con la clave.
        }
        if (!feof($fileCuentas)) {
          echo "Error: fallo inesperado de fgets()\n";
        }
        fclose($fileCuentas);
      } else {
        return "Ups!!! detectamos un inconveniente de conección intente mas tarde"; 
      }
  }
  else  {
      return "Debe informar usuario y clave";
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
