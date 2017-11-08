<?php
require_once("userPOO.php");
require_once("dbPOO.php");

public function __construct() {
	$dsn = 'mysql:host=localhost;dbname=reglog;charset=utf8mb4;port=3307';
	$user ="root";
	$pass = "root";

	try {
		$this->conn = new PDO($dsn, $user, $pass);
	} catch (Exception $e) {
		echo "La conexion a la base de datos falló: " . $e->getMessage();
	}
}
public function usuarioFindMial($mail){}
public function usuarioTransfer($nombre, $apellido, $email, $password,$remember,$cookie,$extImagen){}
public function usuarioFindMail($mail){}
public function usuarioAccess($mail,$password){}
public function usuarioVal($nombre, $apellido, $email, $password, $valPassword){}
public function usuarioSetFile(){}
public function usuarioGetfile(){}
public function usuarioUpdPassword($email, $oldPassword, $newPassword, $valPassword){}
public function usuarioUpdExtImagen($email, $extImagen){}
?>
