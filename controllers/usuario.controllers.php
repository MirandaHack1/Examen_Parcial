<?php
//TODO:REQUERIMIENTOS EXTERNOS.
require_once('../models/usuario.models.php');
require_once('../config/sesiones.php');
//error_reporting(0);
$Usuarios = new usuarioModel;
switch($_GET["op"])
{
    case 'login':
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        if (empty($correo) || empty($contrasena)) {
            header("Location:../index.php?op=2");
            exit();
        }

        $datos = $Usuarios->login($correo, $contrasena);
        $res = mysqli_fetch_assoc($datos);

        try {
            if (is_array($res) && count($res) > 0) {
                $_SESSION['id'] = $res['id'];
                $_SESSION['cedula'] = $res['cedula'];
                $_SESSION['nombre'] = $res['nombre'];
                $_SESSION['apellido'] = $res['apellido'];
                $_SESSION['correo'] = $res['correo'];
                $_SESSION['contrasena'] = $res['contrasena'];
                $_SESSION['idr'] = $res['idr'];
                $_SESSION['tipo_rol'] = $res['tipo_rol'];

                header('Location:../Views/Dashboard/home.php');
                exit();
            } else {
                header("Location:../index.php?op=1");
                exit();
            }
        } catch (Throwable $th) {
            echo json_encode($th->getMessage());
        }
        break;
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
            $idusu = $_POST['id'];
            $datos = array();
            $datos = $Usuarios->uno($idusu);
            $respuesta = mysqli_fetch_assoc($datos);
            echo json_encode($respuesta);
            break;

        case 'insertar':
            $Cedula = $_POST['cedula'];
            $Nombres = $_POST['nombre'];
            $Apellidos = $_POST['apellido'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $idRol = $_POST['id_rol'];
            $datos = array();
            $datos = $Usuarios->Insertar($Cedula, $Nombres, $Apellidos, $correo, $contrasena, $idRol);
            echo json_encode($datos);
            break;

    case 'actualizar':
        $idusu= $_POST['id'];
        $Cedula = $_POST['cedula'];
        $Nombres = $_POST['nombre'];
        $Apellidos = $_POST['apellido'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $idRol = $_POST['id_rol'];
        $datos = array();
        $datos = $Usuarios->Actualizar($idusu,$Cedula,$Nombres, $Apellidos,$correo, $contrasena, $idRol);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $idusu = $_POST['id'];
        $datos = array();
        $datos = $Usuarios->Eliminar($idusu);
        echo json_encode($datos);
        break;
}