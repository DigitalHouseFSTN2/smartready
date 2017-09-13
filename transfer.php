<?php
  require_once "./assets/src/validate.php";
	require_once "./assets/src/trnansfer_json_to_db.php";
	require_once "./assets/src/messages.php";

	Include "./assets/src/datasource.conf";
	// $data_source = getenv("DATA_SOURCE");
	if($data_source=="DBAS"){
  	require_once "./assets/src/user_to_db.php";
	}

  // var_dump($_REQUEST);

  $fueCompletado = isset($_REQUEST['submitted']); // campo input no visible

  if ($fueCompletado){

		if($data_source=="DBAS"){

			$rslt = createTable();
	    $rslt = transferUser();
	    // echo "<br> resultado usaurioAcces " . $rslt . "<br>";
	  	header ("Location:home.php");
	} else {
		$mensajetexto[] = 'No se puede transferir al estar en conexión JSON !';
		mensaje('incorrecto', $mensajetexto);
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


    <section class="Transfer">
      <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="panel panel-info" >
            <div class="panel-heading">
              <div class="panel-title">Transferir de json a mysql </div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
              <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

              <form id="loginform"  action='transfer.php' method='post' class="form-horizontal" role="form">

                  <input type='hidden' name='submitted' id='submitted' value='1'/>


                  <div style="margin-top:10px" class="form-group">
                      <!-- Button -->
                      <div class="col-sm-12 controls">
                        <input id="btn-login" class="btn btn-success" type='submit' value='Transferir' />
                      </div>
                  </div>


                </form>
            </div>
          </div>
        </div>

      </div>
    </section>


    <?php // PRESESNTACIÓN DEL SERVICIO
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
