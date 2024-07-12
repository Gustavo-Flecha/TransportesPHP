<?php
function Validar_Datos()
{
    $vMensaje = "";  
    
    //con esto aseguramos que limpiamos espacios y limpiamos de caracteres de codigo ingresados
    foreach ($_POST as $Id => $Valor) {
        $_POST[$Id] = trim($_POST[$Id]);
        $_POST[$Id] = strip_tags($_POST[$Id]);
    }
    
    if (strlen($_POST['MARCA']) == 0 ) {
        $vMensaje .= 'Debe seleccionar una Marca de Camión. <br />';
    }
    if (empty($_POST['MODELO'])) {
        $vMensaje .= 'Debes ingresar un Modelo. <br />';
    }
    if (strlen($_POST['ANIO']) < 4 ) {
        $vMensaje .= 'Debes ingresar el Año del modelo. <br />';
    }
    if (strlen($_POST['PATENTE']) < 6 ) {
        $vMensaje .= 'Debes ingresar una Patente válida. <br />';
    }
    if (($_POST['HABILITADO']) == 0 ) {
        $vMensaje .= 'Marque "Habilitado" para hacerlo disponible . <br />';
    }
    return $vMensaje;
    }

function DatoRequerido()
{
    $DatoFaltante = Validar_Datos(); 
    if (strpos($DatoFaltante, "Marca") !== false) {
        $DatoFaltante = "Marca";
    } elseif (strpos($DatoFaltante, "Modelo") !== false) {
        $DatoFaltante = "Modelo";
    } elseif (strpos($DatoFaltante, "Patente") !== false) {
        $DatoFaltante = "Patente";
    }else $DatoFaltante = "";
    return $DatoFaltante;
}
