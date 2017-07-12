
<?php
  // ESTILOS PERSONALIZADOS
  include('./style.php');
?>

// traer por pamaretro el mensaje y tipo de advertencia

<html>
   <footer class="messages">
     <div class="container">

// separar por tipo de advertencia

// sin error
       <div class="row">
           <h5 class="noerror">Operación Exitosa</h5>
       </div>
// con error
       <div class="row">
           <h5 class="error">Ocurrió un error ! - , </h5>
       </div>

     </div>
   </footer>
</html>
