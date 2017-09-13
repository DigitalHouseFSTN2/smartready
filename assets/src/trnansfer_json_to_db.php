<?php

	require_once "validate.php";
	require_once "messages.php";
	require_once "user_to_db.php";

	function transferUser()  {
	  $mensajetipo = "";
	  $mensajetexto =  array();

    // buscar archivo json.. recorrerlo hasta encontrar mail.
    $filecuentas = @fopen("accountUser.json", "r");

    // echo "Lectura archivo <br>";

    if ($filecuentas) {

      while (($linea = fgets($filecuentas, 4096)) !== false) {

      	// echo "Linea" . $linea . '<br>' ;
	      $regUsuario = json_decode($linea, true);
				$resultado = usuarioTransfer($regUsuario["name"],  $regUsuario["lastname"], $regUsuario["email"], $regUsuario['password']); 

	          // Falta interpretar la linea como json y tomar el dato de mail para validar que sea el mismo ..
	          // luego comparar con la clave.
	    }

      if (!feof($filecuentas)) {
        $mensajetexto[] = 'No pudo accederse a la base de usuarios, por favor reintente !';
        mensaje('incorrecto', $mensajetexto);
        return 0;
      }
      fclose($filecuentas);
    } else {
	        $mensajetexto[] = 'No pudo accederse a la base de usuarios, por favor reintente !';
	        mensaje('incorrecto', $mensajetexto);
	        // echo "Ups!!! de file";
	        return 0 ; //"Ups!!! detectamos un inconveniente de conección intente mas tarde";
	  }
	}
?>
