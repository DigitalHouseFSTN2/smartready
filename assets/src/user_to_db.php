<?php

require_once "validate.php";
require_once "messages.php";

function usuarioSet($nombre, $apellido, $email, $password, $valPassword, $remember){


    // Validar!
    $errores = usuarioVal($nombre, $apellido, $email, $password, $valPassword);
    $numero_aleatorio = 0;



    if (empty($errores)) {
      // No hubo errores
      $errores = usuarioFindMail($email);


      if(empty($errores)){
        $password = sha1($password);
        // Transformarlo a json

        // En base de datos
        // $ssql = "update usuario set cookie='$numero_aleatorio' where id_usuario=" . $usuario_encontrado->id_usuario;
        // mysql_query($ssql);

         //3) ahora meto una cookie en el ordenador del usuario con el identificador del usuario y la cookie aleatoria

       if ($remember == 1) {
         //generamos un número aleatorio
         mt_srand (time());
         $numero_aleatorio = mt_rand(1000000,999999999);

        }
        else {
          $numero_aleatorio = 0;
          $remember         = 0;
        }
        //+ Inicio de codigo MySQL

        $usuario = 'root';
        $contraseña = 'root';
        $db = new PDO('mysql:host=localhost;port=3307;dbname=smartready', $usuario, $contraseña);
        $db->beginTransaction();

        try{
          // 1* Buscar el usuario
					$extImagen= '';
					$cookie = $numero_aleatorio;

          $statement = $db->prepare("INSERT INTO USER (name,lastname,email,password,remember,cookie_rnd,extImagen) VALUES(:name,:lastname,:email,:password,:remember,:cookie_rnd,:extImagen)");

					$statement->bindParam(':name', $nombre,PDO::PARAM_STR);
					$statement->bindParam(':lastname', $apellido,PDO::PARAM_STR);
					$statement->bindParam(':email', $email,PDO::PARAM_STR);
					$statement->bindParam(':password', $password, PDO::PARAM_STR);
					$statement->bindParam(':remember', $remember, PDO::PARAM_INT);
					$statement->bindParam(':cookie_rnd', $cookie, PDO::PARAM_INT);
					$statement->bindParam(':extImagen', $extImagen,PDO::PARAM_STR);

          $statement->execute();
          $db->commit();
        } catch (PDOException $e) {

          $db->rollBack();
          echo $ex->getMessage();
        }
       if ($remember == 1) {
        setcookie("id_usuario", $nombre.$apellido , time()+(60*60*24*365));
        setcookie("marca_aleatoria_usuario", $numero_aleatorio, time()+(60*60*24*365));
      }

        //$mensajetexto = 'Registro agregado exitosamente !';
        //mensaje('correcto', $mensajetexto);

        $_SESSION["name"] = $nombre;
        $_SESSION["email"] = $email;
        $_SESSION["lastName"] = $apellido;
        $_SESSION["extImagen"] = '';

        return 1;

      } else {
      // Hubo errores
        return 0;
      }
    }
}

function usuarioTransfer($nombre, $apellido, $email, $password,$remember,$cookie,$extImagen){

	$errores = usuarioFindMail($email);

	if(empty($errores)){

    $usuario = 'root';
    $contraseña = 'root';
    $db = new PDO('mysql:host=localhost;port=3307;dbname=smartready', $usuario, $contraseña);
    $db->beginTransaction();

    try{
      // 1* Buscar el usuario


      $statement = $db->prepare("INSERT INTO USER (name,lastname,email,password,remember,cookie_rnd,extImagen) VALUES(:name,:lastname,:email,:password,:remember,:cookie_rnd,:extImagen)");

			$statement->bindParam(':name', $nombre);
			$statement->bindParam(':lastname', $apellido);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':password', $password);
			$statement->bindParam(':remember', $remember);
			$statement->bindParam(':cookie_rnd', $cookie);
			$statement->bindParam(':extImagen', $extImagen);

      $statement->execute();
      $db->commit();
    } catch (PDOException $e) {

      $db->rollBack();
      // echo $ex->getMessage();
    }

    return 1;
	}
}

