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

        $mensajetexto = 'Registro agregado exitosamente !';// echo 'Usuario ok <br>';
        mensaje('correcto', $mensajetexto);

        $_SESSION["name"] = $nombre;
        $_SESSION["email"] = $email;
        $_SESSION["lastname"] = $apellido;

        return $resultado;

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
  $mensajetipo = "";
  $mensajetexto= "";

  if (!empty($mail) && !empty($password))  {
      // buscar archivo json.. recorrerlo hasta encontrar mail.
      $filecuentas = @fopen("cuentasUsuarios.json", "r");

      // echo "Lectura archivo <br>";

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
            $_SESSION["password"] = $password;

            $mensajetexto = 'Registro agregado exitosamente !';
            mensaje('correcto', $mensajetexto);
            return 1;

          } else {
            $mensajetexto = 'No pudo agregarse el registro !';
            mensaje('incorrecto', $mensajetexto);
            return 0;
          }
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
        $mensajetexto = 'La clave no coincide con la validación';
    }
    if (! validarNombreOApellido($nombre, 1)) {
    //    $errores['name'] = "El nombre es invalido";
        $mensajetexto = 'El nombre es inválido';
    }

    if (! validarNombreOApellido($apellido, 2)) {
      //        $errores['lastname'] = "El apellido no es valido";
        $mensajetexto ='El apellido no es válido';
    }

    if (! validarEmail($email)) {
      //        $errores['email'] = "El mail ingresado no es valido" ;
       $mensajetexto ='El mail ingresado no es válido';
    }

    if (! validarPassword($password)) {
    //    $errores['password'] = "El password ingresado no es valido";
        $mensajetexto = 'El password ingresado no es válido';
      }

    if ($mensajetexto !== "") {
      mensaje('incorrecto', $mensajetexto);
      $errores = "Error!";
  }
    return $errores;
 }
function usuarioSetFile(){
  if (!empty($_FILES["user-file"])){
    if($_FILES["user-file"]["error"] == UPLOAD_ERR_OK){     // NO HAY ERRORES

      $file_name  = $_FILES["user-file"]["name"];           // "IMG_20170625_164044.jpg"
      $file_type  = $_FILES["user-file"]["type"];           // "image/jpeg"
      $file       = $_FILES["user-file"]["tmp_name"];       // "C:\xampp\tmp\phpFBF0.tmp"
      $file_error = $_FILES["user-file"]["error"];          //
      $file_size  = $_FILES["user-file"]["size"];           // int(752014)
      $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
      if(  ($file_size / 1024) < 1024 ){
        $miArchivo =  dirname( __DIR__ . '../');
        //$miArchivo = 'sdfsdf/sr'
        $miArchivo .=  "\\" ."img". "\\";
        $miArchivo .= sha1($_SESSION["email"]) . "." . $file_extension;
        move_uploaded_file( $file, $miArchivo);
      } else {  // imagen de tamaño mayor a 1M.
        mensaje("incorrecto","El archivo supera 1M de tamaño");
      }
    } else {
      mensaje("incorrecto", "Error al subir el archivo, intenteló nuevamente");
    }
  }
}
function usuarioGetfile(){
    $miArchivo =  dirname( __DIR__ . '../');
    //$miArchivo = 'sdfsdf/sr'
    $miArchivo .=  "\\" ."img". "\\";
    $miArchivo .= sha1($_SESSION["email"]) . ".jpg";  //  . $file_extension;
    if(file_exists( $miArchivo )){
      return '.' . '\\' . 'assets' . '\\' . 'img' . '\\' . sha1($_SESSION["email"]) . ".jpg";
    } else {
      return "";
    }

}
function usuarioUpdPassword($email, $oldPassword, $newPassword, $valPassword){
  $errores = [];
  // VALIDAR SI NUEVA CLAVE Y VALIDACIÓN SON LO MISMO .. ANTES DE HACER OPERATORIA
  if( $newPassword == $valPassword){
    if (!empty($email) )  {
      // Se informó el mail

      // buscar archivo json.. recorrerlo hasta encontrar mail.
      $fileCuentasR = @fopen("cuentasUsuarios.json", "r");
      // abrir un temporal para ir guardando las lineas leías, al final se reemplazan los archivos.
      $fileCuentasW = @fopen("cuentasUsuariosTmp.json", "w");
      // Recorrer el archivo de cuentas buscando por mail el usuario.
      if ($fileCuentasR) {
        while (($linea = fgets($fileCuentasR, 4096)) !== false) {
          // lleva la lína en json a array
          $regUsuario = json_decode($linea, true);
          // valida mail de linea con mail de usuario a cambiar clave.
          if (trim($regUsuario['email']) == trim($email)) {
            // USUARIO A VALIDAR $oldPassword en sha1.. si es igual. hay que actualizar.
            // reemplazar el campo de clave y luego volver a armar la línea.
            // Verifica si la clave anterior ingresada coincide.
            $sha1Password = sha1($oldPassword);
            if ($regUsuario['password'] == $sha1Password){
              $regUsuario['password'] = sha1($newPassword);
              $linea =  json_encode($regUsuario) . PHP_EOL ;
              $correcto = true ;
            } else {
              mensaje('incorrecto', 'La clave actual no corresponde');
              return 0;
            }
          }
          fputs($fileCuentasW, $linea);
        }

          // pasar la linea leida o editada al nuevo archivo.

      } else {
        mensaje('incorrecto', 'Inconveniente de conección a usuarios');
        return 0 ; //"Ups!!! detectamos un inconveniente de conección intente mas tarde";
      }
      if (!feof($fileCuentasR)) {
        mensaje('incorrecto', 'Error inesperado');
        return 0;
        // echo "Error: fallo inesperado de fgets()\n";
      }
      fclose($fileCuentasR);
      fclose($fileCuentasW);
      if($correcto){
        // Renombrar los archivos origen en old .. tmp en origen
        rename( 'cuentasUsuariosTmp.json', 'cuentasUsuarios.json');

        mensaje('correcto', 'Su clave ha sido modificada');
        return 1;
      } else {
        // Borrar el archivo old
        unlink('cuentasUsuariosTmp.json');
      }
      mensaje('incorrecto', 'No se encontó el usuario para cambio de clave');
      return 0;  // Buscó y no econtró email
    } else {
        // echo "Ups!!! de file";
        mensaje('incorrecto', 'No hay usuario para cambio de clave');
        return 0 ; // Debe informar el mail
    }
  } else {
      mensaje('incorrecto', 'La nueva calve y su validación no coinciden');
      return 0 ; // Debe informar el mail
  }
}
  /*
  $readisng = fopen('myfile', 'r');
  $writing = fopen('myfile.tmp', 'w');

  $replaced = false;

  while (!feof($reading)) {
    $line = fgets($reading);
    if (stristr($line,'certain word')) {
      $line = "replacement line!\n";
      $replaced = true;
    }
    fputs($writing, $line);
  }
  fclose($reading); fclose($writing);
  // might as well not overwrite the file if we didn't replace anything
  if ($replaced)
  {
    rename('myfile.tmp', 'myfile');
  } else {

  }
  */
