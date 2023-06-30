<?php 
/*AQUI SON TODA LAS CONSULTAS DE LA BASES DE DATOS*/
//llamo AL ARCHIVOD E CONEXION
//TODO: OBTENGO TODO LOS TEGISTRO DE LA BASES DE DATOS
require_once('../config/config.php');
class usuarioModel
{
    public function todos ()
    {
        $con=new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `pasajero` INNER JOIN rutas on pasajero.ID_ruta = rutas.ID_rutas ORDER BY ID_pasajero";
        $datos=mysqli_query($con,$cadena);
        return $datos;
    }  

    public function Insertar($nombre, $ID_ruta) {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `pasajero`(`nombre`, `ID_ruta`) VALUES ('$nombre', '$ID_ruta')";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return mysqli_error($con);
        }
    }
        public function uno($idusu){
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "SELECT * FROM `pasajero` where ID_pasajero=$idusu";
            $datos = mysqli_query($con, $cadena);
            return $datos;
        }
        public function Actualizar($idusu,$nombre, $ID_ruta){
            $con = new ClaseConexion();
            $con=$con->ProcedimientoConectar();
            $cadena = "UPDATE `pasajero` SET `nombre`='$nombre', `ID_ruta`='$ID_ruta' WHERE ID_pasajero=$idusu";
            if (mysqli_query($con, $cadena)){
                return 'ok';
            }else{
                return mysqli_error($con);
            }
        }
        public function Eliminar($idusu){
            $con = new ClaseConexion();
            $con=$con->ProcedimientoConectar();
            $cadena = "DELETE FROM `pasajero` WHERE ID_pasajero=$idusu ";
            if (mysqli_query($con, $cadena)){
                return 'ok';
            }else{
               
                return mysqli_error($con);
            }
        }
  


}

?>