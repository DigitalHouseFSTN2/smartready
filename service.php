<?php

  session_start();
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

    <?php // PRESENTACIÓN DEL SERVICIO
      include('./assets/src/inc_servicios.php');
      include('./assets/src/inc_presentacion.php');
    ?>
	  <section id="carousel">
		  <div id="myCarousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
				  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			 	  <li data-target="#myCarousel" data-slide-to="1"></li>
				  <li data-target="#myCarousel" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
				  <div class="item active">
					  <div class="carousel-caption">
						  <h3>Chicago</h3>
						  <p>Thank you, Chicago!</p>
					  </div>
				    <img src="./assets/img/slides/la.jpg" alt="Los Angeles">
				  </div>
				  <div class="item">
				    <img src="./assets/img/slides/ny.jpg" alt="Chicago">
			    </div>
			    <div class="item">
			      <img src="./assets/img/slides/chicago.jpg" alt="New York">
			    </div>
		    </div>

  		  <!-- Left and right controls -->
  		  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    			<span class="glyphicon glyphicon-chevron-left"></span>
  	  		<span class="sr-only">Previous</span>
  		  </a>
  		  <a class="right carousel-control" href="#myCarousel" data-slide="next">
  			  <span class="glyphicon glyphicon-chevron-right"></span>
  			  <span class="sr-only">Next</span>
  		  </a>
		  </div>
	  </section> <!-- Carousel -->


    <?php // INFORMACIÓN DE NOSTROS
      // include('./assets/src/we_are.php');
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
