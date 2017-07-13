

<?php
//require_once ('./style.php');
//  include('./style.php');
?>

<?php

$result = '';


function mensaje($mensajetipo, $mensajetexto){

//var_dump($mensajetipo);
//var_dump($mensajetexto);


if ($mensajetipo == 'correcto') {

echo  "<div class='alert alert-success fade in'>";
echo  "   <button type='button' class='close' data-dismiss='alert'>&times;</button>";
echo  "   <strong>Correcto!</strong> La acción fue realizada correctamente";
echo  "</div>";

}

else {
  if ($mensajetipo == 'incorrecto') {
   echo  "<div class='alert alert-danger fade in'>";
   echo  "   <button type='button' class='close' data-dismiss='alert'>&times;</button>";
   echo  "   <strong>Atención !</strong> -   $mensajetexto" ;
   echo  "</div>";
 }
}

}





?>
