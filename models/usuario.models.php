<?php 
/*AQUI SON TODA LAS CONSULTAS DE LA BASES DE DATOS*/
//llamo AL ARCHIVOD E CONEXION
//TODO: OBTENGO TODO LOS TEGISTRO DE LA BASES DE DATOS
require_once('../config/config.php');
class usuarioModel
{
    public function login($correo, $contrasena)
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM usuario WHERE correo = '$correo' and contrasena='$contrasena'";
        print $cadena;
        $datos = mysqli_query($con, $cadena);
        return $datos;
   }
    public function todos ()
    {
        $con=new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "SELECT * FROM usuario INNER JOIN rol on usuario.id_rol = rol.id_rol ORDER BY apellido";
        $datos=mysqli_query($con,$cadena);
        return $datos;
    }  

    public function Insertar($Cedula, $Nombres, $Apellidos, $correo, $contrasena, $idRol) {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `usuario`(`cedula`, `nombre`, `apellido`, `correo`, `contrasena`, `id_rol`) VALUES ('$Cedula', '$Nombres', '$Apellidos', '$correo', '$contrasena', '$idRol')";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return mysqli_error($con);
        }
    }
        public function uno($idusu){
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "SELECT * FROM `usuario` where id=$idusu";
            $datos = mysqli_query($con, $cadena);
            return $datos;
        }
        public function Actualizar($idusu,$Cedula,$Nombres, $Apellidos,$correo, $contrasena, $idRol){
            $con = new ClaseConexion();
            $con=$con->ProcedimientoConectar();
            $cadena = "UPDATE `usuario` SET `cedula`='$Cedula', `nombre`='$Nombres',`apellido`='$Apellidos',`correo`='$correo',`contrasena`='$contrasena',`id_rol`='$idRol' WHERE id=$idusu";
            if (mysqli_query($con, $cadena)){
                return 'ok';
            }else{
                return mysqli_error($con);
            }
        }
        public function Eliminar($idusu){
            $con = new ClaseConexion();
            $con=$con->ProcedimientoConectar();
            $cadena = "DELETE FROM `usuario` WHERE id=$idusu ";
            if (mysqli_query($con, $cadena)){
                return 'ok';
            }else{
               
                return mysqli_error($con);
            }
        }
  


}

?>