<?php
//TODO:REQUERIMIENTOS EXTERNOS.
require_once('../models/usuario.models.php');
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
            $idusu = $_POST['ID_pasajero'];
            $datos = array();
            $datos = $Usuarios->uno($idusu);
            $respuesta = mysqli_fetch_assoc($datos);
            echo json_encode($respuesta);
            break;

        case 'insertar':
            $nombre = $_POST['nombre'];
            $ID_ruta = $_POST['ID_ruta'];
            
            $datos = array();
            $datos = $Usuarios->Insertar($nombre, $ID_ruta);
            echo json_encode($datos);
            break;

    case 'actualizar':
        $idusu= $_POST['ID_pasajero'];
        $nombre = $_POST['nombre'];
        $ID_ruta = $_POST['ID_ruta'];
        $datos = array();
        $datos = $Usuarios->Actualizar($idusu,$nombre, $ID_ruta);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $idusu = $_POST['ID_pasajero'];
        $datos = array();
        $datos = $Usuarios->Eliminar($idusu);
        echo json_encode($datos);
        break;
}