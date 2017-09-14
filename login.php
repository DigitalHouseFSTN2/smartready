<?php
  require_once "./assets/src/validate.php";

	Include "./assets/src/datasource.conf";
	// $data_source = getenv("DATA_SOURCE");
	if($data_source=="DBAS"){
  	require_once "./assets/src/user_to_db.php";
	} else {
		require_once "./assets/src/user_to_file.php";
	}

  session_start();

  // var_dump($_REQUEST);

  $fueCompletado = isset($_REQUEST['submitted']); // campo input no visible

  if ($fueCompletado){

      $rslt = usuarioAccess($_REQUEST['email'], $_REQUEST['password']);
      // echo "<br> resultado usaurioAcces " . $rslt . "<br>";

      if ( $rslt )
        {

              header ("Location:home.php");

              //$mensajetexto = 'Autenticado correctamente !';
              //mensaje('correcto', $mensajetexto);

              // echo "Autenticado correctamente";
              //header ("Location: contenidos_protegidos_cookie.php");
              }

       else {

         $mensajetexto[] = 'Fallo de autenticación! !';
         mensaje('incorrecto', $mensajetexto);
         //echo "<p><a href='prueba-cookies.php'>Volver</a>";
     }
   }


?>



<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SmartReady - IoT</title>

    <?php
      // ESTILOS PERSONALIZADOS
      include('./assets/src/style.php');
    ?>



  </head>
  <body>
	<div class="container">
	  <header>
		  <!-- header content goes in here -->
	  </header>

	  <?php
      include("assets/src/nav.php");
    ?>

    <section class="login">
      <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="panel panel-info" >
            <div class="panel-heading">
              <div class="panel-title">Acceder</div>
              <div class="panel-title" style="float:right; font-size: 80%; position: relative; top:-10px"><a href="forget.php">Olvidó su clave?</a></div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
              <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

              <form id="loginform"  action='login.php' method='post' class="form-horizontal" role="form">

                  <input type='hidden' name='submitted' id='submitted' value='1'/>

                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <?php
                        if($fueCompletado){
                        echo '<input id="login-email" type="text" class="form-control" name="email" value="' . $_REQUEST["email"] . '" placeholder="email">';
                      } else {
                        // buscar cookie .. si hay .. igual que lina anterior.. pero con email de cookie
                        // si no hay cookie.. dejar linea que sigue.
                        echo '<input id="login-email" type="text" class="form-control" name="email" value="" placeholder="email">';
                      }
                      ?>
                  </div>

                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="clave">
                  </div>

                <!--
                  <div class="input-group">
                    <div class="checkbox">
                      <label>
                        <input id="login-remember" type="checkbox" name="remember" value="1"> Recuerdame por favor!!!
                      </label>
                    </div>
                  </div>
                -->

                  <div style="margin-top:10px" class="form-group">
                      <!-- Button -->
                      <div class="col-sm-12 controls">
                        <input id="btn-login" class="btn btn-success" type='submit' value='Acceder' />
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                          Si en verdad no tienes una cuenta!
                          <a href="register.php" onClick="$('#loginbox').hide(); $('#signupbox').show()"><strong>Registrate aquí</strong></a>
                        </div>
                      </div>
                  </div>

                </form>
            </div>
          </div>
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="panel panel-info" >
            <div class="panel-heading">
              <div class="panel-title">Registrarse</div>
              <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Olvidó su clave?</a></div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
              <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
              <form id="loginform"  action='login.php' method='post' class="form-horizontal" role="form">
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <?php
                        if($fueCompletado && isset($_REQUEST['username'])){
                          echo '<input id="register-username" type="text" class="form-control" name="username" value="' . $_REQUEST['username'] . '" placeholder="Cual es tu nombre?">';
                        } else {
                          echo '<input id="register-username" type="text" class="form-control" name="username" value="" placeholder="Cual es tu nombre?">';
                        }
                      ?>
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <?php
                      if($fueCompletado && isset($_REQUEST['email'])){
                        echo '<input id="register-email" type="text" class="form-control" name="email" value="' . $_REQUEST['email'] .  '" placeholder="Ingresa tu e-mail">';
                      } else {
                        echo  '<input id="register-email" type="text" class="form-control" name="email" placeholder="Ingresa tu e-mail">';
                      }
                    ?>
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span>
                      <input id="register-lastname" type="text" class="form-control" name="lastname" value="" placeholder="Cual es tu apellido?">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="register-password" type="password" class="form-control" name="password" placeholder="Una clave que puedas repetir">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="register-repassword" type="password" class="form-control" name="repassword" placeholder="Si.. aquí repites la calve (yo te avisé)">
                  </div>
                  <div class="input-group">
                    <div class="checkbox">
                      <label>
                        <input id="login-remember" type="checkbox" name="remember" value="1"> Recuerdame por favor!!!
                      </label>
                    </div>
                  </div>
                  <div style="margin-top:10px" class="form-group">
                      <!-- Button -->
                      <div class="col-sm-12 controls">
                        <input id="btn-login" class="btn btn-success" type='submit' value='Registrarse' />
                      </div>

                  </div>
                  <div class="form-group">
                      <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                          Tienes una cuenta y llegaste hasta aquí por curioso!
                          <a href="#" onClick="$('#loginbox').show(); $('#signupbox').hide()"><strong>Vuelve desde aquí</strong></a>
                        </div>
                      </div>
                  </div>
                </form>
            </div>
          </div>
        </div>

      </div>
    </section>


    <?php // PRESESNTACIÓN DEL SERVICIO
      include('./assets/src/html_presentation.php');
    ?>
    <aside>
		  <!-- aside content goes in here -->
	  </aside>
	</div> <!-- containder -->
  <footer>
    <!-- footer content goes in here -->
  </footer>
    <!-- Bootstrap core JavaScript from LibreriesGet() ================================================== -->
    <?php
      include("assets/src/libreries.php") ;
    ?>
</body>
</html>
