<?php
//TODO:REQUERIMIENTOS EXTERNOS.
require_once('../models/rutas.models.php');
require_once('../config/sesiones.php');
//error_reporting(0);
$Usuarios = new usuarioModel;
switch($_GET["op"])
{
    case 'todos':
        $datos=array();
        $datos = $Usuarios->todos();
        while($fila = mysqli_fetch_assoc($datos))
        {
            $todos[]= $fila ; 
        }
        echo json_encode($todos);
        break;

        case 'uno':
            $idusu = $_POST['ID_rutas'];
            $datos = array();
            $datos = $Usuarios->uno($idusu);
            $respuesta = mysqli_fetch_assoc($datos);
            echo json_encode($respuesta);
            break;

        case 'insertar':
            $idusu = $_POST['ID_tren'];
            $ID_estacion_origen = $_POST['ID_estacion_origen'];
            $ID_estacion_destino = $_POST['ID_estacion_destino'];
            $ID_fecha = $_POST['ID_fecha'];
            $datos = array();
            $datos = $Usuarios->Insertar( $idusu, $ID_estacion_origen,  $ID_estacion_destino,  $ID_fecha);
            echo json_encode($datos);
            break;

    case 'actualizar':
        $idusu = $_POST['ID_rutas'];
        $ID_estacion_origen = $_POST['ID_estacion_origen'];
        $ID_estacion_destino = $_POST['ID_estacion_destino'];
        $ID_fecha = $_POST['ID_fecha'];
        $datos = array();
        $datos = $Usuarios->Actualizar( $idusu, $ID_estacion_origen,  $ID_estacion_destino,  $ID_fecha);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $idusu = $_POST['ID_rutas'];
        $datos = array();
        $datos = $Usuarios->Eliminar($idusu);
        echo json_encode($datos);
        break;
}