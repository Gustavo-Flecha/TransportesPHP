<?php
function Validar_Datos()
{
    $vMensaje = "";  

    if (strlen($_POST['APELLIDO']) < 3) {
        $vMensaje .= 'Debes ingresar un Apellido con al menos 3 caracteres. <br />';
    }
    if (strlen($_POST['NOMBRE']) < 3) {
        $vMensaje .= 'Debes ingresar un Nombre con al menos 3 caracteres. <br />';
    }
    if (strlen($_POST['DNI']) < 8) {
        $vMensaje .= 'Debes ingresar un DNI válido. <br />';
    }
    if (empty($_POST['USUARIO'])) {
        $vMensaje .= 'Debes ingresar tu usuario. <br />';
    }
    if (strlen($_POST['PASS']) == 0) {
        $vMensaje .= 'Debes ingresar la clave. <br />';
    }
    //con esto aseguramos que limpiamos espacios y limpiamos de caracteres de codigo ingresados
    foreach ($_POST as $Id => $Valor) {
        $_POST[$Id] = trim($_POST[$Id]);
        $_POST[$Id] = strip_tags($_POST[$Id]);
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
    }else $DatoFaltante = "";

    return $DatoFaltante;
}
