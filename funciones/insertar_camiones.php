<?php
// <-<-<- Función con Stored Procedure ->->-> 
// function InsertarCamiones($vConexion) {

//     // <!--  <-<-<- Obtener los datos del formulario ->->->  -->
//     $cod_marca = $vConexion->real_escape_string($_POST['MARCA']);
//     $nom_modelo = $vConexion->real_escape_string($_POST['MODELO']);
//     $anio_modelo = $vConexion->real_escape_string($_POST['ANIO']);
//     $patente = $vConexion->real_escape_string($_POST['PATENTE']);
//     $disponibilidad = $vConexion->real_escape_string($_POST['HABILITADO']);

//         //<-<-<- Preparar la llamada al stored procedure ->->->
//      $stmt = $vConexion->prepare("CALL InsertarTransporte(?, ?, ?, ?, ?)");

//     if ($stmt === false) { //  <-<-<-Prueba de conexion ->->->  -->
//          die('<h4>Error al preparar la llamada al stored procedure.</h4>');
//     } 

//     // <-<-<-Vincular los parámetros ->->->   
//     $stmt->bind_param("isisi", $cod_marca, $nom_modelo, $anio_modelo, $patente, $disponibilidad);

//      // <-<-<- Ejecutar el procedimiento almacenado ->->->
//      if (!$stmt->execute()) {
//         die('<h4>Error al intentar insertar el registro.</h4>');
//     } 

//     // Cerrar el statement
//     $stmt->close();

//     return true; 
// }
//


// <-<-<- Función con Stored Procedure y try-catch->->-> 
function InsertarCamiones($vConexion)
{
    // <!--  <-<-<- Obtener los datos del formulario ->->->  -->
    $cod_marca = $vConexion->real_escape_string($_POST['MARCA']);
    $nom_modelo = $vConexion->real_escape_string($_POST['MODELO']);
    $anio_modelo = $vConexion->real_escape_string($_POST['ANIO']);
    $patente = $vConexion->real_escape_string($_POST['PATENTE']);
    $disponibilidad = $vConexion->real_escape_string($_POST['HABILITADO']);
    try {
        // <-<-<- Preparar la llamada al stored procedure ->->->
        $stmt = $vConexion->prepare("CALL InsertarTransporte(?, ?, ?, ?, ?)");
        if ($stmt === false) {
            throw new Exception('Error al preparar la llamada al stored procedure.');
        }
        // <-<-<- Vincular los parámetros ->->->   
        $stmt->bind_param("isisi", $cod_marca, $nom_modelo, $anio_modelo, $patente, $disponibilidad);

        // <-<-<- Ejecutar el procedimiento almacenado ->->->
        if (!$stmt->execute()) {
            throw new Exception('Error al intentar insertar el registro: ' . $stmt->error);
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
