<?php

	require_once "validate.php";
	require_once "messages.php";
	require_once "user_to_db.php";

	function createTable() {
		    $usuario = 'root';
		    $contraseña = 'root';
		    $db = new PDO('mysql:host=localhost;port=3307;dbname=smartready', $usuario, $contraseña);
		    $db->beginTransaction();

		    try{
		      // 1* Buscar el usuario

		      $statement = $db->prepare("CREATE TABLE user (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,name VARCHAR(100) NULL, lastname VARCHAR(100) NULL,email VARCHAR(200) NOT NULL, password VARCHAR(128) NOT NULL, remember TINYINT UNSIGNED DEFAULT 0 NOT NULL, cookie_rnd INT UNSIGNED DEFAULT 0 NOT NULL, extImagen CHAR(4) NULL
					);");


		      $statement->execute();
		      $db->commit();
		    } catch (PDOException $e) {
					echo $e->getMessage;
		      $db->rollBack();
		      // echo $ex->getMessage();
		    }

	}
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
		
				$resultado = usuarioTransfer($regUsuario["name"],  $regUsuario["lastname"], $regUsuario["email"], $regUsuario['password'],$regUsuario["remember"],$regUsuario["cookie_rnd"],$regUsuario["extImagen"]);


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
