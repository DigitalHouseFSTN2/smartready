<?php
function navGet()
{
    // Validar!

    $navHtml = '<!-- navigation menu goes in here -->';
    $navHtml = $navHtml . '<div class="container-fluid">';
    $navHtml = $navHtml . '  <div class="navbar-header">';
    $navHtml = $navHtml . '        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">';
    $navHtml = $navHtml . '            <span class="sr-only">Toggle navigation</span>';
    $navHtml = $navHtml . '            <span class="icon-bar"></span>';
    $navHtml = $navHtml . '           <span class="icon-bar"></span>';
    $navHtml = $navHtml . '           <span class="icon-bar"></span>';
    $navHtml = $navHtml . '       </button>';
    $navHtml = $navHtml . '       <a class="navbar-brand" href="#">SmartReady</a>';
    $navHtml = $navHtml . '     </div>';
    $navHtml = $navHtml . '     <div id="navbar" class="navbar-collapse collapse">';
    $navHtml = $navHtml . '       <ul class="nav navbar-nav">';
    $navHtml = $navHtml . '         <li class="icon-link">';
    $navHtml = $navHtml . '           <a href="home.php"><i class="fa fa-home"></i></a>';
    $navHtml = $navHtml . '         </li>';
    $navHtml = $navHtml . '         <li class="dropdown">';
    $navHtml = $navHtml . '           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quienes somos <span class="caret"></span></a>';
    $navHtml = $navHtml . '           <ul class="dropdown-menu">';
    $navHtml = $navHtml . '             <li><a href="home.php">Acercad de</a></li>';
    if(empty($_SESSION['email'])){
      
      $navHtml = $navHtml . '         <li role="separator" class="divider"></li>';
      $navHtml = $navHtml . '         <li><a href="login.php">Ingreso</a></li>';
      $navHtml = $navHtml . '         <li><a href="register.php">Registracion</a></li>';
    } else {
      $navHtml = $navHtml . '         <li><a href="user.php">Usuario</a></li>';
    }


    $navHtml = $navHtml . '       </ul>';
    $navHtml = $navHtml . '     </li>';
    $navHtml = $navHtml . '     <li>';
    $navHtml = $navHtml . '           <a href="service.php">Servicios</a>';
    $navHtml = $navHtml . '         </li>';
    $navHtml = $navHtml . '         <li>';
    $navHtml = $navHtml . '           <a href="plans.php">Planes</a>';
    $navHtml = $navHtml . '         </li>';
    $navHtml = $navHtml . '       </ul>';
    $navHtml = $navHtml . '           <ul class="nav navbar-nav navbar-right">';
    $navHtml = $navHtml . '         <li><a href="#"><i class="fa fa-twitter"></i></a></li>';
    $navHtml = $navHtml . '         <li><a href="#"><i class="fa fa-facebook"></i></a></li>';
    $navHtml = $navHtml . '         <li><a href="#"><i class="fa fa-linkedin"></i></a></li>';
    $navHtml = $navHtml . '         <li><a href="#"><i class="fa fa-google-plus"></i></a></li>';
    $navHtml = $navHtml . '       </ul>';
    $navHtml = $navHtml . '     </ul>';
    $navHtml = $navHtml . '     <!--/.nav-collapse -->';
    $navHtml = $navHtml . '   </div><!--/.container-fluid -->';

    return $navHtml;
}