function usuarioFindMail($mail){
  	$errores = [];
  if (!empty($mail) )
	{
    // Se informó el mail

    // buscar archivo json.. recorrerlo hasta encontrar mail.
	 // echo "usuarioFindMail - entró <br>";
    $usuario = 'root';
    $contraseña = 'root';

	 	try
		{
    	$db = new PDO('mysql:host=localhost;port=3307;dbname=smartready', $usuario, $contraseña);

      // 1* Buscar el usuario
      $statement = $db->prepare("SELECT id,name,lastname,email,password FROM USER WHERE email=:email");

      $statement->bindParam(':email', $mail);

      $statement->execute();

  	 //echo "usuarioFindMail - ejecutó <br>";

      if($statement->rowCount()>0){
        $errores['email'] = 'Ya existe una cuenta con este email';

      }
			var_dump($errores);
			return $errores;
      // $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $ex){

      // echo $ex->getMessage();
    }
		/*
    $filecuentas = @fopen("accountUser.json", "r");
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
		*/
  } else {
    return $errores ; // Debe informar el mail
  }
}

function usuarioAccess($mail,$password)  {

  $mensajetipo = "";
  $mensajetexto =  array();


  if (!empty($mail) && !empty($password))  {

	  // Armado de conección
	  $usuario = 'root';
	  $contraseña = 'root';

		try
		{
			$db = new PDO('mysql:host=localhost;port=3307;dbname=smartready', $usuario, $contraseña);

			 // 1* Buscar el usuario
			$statement = $db->prepare("SELECT id,name,lastname,email,password,extImagen FROM USER WHERE email=:email");
			$statement->bindParam(':email', $mail);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);

			if($statement->rowCount()>0){
				$password = sha1($password);

				if ( $result["password"] == $password)
				{
					// Gestionar la sessión .

	        $_SESSION["name"] =  $result["name"] ;
	        $_SESSION["email"] =  $result["email"] ;
	        $_SESSION["lastName"] =  $result["lastname"] ;
	        $_SESSION["extImagen"] =  $result["extImagen"] ;

					return 1;
				} else
				{
					return 0;
				}
	 		}
		} catch (Exception $ex )
		{
			// echo $ex->getMessage();
			return 0 ;
		}

  }
  else  {

      return 0; // "Debe informar usuario y clave";
  }
}

function usuarioVal($nombre, $apellido, $email, $password, $valPassword){
    $errores = [];
    $mensajetipo = "";
    $mensajetexto= [];

    // echo "UsuarioVal->entro <br>";
    if ( $password <> $valPassword){
        $mensajetexto[] = 'La clave no coincide con la validación';
    }
    if (! validarNombreOApellido($nombre, 1)) {
    //    $errores['name'] = "El nombre es invalido";
        $mensajetexto[] = 'El nombre es inválido';
    }

    if (! validarNombreOApellido($apellido, 2)) {
      //        $errores['lastname'] = "El apellido no es valido";
        $mensajetexto[] ='El apellido no es válido';
    }

    if (! validarEmail($email)) {
      //        $errores['email'] = "El mail ingresado no es valido" ;
       $mensajetexto[] ='El mail ingresado no es válido';
    }

    if (! validarPassword($password)) {
    //    $errores['password'] = "El password ingresado no es valido";
        $mensajetexto[] = 'El password ingresado no es válido';
      }

     if (count($mensajetexto) > 0 ) {

      // echo "UsuarioVal->incorrecto <br>";
      var_dump($mensajetexto);

      mensaje('incorrecto', $mensajetexto);
      $errores = "Error!";
    }

    // echo "UsuarioVal->correcto <br>";
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
        // $miArchivo .=  "\\" ."img". "\\";
        $miArchivo .=  "/" ."img". "/";
        $miArchivo .= sha1($_SESSION["email"]) . "." . $file_extension;
        // Actualizar extensión archivo perfil usuario
        $rstExtImagen = usuarioUpdExtImagen($_SESSION["email"],$file_extension );
        if($rstExtImagen) {
          $_SESSION["extImagen"]  = $file_extension;
          move_uploaded_file( $file, $miArchivo);
        }
      } else {  // imagen de tamaño mayor a 1M.
         $mensajetexto[] ="El archivo supera 1M de tamaño";
        mensaje("incorrecto",$mensajetexto);
      }
    } else {
      $mensajetexto[] = "Error al subir el archivo, intenteló nuevamente";
      mensaje("incorrecto", $mensajetexto);
    }
  }
}

