<?php
function Validar_Datos()
{
    $vMensaje = "";

    // <!--  <-<-<-con esto aseguramos que limpiamos espacios y caracteres de codigo ingresadosc->->->  -->
    foreach ($_POST as $Id => $Valor) {
        $_POST[$Id] = trim($_POST[$Id]);
        $_POST[$Id] = strip_tags($_POST[$Id]);
    }
    
    if (strlen($_POST['APELLIDO']) < 3) {
        $vMensaje .= 'Debes ingresar un Apellido con al menos 3 caracteres. <br />';
    }
    if (strlen($_POST['NOMBRE']) < 3) {
        $vMensaje .= 'Debes ingresar un Nombre con al menos 3 caracteres. <br />';
    }
    if (strlen($_POST['DNI']) < 7) {
        $vMensaje .= 'Debes ingresar un DNI válido. <br />';
    }
    if (empty($_POST['USUARIO'])) {
        $vMensaje .= 'Debes crear tu usuario. <br />';
    } elseif (strlen($_POST['USUARIO']) < 5) {
        $vMensaje .= 'Su usuario debe tener al menos 5 caracteres. <br />';
    } elseif (!ctype_alnum($_POST['USUARIO'])) {
        $vMensaje .= 'Su usuario debe contener sólo letras y números sin más. <br />';
    }
    if (strlen($_POST['PASS']) == 0) {
        $vMensaje .= 'Debes crear la clave. <br />';
    } elseif (strlen($_POST['PASS']) < 5) {
        $vMensaje .= 'La clave debe tener al menos 5 caracteres. <br />';
    } elseif (!preg_match('/[A-Z]/', $_POST['PASS'])) {
        $vMensaje .= 'La clave debe contener al menos una letra mayúscula. <br />';
    } elseif (!preg_match('/[a-z]/', $_POST['PASS'])) {
        $vMensaje .= 'La clave debe contener al menos una letra minúscula. <br />';
    } elseif (!preg_match('/[0-9]/', $_POST['PASS'])) {
        $vMensaje .= 'La clave debe contener al menos un número. <br />';
    }
    return $vMensaje;
}

function DatoRequerido()
{
    $DatoFaltante = Validar_Datos();
    if (strpos($DatoFaltante, "Apellido") !== false) {
        $DatoFaltante = "Apellido";
    } elseif (strpos($DatoFaltante, "Nombre") !== false) {
        $DatoFaltante = "Nombre";
    } elseif (strpos($DatoFaltante, "DNI") !== false) {
        $DatoFaltante = "DNI";
    } else $DatoFaltante = "";

    return $DatoFaltante;
}
