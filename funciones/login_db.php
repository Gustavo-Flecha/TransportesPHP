<?php
function DatosLogin($vUsuario, $vClave, $vConexion)
{
    $Usuario = array();

    $SQL = "SELECT ID_ESTADO, ID_NIVEL, NOMBRE, APELLIDO
     FROM usuarios 
     WHERE usuario='$vUsuario' AND CLAVE='$vClave'  ";

    $rs = mysqli_query($vConexion, $SQL);

    $data = mysqli_fetch_array($rs);
    if (!empty($data)) {
        $Usuario['ESTADO'] = $data['ID_ESTADO'];
        $Usuario['NIVEL'] = $data['ID_NIVEL'];
        $Usuario['APELLIDO'] = $data['APELLIDO'];
        $Usuario['NOMBRE'] = $data['NOMBRE'];
    }
    return $Usuario;
}
