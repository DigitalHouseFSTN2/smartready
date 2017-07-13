

<?php


function mensaje($mensajetipo, $mensajetexto){

//var_dump($mensajetipo);
//var_dump($mensajetexto);

if ($mensajetipo == 'correcto') {
echo  "<div class='alert alert-success fade in'>";
echo  "   <button type='button' class='close' data-dismiss='alert'>&times;</button>";
echo  "   <strong> Correcto!</strong> - ".$mensajetexto ;
echo  "</div>";
}

else {
  if ($mensajetipo == 'incorrecto') {
   echo  "<div class='alert alert-danger fade in'>";
   echo  "   <button type='button' class='close' data-dismiss='alert'>&times;</button>";
   echo  "   <strong> Error !</strong> - ".$mensajetexto ;
   echo  "</div>";
 }

 if ($mensajetipo == 'alerta') {
  echo  "<div class='alert alert-warning fade in'>";
  echo  "   <button type='button' class='close' data-dismiss='alert'>&times;</button>";
  echo  "   <strong> Atención !</strong> - ".$mensajetexto ;
  echo  "</div>";
  }
  else {

    if ($mensajetipo == 'aviso') {
     echo  "<div class='alert alert-info fade in'>";
     echo  "   <button type='button' class='close' data-dismiss='alert'>&times;</button>";
     echo  "   <strong> Información </strong> - ".$mensajetexto ;
     echo  "</div>";
   }
  }
 }
}


?>
