<?php 
/*AQUI SON TODA LAS CONSULTAS DE LA BASES DE DATOS*/
//llamo AL ARCHIVOD E CONEXION
//TODO: OBTENGO TODO LOS TEGISTRO DE LA BASES DE DATOS
require_once('../config/config.php');
class usuarioModel
{
   /* public function login($correo, $contrasena)
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM usuario WHERE correo = '$correo' and contrasena='$contrasena'";
        print $cadena;
        $datos = mysqli_query($con, $cadena);
        return $datos;


        
   }*/
   //INNER JOIN rol on usuario.id_rol = rol.id_rol ORDER BY apellido";
    public function todos ()
    {
        $con=new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "SELECT * FROM estaciones"; 
        $datos=mysqli_query($con,$cadena);
        return $datos;
    }  

    public function Insertar($ciudad) {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `estaciones`(`ciudad`) VALUES ('$ciudad')";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return mysqli_error($con);
        }
    }
        public function uno($idusu){
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "SELECT * FROM `estaciones` where ID_estacion =$idusu";
            $datos = mysqli_query($con, $cadena);
            return $datos;
        }
        public function Actualizar($idusu,$ciudad){
            $con = new ClaseConexion();
            $con=$con->ProcedimientoConectar();
            $cadena = "UPDATE `estaciones` SET `ciudad`='$ciudad' WHERE ID_estacion=$idusu";
            if (mysqli_query($con, $cadena)){
                return 'ok';
            }else{
                return mysqli_error($con);
            }
        }
        public function Eliminar($idusu){
            $con = new ClaseConexion();
            $con=$con->ProcedimientoConectar();
            $cadena = "DELETE FROM `estaciones` WHERE ID_estacion=$idusu ";
            if (mysqli_query($con, $cadena)){
                return 'ok';
            }else{
               
                return mysqli_error($con);
            }
        }
  


}

?>