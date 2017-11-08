<?php

class Usuario {
  private $id;
	private $name;
	private $lastname;
	private $email;
	private $password;
	private $remember;
	private $cookie_rnd;
	private $extimage;


  public function __construct(Array $datos) {
    $this->name = $datos["name"];
    $this->lastname = $datos["lastname"];
    $this->email = $datos["email"];
    $this->remember = "";
		$this->cookie_rnd = "";
		$this->extImage = "";
    if (isset($datos["id"])) {
      $this->password = $datos["password"];
      $this->id = $datos["id"];
    } else {
      $this->password = password_hash($datos["password"], PASSWORD_DEFAULT);
    }
  }

  public function guardarImagen() {
    $nombre=$_FILES["avatar"]["name"];
    $archivo=$_FILES["avatar"]["tmp_name"];

    $ext = pathinfo($nombre, PATHINFO_EXTENSION);

    $miArchivo = "img/" . $this->getEmail() . "." . $ext;

    move_uploaded_file($archivo, $miArchivo);
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPais($pais) {
    $this->pais = $pais;
  }

  public function getPais() {
    return $this->pais;
  }

  public function setEdad($edad) {
    $this->edad = $edad;
  }

  public function getEdad() {
    return $this->edad;
  }

  public function setUsername($username) {
    $this->username = $username;
  }

  public function getUsername() {
    return $this->username;
  }

}


?>
