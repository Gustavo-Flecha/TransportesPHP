<?php
function InsertarViajes($vConexion)
{ 
        // <!--  <-<-<- Obtener los datos del formulario ->->->  -->
        $ID_USER = $vConexion->real_escape_string($_POST['CHOFER']);
        $ID_PATENTE = $vConexion->real_escape_string($_POST['TRANSPORTE']);
        $FECHA_SALIDA = $vConexion->real_escape_string($_POST['FECHA']);
        $COD_CIU = $vConexion->real_escape_string($_POST['DESTINO']);
        $COSTO_VIAJE = $vConexion->real_escape_string($_POST['COSTO']);
        $PORCENTAJE_CHOFER = $vConexion->real_escape_string($_POST['PORCENTAJE']);
        $NOM_REGISTRADOR = $vConexion->real_escape_string($_SESSION['Usuario_Nombre']);
        try {
            // <-<-<- Preparar la llamada al stored procedure ->->->
            $stmt = $vConexion->prepare("CALL InsertarViajes(?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                throw new Exception('Error al preparar la llamada al stored procedure.');
            }
            // <-<-<- Vincular los parámetros ->->->   
            $stmt->bind_param("iisidds", $ID_USER, $ID_PATENTE, $FECHA_SALIDA, $COD_CIU, $COSTO_VIAJE, $PORCENTAJE_CHOFER, $NOM_REGISTRADOR);

            // <-<-<- Ejecutar el procedimiento almacenado ->->->
            if (!$stmt->execute()) {
                throw new Exception('Error al intentar insertar el viaje: ' . $stmt->error);
            }
            // <!--  <-<-<- Cerrar el statement ->->->  -->
            $stmt->close();
            return true;
        } catch (Exception $e) {
            // <!--  <-<-<- Manejo de errores ->->->  -->
            echo '<h4>' . $e->getMessage() . '</h4>';
            return false;
        }   
}

