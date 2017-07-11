<?php
  require_once "./assets/src/validaciones.php";
  require_once "./assets/src/usuarios.php";

  session_start();

  // var_dump($_REQUEST);
  $fueCompletado = isset($_REQUEST['submitted']); // campo input no visible
  if ($fueCompletado){
      $rslt = usuarioAccess($_REQUEST['email'], $_REQUEST['password']);
      // echo "<br> resultado usaurioAcces " . $rslt . "<br>";
      if ( $rslt )
      {
        //echo "<br> usuario válido <br>" ;
        echo ("<SCRIPT LANGUAJE='JavaScript')>window.location.href='home.php'; </SCRIPT>");
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

	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/lib/css/style.css">
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.red.css">
    <link rel="stylesheet" href="assets/lib/fonts/font-awesome.min.css">

  	<style>
  		.header {
  			background-color: black;
  		}
  		.navbar {
  			margin-bottom:8px;
  		}
  		.jumbotron {
  			margin-bottom: 0px;
  		}
  		.section-color-3 {
  			background-color: #a91b0c;;
  		}
  		.section__title {
  			text-align: center;
  		}
  		.card--disabled:focus, .card--disabled:hover {
  			cursor: default;
  			background-color: #FFF;
  		}
  		.section__title {
  			margin-top: 5px;
  			margin-bottom: 46px;
  		}
  		.card__img--gray {
  			-webkit-filter: grayscale(100%);
  			-moz-filter: grayscale(100%);
  			-ms-filter: grayscale(100%);
  			-o-filter: grayscale(100%);
  			filter: grayscale(100%);
  			width: 140px;
  		}
      .panel-info {
        border-color: #d9230f;
      }
      .panel-info>.panel-heading {
        color: #ffffff;
        background-color: #d9230f;
        border-color: #d9230f;
      }
  		.card--default, .card--disabled {
  			margin: 0px 30px 30px 0px;
  		}
  	</style>
  </head>
  <body>
	<div class="container">
	  <header>
		  <!-- header content goes in here -->
	  </header>
	  <nav class="navbar navbar-inverse">
		  <?php
        include("assets/src/nav.php");
      ?>

		</nav>
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
                        <input id="btn-login" class="btn btn-success" type='submit' value='Solitar cambio de clave' />
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
	  <section class="jumbotron">
  		<div class="container">
  		  <h1>Productos conectados en hogares inteligentes</h1>
  		  <h2>No es solo una cuestión de tener dispositivos Smart, sino conectarlos...</h2>
  	 	  <!-- <p class="text-muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p> -->
  		  <!--
    		<blockquote class="blockquote-reverse">
    			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
    			<small>Someone famous in <cite title="Source Title">Source Title</cite></small>
    		</blockquote>
    		-->
  		  <p class="text-primary">No es solo una cuestión de tener dispositivos Smart, sino conectarlos...</p>
  	  	<blockquote>
  		  	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
  			  <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
  		  </blockquote>
  		  <!--
    			<p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
    			<p class="text-danger">Donec ullamcorper nulla non metus auctor fringilla.</p>
    			<p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
    			<p class="text-info">Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
    		-->
  		  <p><a class="btn btn-primary btn-lg">Leer mas</a></p>
  		  <!-- sidebar content goes in here -->
  		</div>
  	</section>
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