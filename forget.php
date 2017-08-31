<?php
  require_once "./assets/src/validate.php";
  require_once "./assets/src/user_to_file.php";

  session_start();

  // var_dump($_REQUEST);
  $fueCompletado = isset($_REQUEST['submitted']); // campo input no visible
  if ($fueCompletado){
      $rslt = usuarioAccess($_REQUEST['email'], $_REQUEST['password']);
      // echo "<br> resultado usaurioAcces " . $rslt . "<br>";
      if ( $rslt )
      {
        //echo "<br> usuario válido <br>" ;
        header("Location:home.php");
        // Guardar en session usuario y modo
      } else
      {

          // echo "<br> usuario inválido <br>";
      }
  } else {

    // Set session variables


  }
  // Si fue completado.. validar y si es válido.. acceder modo 'IN' .. habría que incorporar el uso de websession.. formato json.
  // Si fue completado y hay errores, informar el error de logín.
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
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="panel panel-info" >
            <div class="panel-heading">
              <div class="panel-title">Recuperar su clave</div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
              <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

              <form id="olvidarform"  action='home.php' method='post' class="form-horizontal" role="form">

                  <input type='hidden' name='submitted' id='submitted' value='1'/>

                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <?php
                        if($fueCompletado){
                        echo '<input id="login-email" type="text" class="form-control" name="email" value="' . $_REQUEST["email"] . '" placeholder="email">';
                      } else {
                        echo '<input id="login-email" type="text" class="form-control" name="email" value="" placeholder="email">';
                      }
                      ?>
                  </div>
                  <div style="margin-top:10px" class="form-group">
                      <!-- Button -->
                      <div class="col-sm-12 controls">
                        <input id="btn-login" class="btn btn-success" type='submit' value='Solicitar cambio de clave' />
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >

                        </div>
                      </div>
                  </div>

                </form>
            </div>
          </div>
        </div>

      </div>
    </section>


    <?php   // PRESENTACIÓN DEL SERVICIO
      include('./assets/src/inc_presentacion.php');
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
