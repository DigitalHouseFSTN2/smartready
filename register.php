<?php
  require_once "./assets/src/usuarios.php";

  session_start();

  $fueCompletado = isset($_REQUEST['submitted']);
  if($fueCompletado){
    $resultado = usuarioSet($_REQUEST['username'],$_REQUEST['lastname'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['repassword'] );
    // var_dump($resultado);
    if( is_array($resultado) && !empty($resultado)){
      // Hubo errores
    } else {
      // no hubo errores.
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

    <?php // BARRA DE NAVEGACIÓN DEL SITIO
      include("assets/src/nav.php");
    ?>

    <section class="login">
        <div class="container">
          <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
              <div class="panel-heading">
                <div class="panel-title">Registrarse</div>
                <div class="panel-title" style="float:right; font-size: 80%; position: relative; top:-10px"><a href="olvido.php">Olvidó su clave?</a></div>
              </div>
              <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="loginform" action='register.php' method='post' class="form-horizontal" role="form">

                    <input type='hidden' name='submitted' id='submitted' value='1'/>

                    <div style="margin-bottom: 25px" class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <?php
                          if ( $fueCompletado && isset( $_REQUEST['username'])){
                            echo '<input id="register-username" type="text" class="form-control" name="username" value="' . $_REQUEST['username'] . '" placeholder="Cual es tu nombre?">';
                          } else {
                            echo '<input id="register-username" type="text" class="form-control" name="username" value="" placeholder="Cual es tu nombre?">';
                          }
                        ?>
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span>
                        <?php
                          if ( $fueCompletado && isset( $_REQUEST['lastname'])){
                            echo '<input id="register-lastname" type="text" class="form-control" name="lastname" value="' . $_REQUEST['lastname'] .  '" placeholder="Cual es tu apellido?">';
                          } else {
                            echo '<input id="register-lastname" type="text" class="form-control" name="lastname" value="" placeholder="Cual es tu apellido?">';
                          }
                        ?>
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                      <?php
                        if ( $fueCompletado && isset( $_REQUEST['email']) ){
                          echo  '<input id="register-email" type="text" class="form-control" name="email" value="' . $_REQUEST['email']  . '" placeholder="Ingresa tu e-mail">';
                        } else  {
                          echo  '<input id="register-email" type="text" class="form-control" name="email" value="" placeholder="Ingresa tu e-mail">';
                        }
                        ?>
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
                            <a href="login.php" onClick="$('#loginbox').show(); $('#signupbox').hide()"><strong>Vuelve desde aquí</strong></a>
                          </div>
                        </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>

        </div>
    </section>

    <?php // PRESENTACIÓN DEL SERVICIO
      include('./assets/src/presentacion.php');
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
