<?php

function validarNombreOApellido($nombreOApellido, $longitudMinima)
{

    $nombreOApellido = trim($nombreOApellido);
    
    return ! empty($nombreOApellido) &&
        ctype_alpha($nombreOApellido) &&
        strlen($nombreOApellido) > $longitudMinima;
}

function validarEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarNombreDeUsuario($nombreDeUsuario)
{
    $nombreDeUsuario = trim($nombreDeUsuario);

    return !empty($nombreDeUsuario) &&
        strlen($nombreDeUsuario) > 7;
}

function validarPassword($password)
{
    $password = trim($password);

    return !empty($password) &&
        strlen($password) > 7;
}
