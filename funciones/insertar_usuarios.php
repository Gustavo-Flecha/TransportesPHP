<!--  
  // <-<-<- Función hecha en clase ->->->
function InsertarUsuarios($vConexion){
    
    $SQL_Insert="INSERT INTO Usuarios (ID_ESTADO, ID_NIVEL, APELLIDO, NOMBRE, DNI, USUARIO, CLAVE, FECHA_INGRESO)
    VALUES ( '1', '3' , '".$_POST['APELLIDO']."' , '".$_POST['NOMBRE']."' , '".$_POST['DNI']."', '".$_POST['USUARIO']."' , ".$_POST['PASS']." , NOW())";


    if (!mysqli_query($vConexion, $SQL_Insert)) {
        // <-<-<- Al dar error, finalizar la ejecucion del script con un mensaje die ->->->
        die('<h4>Error al intentar insertar el registro.</h4>');
    }

    return true;
}
?> -->


<?php
 // <-<-<- Función con Stored Procedure ->->->
function InsertarUsuarios($vConexion) {    
    //<-<-<- Sanitizar y escapar entrada del usuario para prevenir inyección SQL.->->->
    $apellido = $vConexion->real_escape_string($_POST['APELLIDO']);
    $nombre = $vConexion->real_escape_string($_POST['NOMBRE']);
    $dni = $vConexion->real_escape_string($_POST['DNI']);
    $usuario = $vConexion->real_escape_string($_POST['USUARIO']);
    $clave = $vConexion->real_escape_string($_POST['PASS']);

    //<-<-<- Preparar la llamada al stored procedure ->->->
    $stmt = $vConexion->prepare("CALL InsertarUsuario(?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) { // <!--  <-<-<-Prueba de conexion ->->->  -->
        die('<h4>Error al preparar la llamada al stored procedure.</h4>');
    } 

    // <-<-<-Vincular los parámetros ->->->
    $estado = 1;
    $nivel = 3;
    // <!--  <-<-<-bind_param: Esta función se utiliza para vincular variables de PHP a los parámetros de la consulta SQL. ->->->  -->
    // <!--  <-<-<- En este caso, estamos vinculando los valores a los parámetros del stored procedure.  ->->->  -->
    // <!--  <-<-<-'i' para enteros ($estado y $nivel). ->->->  -->
    // <!--  <-<-<-'s' para cadenas de texto ($apellido, $nombre, $dni, $usuario, $clave) ->->->  -->
    $stmt->bind_param('iisssss', $estado, $nivel, $apellido, $nombre, $dni, $usuario, $clave);

    // <-<-<- Ejecutar la llamada ->->->
    if (!$stmt->execute()) {
        die('<h4>Error al intentar insertar el registro.</h4>');
    }

    // <-<-<- Cerrar la sentencia ->->->
    $stmt->close();

    return true;
}
?> 
