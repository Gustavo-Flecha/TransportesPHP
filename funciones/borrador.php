<?php
function Validar_Datos()
{
    $vMensaje = "";  
    
    //con esto aseguramos que limpiamos espacios y limpiamos de caracteres de codigo ingresados
    foreach ($_POST as $Id => $Valor) {
        $_POST[$Id] = trim($_POST[$Id]);
        $_POST[$Id] = strip_tags($_POST[$Id]);
    }

    if (strlen($_POST['CHOFER']) == 0 ) {
        $vMensaje .= 'Debe seleccionar una Marca de Camión. <br />';
    }
    if (strlen($_POST['TRANSPORTE']) == 0) {
        $vMensaje .= 'Debes seleccionar un Modelo. <br />';
    }
    // <!--  <-<-<- Validación de fecha en formato dd/mm/yyyy ->->->  -->
    if (strlen($_POST['FECHA']) < 10) {
        $vMensaje .= 'Debes ingresar la fecha del viaje. <br />';
    } else {
        $fecha = $_POST['FECHA'];
        $formato = 'd/m/Y';
        $dia = DateTime::createFromFormat($formato, $fecha);
        if (!($dia && $dia->format($formato) === $fecha)) {
            $vMensaje .= 'Debes ingresar una fecha válida en formato día/mes/año. <br />';
        } else {
            // <!--  <-<-<- Convertir la fecha al formato YYYY-MM-DD para MySQL ->->->  -->
            $fecha_mysql = $dia->format('Y-m-d');
            $_POST['FECHA'] = $fecha_mysql; // Almacena la fecha convertida en el mismo campo
        }
    }

    if (empty($_POST['DESTINO'])) {
        $vMensaje .= 'Debes seleccionar el destino del viaje. <br />';
    }
    if (($_POST['COSTO']) == 0 ) {
        $vMensaje .= 'Ingrese cuanto costará el viaje. <br />';
    }
    if (($_POST['PORCENTAJE']) == 0 ) {
        $vMensaje .= 'Ingrese el porcentaje para el chofer. <br />';
    }
    return $vMensaje;
    }

function DatoRequerido()
{
    $DatoFaltante = Validar_Datos(); 
    if (strpos($DatoFaltante, "Chofer") !== false) {
        $DatoFaltante = "Chofer";
    } elseif (strpos($DatoFaltante, "Transporte") !== false) {
        $DatoFaltante = "Transporte";
    } elseif (strpos($DatoFaltante, "Fecha programada") !== false) {
        $DatoFaltante = "Fecha programada";
    }elseif (strpos($DatoFaltante, "Destino") !== false) {
        $DatoFaltante = "Destino";
    }
    else $DatoFaltante = "";
    return $DatoFaltante;
}
