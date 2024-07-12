<?php
function ListarMarcas($vConexion)
{
    // <-<-<- Generar la consulta ->->->
    $SQL = "SELECT * FROM marcas ORDER BY NOM_MARCA";

    // <-<-<- Ejecutar la consulta y obtener la respuesta ->->->
    $respuesta = mysqli_query($vConexion, $SQL);

    // <-<-<- Inicializar el array para almacenar los resultados ->->->
    $Listado = array();

    // <-<-<- Recorrer los resultados y los agregar al array ->->->
    while ($data = mysqli_fetch_assoc($respuesta)) {
        $Listado[] = array(
            'COD_MARCA' => $data['COD_MARCA'],
            'NOM_MARCA' => $data['NOM_MARCA']
        );
    }
    // <!--  <-<-<- Liberar los resultados para permitir la próxima consulta ->->->  -->
    mysqli_next_result($vConexion);

    // <-<-<- Devuelver el listado generado ->->->
    return $Listado;
}

function ListarTransportes($vConexion)
{
    // <-<-<- Generar la consulta para llamar al procedimiento almacenado ->->->
    $SQL = "CALL ObtenerMarcasModelosPatentes()";

    // <-<-<- Ejecutar la consulta y obtener la respuesta ->->->
    $respuesta = mysqli_query($vConexion, $SQL);

    // <-<-<- Inicializar el array para almacenar los resultados ->->->
    $Listado = array();

    // <-<-<- Recorrer los resultados y agregarlos al array ->->->
    while ($data = mysqli_fetch_assoc($respuesta)) {
        $Listado[] = array(
            'NOM_MARCA' => $data['NOM_MARCA'],
            'NOM_MODELO' => $data['NOM_MODELO'],
            'ID_PATENTE' => $data['ID_PATENTE'],
            'PATENTE' => $data['PATENTE']
        );
    }
    // <!--  <-<-<- Liberar los resultados para permitir la próxima consulta ->->->  -->
    mysqli_next_result($vConexion);

    // <-<-<- Devuelver el listado generado ->->->
    return $Listado;
}

function ListarChoferesActivos($vConexion)
{
    // <-<-<- Generar la consulta para llamar al procedimiento almacenado ->->->
    $SQL = "CALL ObtenerChoferesActivos()";

    // <-<-<- Ejecutar la consulta y obtener la respuesta ->->->
    $respuesta = mysqli_query($vConexion, $SQL);

    // <-<-<- Inicializar el array para almacenar los resultados ->->->
    $Listado = array();

    // <-<-<- Recorrer los resultados y agregarlos al array ->->->
    while ($data = mysqli_fetch_assoc($respuesta)) {
        $Listado[] = array(
            'ID_USER' => $data['ID_USER'],
            'APELLIDO' => $data['APELLIDO'],
            'NOMBRE' => $data['NOMBRE'],
            'DNI' => $data['DNI']
        );
    }
     // <!--  <-<-<- Liberar los resultados para permitir la próxima consulta ->->->  -->
     mysqli_next_result($vConexion);

    // <-<-<- Devuelver el listado generado ->->->
    return $Listado;
}

function ListarDestinos($vConexion){
    // <-<-<- Generar la consulta ->->->
    $SQL = "SELECT * FROM `destinos` ORDER BY NOM_CIUDAD";

    // <-<-<- Ejecutar la consulta y obtener la respuesta ->->->
    $respuesta = mysqli_query($vConexion, $SQL);

    // <-<-<- Inicializar el array para almacenar los resultados ->->->
    $Listado = array();

    // <-<-<- Recorrer los resultados y los agregar al array ->->->
    while ($data = mysqli_fetch_assoc($respuesta)) {
        $Listado[] = array(
            'COD_CIU' => $data['COD_CIU'],
            'NOM_CIUDAD' => $data['NOM_CIUDAD']
        );
    }
    // <!--  <-<-<- Liberar los resultados para permitir la próxima consulta ->->->  -->
    mysqli_next_result($vConexion);

    // <-<-<- Devuelver el listado generado ->->->
    return $Listado;

}

function ListarViajes($vConexion){
    // <-<-<- Generar la consulta para llamar al procedimiento almacenado ->->->
    $SQL = "CALL ListarViajes()";

    // <-<-<- Ejecutar la consulta y obtener la respuesta ->->->
    $respuesta = mysqli_query($vConexion, $SQL);

    // <-<-<- Inicializar el array para almacenar los resultados ->->->
    $Listado = array();

    // <-<-<- Recorrer los resultados y agregarlos al array ->->->
    while ($data = mysqli_fetch_assoc($respuesta)) {
        $Listado[] = array(
            'FECHA_SALIDA' => $data['FECHA_SALIDA'],
            'NOM_CIUDAD' => $data['NOM_CIUDAD'],
            'NOM_MARCA' => $data['NOM_MARCA'],
            'NOM_MODELO' => $data['NOM_MODELO'],
            'PATENTE' => $data['PATENTE'],
            'APELLIDO' => $data['APELLIDO'],
            'NOMBRE' => $data['NOMBRE'],
            'COSTO_VIAJE' => $data['COSTO_VIAJE'],
            'PORCENTAJE_CHOFER' => $data['PORCENTAJE_CHOFER'],
        );
    }
    // <!--  <-<-<- Liberar los resultados para permitir la próxima consulta ->->->  -->
    mysqli_next_result($vConexion);

    // <-<-<- Devuelver el listado generado ->->->
    return $Listado;
}