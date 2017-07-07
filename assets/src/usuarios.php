<?php

require_once "validaciones.php";

function guardarUsuario($nombre, $apellido, $email, $usuario, $password)
{
    // Validar!
    $errores = validarUsuario($nombre, $apellido, $email, $usuario, $password);

    if (empty($errores)) {
        // No hubo errores
        $password = sha1($password);

        // Transformarlo a json
        $jsonUser = json_encode([
            'name'      => $nombre,
            'lastname'   => $apellido,
            'email'     => $email,
            'user'      => $usuario,
            'password'  => $password
        ]);

        $fp = fopen("users.json", "a+");
        $resultado = fwrite($fp, $jsonUser . PHP_EOL);
        fclose($fp);
        return $resultado;
    } else {
        // Hubo errores
        return $errores;
    }
}

function validarUsuario($nombre, $apellido, $email, $usuario, $password)
{
    $errores = [];

    if (! validarNombreOApellido($nombre, 1)) {
        $errores['name'] = "El nombre es invalido";
    }

    if (! validarNombreOApellido($apellido, 2)) {
        $errores['lastname'] = "El apellido no es valido";
    }

    if (! validarEmail($email)) {
        $errores['email'] = "El mail ingresado no es valido" ;
    }

    if (! validarNombreDeUsuario($usuario)) {
        $errores['username'] = "El username ingresado no es valido";
    }

    if (! validarPassword($password)) {
        $errores['password'] = "El password ingresado no es valido";
    }

    return $errores;
}
