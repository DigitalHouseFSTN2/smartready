<?php // START PHP

  session_start();

  var_dump($_REQUEST);
  require_once "./assets/src/usuarios.php";

  if (!empty($_FILES["user-file"])){
    if($_FILES["user-file"]["error"] == UPLOAD_ERR_OK){     // NO HAY ERRORES
      var_dump($_FILES);
      $file_name  = $_FILES["user-file"]["name"];           // "IMG_20170625_164044.jpg"
      $file_type  = $_FILES["user-file"]["type"];           // "image/jpeg"
      $file       = $_FILES["user-file"]["tmp_name"];       // "C:\xampp\tmp\phpFBF0.tmp"
      $file_error = $_FILES["user-file"]["error"];          //
      $file_size  = $_FILES["user-file"]["size"];           // int(752014)
      $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
      if(  ($file_size / 1024) < 1024 ){
        $miArchivo = dirname(__FILE__);
        $miArchivo .= "/img/";
        $miArchivo .= $_SESSION["password"] . "." . $file_extension;
        move_uploaded_file( $file, $miArchivo);
      } else {  // imagen de tamaño mayor a 1M.
        mensaje("incorrecto","El archivo supera 1M de tamaño");
      }
    } else {
      mensaje("incorrecto", "Error al subir el archivo, intenteló nuevamente");
    }
  }


    $fueCompletado = isset($_REQUEST['submitted']);
    // VALIDAR EXISTENCIA DE IMAGEN Y ACTUALIZAR IMAGEN
    if($fueCompletado ){
      //$resultado = usuarioSet($_REQUEST['username'],$_REQUEST['lastname'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['repassword'] );
    }
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <title>SmartReady - IoT</title>

    <?php  // ESTILOS PERSONALIZADOS
      include('./assets/src/style.php');     ?>

  </head>
  <body>
	<div class="container">
	  <header>
		  <!-- header content goes in here -->
	  </header>

	  <?php // BARRA DE NAVEGACIÓN
      include("assets/src/nav.php");    ?>

    <section class="login">
      <div class="container">
        <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="panel panel-info" >
            <div class="panel-heading">
              <div class="panel-title">Datos del usuario</div>
              <div class="panel-title" style="float:right; font-size: 80%; position: relative; top:-10px"><a href="olvido.php">Olvidó su clave?</a></div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
              <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
              <form id="loginform" action='user.php' method='post' enctype="multipart/form-data" class="form-horizontal" role="form">
                  <input type='hidden' name='submitted' id='submitted' value='1'/>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <?php
                        if( empty($_SESSION["name"]) ){
                          echo '<input id="register-username" type="text" class="form-control" name="username" value="" placeholder="Cual es tu nombre?">';
                        } else {
                          echo '<input id="register-username" type="text" class="form-control" name="username" value="' . $_SESSION["name"] . '" placeholder="Cual es tu nombre?" disabled>';
                        }
                      ?>
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <?php
                      if( empty($_SESSION["name"] )){
                        echo '<input id="register-email" type="text" class="form-control" name="email" value="" placeholder="Ingresa tu e-mail">';
                      } else {
                        echo '<input id="register-email" type="text" class="form-control" name="email" value="' . $_SESSION["email"] . '" placeholder="Ingresa tu e-mail" disabled>';
                      }
                    ?>
                  </div>
                  <div class="input-group">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <div class="card col-md-12" >
                          <div class="centered">
                            <img class="card-img-top" src="..." alt="Card image cap">
                          </div>
                          <div class="card-block">
                            <h4 class="card-title">Imagen</h4>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                            <span></span>
                            <input type="file" id="login-file" class="form-control input-file-novisible" name="user-file" aria-label="Amount (to the nearest dollar)">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                  <div style="margin-top:10px" class="form-group">
                      <!-- Button -->
                      <div class="col-sm-12 controls">
                        <input id="btn-login" class="btn btn-success" type='submit' value='Actualizar imagen' />
                      </div>
                  </div>

                </form>
            </div>
          </div>
        </div>

      </div>
    </section>

    <?php // INFORMACIÓNO DEL SERVICIO
      include('./assets/src/presentacion.php');    ?>

    <aside>
		  <!-- aside content goes in here -->
	  </aside>
	</div> <!-- containder -->
  <footer>
    <!-- footer content goes in here -->
  </footer>
    <!-- Bootstrap core JavaScript from LibreriesGet() ================================================== -->
    <?php //  LIBRERIAS
      include("assets/src/libreries.php") ;     ?>
</body>
</html>
