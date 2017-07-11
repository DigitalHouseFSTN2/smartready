<?php
  require_once "./assets/src/nav.php";
  require_once "./assets/src/Libreries.php";

  session_start();

  if(isset($_SESSION['email'])){
    //echo "hay datos de session";
  } else {
    $_SESSION['email']='';
  }
  
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
  		card--default, .card--disabled {
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
		    echo navGet( );
      ?>
		</nav>
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
	  <section id="nosotros" class="section section-color-3">
	    <div class="container">
		    <h2 class="section__title">PROFESORES</h2>
    		<div class="col-xs-12 col-md-6 col-lg-4 col-flexbox">
    			<div class="list-post list-post--margin">
    				<div class="card card--default card--disabled">
    					<div class="card__header card__header--sm-media">
    						<img class="card__img img-circle card__img--gray" src="https://www.digitalhouse.com/wp-content/uploads/2017/01/pic00-e1484066057541_200x200_acf_cropped.png" alt="">
    						<h4 class="card__title">PABLO ABREU</h4>
    					</div>
    					<div class="card__body"><p class="card__description">
    						</p><p>
						    <strong><em>Data Scientist</em></strong><br> Ingeniero Industrial con experiencia como Data Scientist en la industria, desarrollando algoritmos para predicci�n y an�lisis de datos. Apasionado por la docencia, la matem�tica, machine learning y Python.</p><p></p>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="col-xs-12 col-md-6 col-lg-4 col-flexbox">
    			<div class="list-post list-post--margin">
    				<div class="card card--default card--disabled">
    					<div class="card__header card__header--sm-media">
    						<img class="card__img img-circle card__img--gray" src="https://www.digitalhouse.com/wp-content/uploads/2017/01/pic00-e1484066057541_200x200_acf_cropped.png" alt="">
    						<h4 class="card__title">PABLO ABREU</h4>
    					</div>
    					<div class="card__body"><p class="card__description">
    						</p><p>
    						<strong><em>Data Scientist</em></strong><br> Ingeniero Industrial con experiencia como Data Scientist en la industria, desarrollando algoritmos para predicci�n y an�lisis de datos. Apasionado por la docencia, la matem�tica, machine learning y Python.</p><p></p>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="col-xs-12 col-md-6 col-lg-4 col-flexbox">
    			<div class="list-post list-post--margin">
    				<div class="card card--default card--disabled">
    					<div class="card__header card__header--sm-media">
    						<img class="card__img img-circle card__img--gray" src="https://www.digitalhouse.com/wp-content/uploads/2017/01/pic00-e1484066057541_200x200_acf_cropped.png" alt="">
    						<h4 class="card__title">PABLO ABREU</h4>
    					</div>
    					<div class="card__body"><p class="card__description">
    						</p><p>
    						<strong><em>Data Scientist</em></strong><br> Ingeniero Industrial con experiencia como Data Scientist en la industria, desarrollando algoritmos para predicci�n y an�lisis de datos. Apasionado por la docencia, la matem�tica, machine learning y Python.</p><p></p>
    					</div>
    				</div>
    			</div>
    		</div>
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
      echo libreriesGet();
    ?>
</body>
</html>
