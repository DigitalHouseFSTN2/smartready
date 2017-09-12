<?php // START PHP

  session_start();


	include "./assets/src/datasource.conf";

	if($data_source=="DBAS"){
  	require_once "./assets/src/user_to_db.php";
	} else {
		require_once "./assets/src/user_to_file.php";
	}

  if (!empty($_FILES["user-file"])){
    usuarioSetFile();
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
              <div class="panel-title" style="float:right; font-size: 80%; position: relative; top:-10px"><a href="forget.php">Olvidó su clave?</a></div>
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
                  <div class="input-group col-md-12">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8 center-block">
                        <div class="card col-md-12" >
                          <div class="center-block">
                            <?php
                              $fileUserView = usuarioGetfile();
                              if( strlen($fileUserView) ){
                                echo '<img id="img-perfil" class="card-img-top img-circle center-block" src="' . $fileUserView . '" alt="Card image cap">';
                              } else {
                                echo  '<img class="card-img-top" src="..." alt="Card image cap">';
                              }
                            ?>
                          </div>

                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                  <div class="input-group col-md-12">
                    <div class="card-block">
                      <h4 class="card-title text-center">Avatar del Perfil</h4>
                      <div style="margin-bottom: 25px" class="input-group">

                        <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                        <span></span>
                        <input type="file" id="login-file" class="form-control input-file-novisible" name="user-file" aria-label="Amount (to the nearest dollar)">
                      </div>
                    </div>
                  </div>
                  <div style="margin-top:10px" class="col-md-12">
                      <!-- Button -->
                      <div class="col-sm-12 controls center-block">
                        <input id="btn-login" class="btn btn-success center-block" type='submit' value='Actualizar imagen' />
                      </div>
                  </div>

                </form>
            </div>
          </div>
        </div>

      </div>
    </section>

    <?php // INFORMACIÓNO DEL SERVICIO
      include('./assets/src/inc_presentacion.php');    ?>

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
