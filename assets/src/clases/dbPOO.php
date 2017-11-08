<?php

require_once("usuario.php");

abstract class db {

	public abstract function usuarioFindMial($mail);
	public abstract function usuarioTransfer($nombre, $apellido, $email, $password,$remember,$cookie,$extImagen);
	public abstract function usuarioFindMail($mail);
	public abstract function usuarioAccess($mail,$password) ;
	public abstract function usuarioVal($nombre, $apellido, $email, $password, $valPassword);
	public abstract function usuarioSetFile();
	public abstract function usuarioGetfile();
	public abstract function usuarioUpdPassword($email, $oldPassword, $newPassword, $valPassword);
	public abstract function usuarioUpdExtImagen($email, $extImagen);

}

?>
