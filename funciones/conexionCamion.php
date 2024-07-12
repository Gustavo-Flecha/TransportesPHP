<?php
// <-<-<- Definir la función de conexión a la base de datos ->->->
function Camion_ConexionBD($Host = 'localhost' ,  $User = 'root',  $Password = '', $BaseDeDatos='transportes' ) {

    // <-<-<- procedo al intento de conexion con esos parametros ->->->
    $linkConexion = mysqli_connect($Host, $User, $Password, $BaseDeDatos);
    if ($linkConexion!=false) 
        return $linkConexion;
    else 
        // <-<-<-  Mostrar un mensaje de error detallado y detener la ejecución ->->->
        die('No se pudo establecer la conexión: ' . mysqli_connect_error());
}
?>