function usuarioGetfile(){
    $miArchivo =  dirname( __DIR__ . '../');
    //$miArchivo = 'sdfsdf/sr'
    // $miArchivo .=  "\\" ."img". "\\";
    $miArchivo .=  "/" ."img". "/";
    $miArchivo .= sha1($_SESSION["email"]) . '.' .  $_SESSION["extImagen"];  //  . $file_extension;
    if(file_exists( $miArchivo )){
      //return '.' . '\\' . 'assets' . '\\' . 'img' . '\\' . sha1($_SESSION["email"]) . '.' . $_SESSION["extImagen"];
      return '.' . '/' . 'assets' . '/' . 'img' . '/' . sha1($_SESSION["email"]) . '.' . $_SESSION["extImagen"];
    } else {
      return "";
    }

}

function usuarioUpdPassword($email, $oldPassword, $newPassword, $valPassword){
  $errores = [];
	$mensajetexto = [];
  // VALIDAR SI NUEVA CLAVE Y VALIDACIÓN SON LO MISMO .. ANTES DE HACER OPERATORIA
  if( $newPassword == $valPassword){
    if (!empty($email) )  {
      // Se informó el mail
			$usuario = 'root';
			$contraseña = 'root';

			try	{

				$db = new PDO('mysql:host=localhost;port=3307;dbname=smartready', $usuario, $contraseña);

				 // 1* Buscar el usuario
				$statement = $db->prepare("SELECT id,name,lastname,email,password,extImagen FROM USER WHERE email=:email");
				$statement->bindParam(':email', $email);
				$statement->execute();
				$result = $statement->fetch(PDO::FETCH_ASSOC);
				if($statement->rowCount()>0)
				{
					$password = sha1($oldPassword);

					if ( $result["password"] == $password)
					{

						// Gestionar la sessión .
						// Actualizar la clave del usuario .
						$password = 	sha1($newPassword);

	 					$statement = $db->prepare("UPDATE USER SET password=:password WHERE email=:email");
	 					$statement->bindParam(':email', $email);
	 					$statement->bindParam(':password', $password);

						$statement->execute();

						$mensajetexto[] = 'Su clave ha sido modificada';
						mensaje('correcto', $mensajetexto );
						return 1;
					} else
					{
						$mensajetexto[] = 'La clave actual no corresponde';
						mensaje('incorrecto', $mensajetexto);
						return 0;
					}
		 		}
			} catch (Exception $ex ){
				$mensajetexto[] =  $ex->getMessage();
				mensaje('incorrecto', $mensajetexto);
				return 0 ;
			}
		} else {
			$mensajetexto[] = 'No se ingresó identificación de usuario para cambio de clave';
			mensaje('incorrecto', $mensajetexto);
			return 0 ; // Debe informar el mail
		}
	} else {
			$mensajetexto[] = 'La nueva calve y su validación no coinciden';
			mensaje('incorrecto', $mensajetexto);
			return 0 ; // Debe informar el mail
	}
}

function usuarioUpdExtImagen($email, $extImagen){
  $errores = [];
  // VALIDAR SI NUEVA CLAVE Y VALIDACIÓN SON LO MISMO .. ANTES DE HACER OPERATORIA

    if (!empty($email) )  {
      // Se informó el mail

				// Se informó el mail
				$usuario = 'root';
				$contraseña = 'root';

				try	{

					$db = new PDO('mysql:host=localhost;port=3307;dbname=smartready', $usuario, $contraseña);

					 // 1* Buscar el usuario
					$statement = $db->prepare("SELECT id,name,lastname,email,password,extImagen FROM USER WHERE email=:email");
					$statement->bindParam(':email', $email);
					$statement->execute();
					$result = $statement->fetch(PDO::FETCH_ASSOC);
					if($statement->rowCount()>0)
					{


							// Gestionar la sessión .
							// Actualizar la clave del usuario .


							$statement = $db->prepare("UPDATE USER SET extImagen=:extImagen WHERE email=:email");
							$statement->bindParam(':email', $email);
							$statement->bindParam(':extImagen', $extImagen);

							$statement->execute();

							$mensajetexto[] = 'Su imagen fué modificada';
							mensaje('correcto', $mensajetexto );
							return 1;

					}
				} catch (Exception $ex ){
					$mensajetexto[] =  $ex->getMessage();
					mensaje('incorrecto', $mensajetexto);
					return 0 ;
				}
    } else {
        // echo "Ups!!! de file";
        $mensajetexto[] = 'No hay usuario para cambio de clave';
        mensaje('incorrecto', $mensajetexto);
        return 0 ; // Debe informar el mail
    }

}
