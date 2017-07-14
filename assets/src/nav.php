  <nav class="navbar navbar-inverse">
  <!-- navigation menu goes in here -->
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">SmartReady</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="icon-link">
          <a href="home.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quienes somos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="home.php">Acerca de</a></li>
            <?php
              if(empty($_SESSION['email'])){
                echo '<li role="separator" class="divider"></li>';
                echo '<li><a href="login.php">Ingreso</a></li>';
                echo '<li><a href="register.php">Registracion</a></li>';
              } else {
                echo '<li><a href="user.php">Usuario</a></li>';
                echo '<li><a href="cambioclave.php">Cambio de clave</a></li>';
              }
            ?>
          </ul>
        </li>
        <li>
          <a href="service.php">Servicios</a>
        </li>
        <li>
            <a href="plans.php">Planes</a>
        </li>
        <?php
          if(!empty($_SESSION['email'])){
            echo '<li>';
            echo  '<a href="salir.php">Salir</a>';
            echo  '</li>';
          }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-user"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
      </ul>
    </ul>
    <!--/.nav-collapse -->
  </div><!--/.container-fluid -->
</nav>
