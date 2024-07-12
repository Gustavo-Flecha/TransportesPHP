<?php
function Validar_Datos()
{
    $vMensaje = "";

    //con esto aseguramos que limpiamos espacios y limpiamos de caracteres de codigos ingresados
    foreach ($_POST as $Id => $Valor) {
        $_POST[$Id] = trim($_POST[$Id]);
        $_POST[$Id] = strip_tags($_POST[$Id]);
    }

    if (strlen($_POST['CHOFER']) == 0) {
        $vMensaje .= 'Debe seleccionar una Marca de Camión. <br />';
    }
    
    if (empty($_POST['TRANSPORTE'])) {
        $vMensaje .= 'Debes seleccionar un transporte. <br />';
    }

    // <!--  <-<-<- Validación de fecha en formato dd/mm/yyyy ->->->  -->

    if (strlen($_POST['FECHA']) < 10) {
        $vMensaje .= 'Debes seleccionar la fecha del viaje. <br />';
    } elseif (isset($_POST['FECHA'])) {
        $fecha = $_POST['FECHA'];
        $formato = 'd/m/Y';
        $d = DateTime::createFromFormat($formato, $fecha);
    
        // Verificar que la fecha sea válida
        if ($d && $d->format($formato) === $fecha) {
            // Convertir la fecha al formato YYYY-MM-DD para MySQL
            $fecha_mysql = $d->format('Y-m-d');
            $_POST['FECHA'] = $fecha_mysql; // Almacena la fecha convertida en el mismo campo
        }
    }


   

    if (empty($_POST['DESTINO'])) {
        $vMensaje .= 'Debes seleccionar el destino del viaje. <br />';
    }
    if (strlen($_POST['COSTO']) == 0) {
        $vMensaje .= 'Ingrese cuanto costará el viaje. <br />';
    }
    if (strlen($_POST['PORCENTAJE']) == 0) {
        $vMensaje .= 'Ingrese el porcentaje para el chofer. <br />';
    }
    return $vMensaje;
}
