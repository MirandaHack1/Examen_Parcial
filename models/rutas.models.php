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
        $cadena = "SELECT * FROM `rutas` INNER JOIN trenes on rutas.ID_tren = trenes.ID_tren INNER JOIN estaciones on rutas.ID_estacion_origen = estaciones.ID_estacion ORDER BY ID_rutas";
        $datos=mysqli_query($con,$cadena);
        return $datos;
    }  

    public function Insertar($ID_tren, $ID_estacion_origen, $ID_estacion_destino, $ID_fecha) {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `rutas`(`ID_tren`, `ID_estacion_origen`, `ID_estacion_destino`, `ID_fecha`) VALUES ('$ID_tren', '$ID_estacion_origen', '$ID_estacion_destino', '$ID_fecha')";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return mysqli_error($con);
        }
    }
        public function uno($idusu){
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "SELECT * FROM `rutas` where ID_rutas=$idusu";
            $datos = mysqli_query($con, $cadena);
            return $datos;
        }
        public function Actualizar($idusu,$ID_tren, $ID_estacion_origen, $ID_estacion_destino, $ID_fecha){
            $con = new ClaseConexion();
            $con=$con->ProcedimientoConectar();
            $cadena = "UPDATE `rutas` SET `ID_tren`='$ID_tren', `ID_estacion_origen`='$ID_estacion_origen',`ID_estacion_destino`='$ID_estacion_destino',`ID_fecha`='$ID_fecha' WHERE ID_rutas=$idusu";
            if (mysqli_query($con, $cadena)){
                return 'ok';
            }else{
                return mysqli_error($con);
            }
        }
        public function Eliminar($idusu){
            $con = new ClaseConexion();
            $con=$con->ProcedimientoConectar();
            $cadena = "DELETE FROM `rutas` WHERE ID_rutas=$idusu ";
            if (mysqli_query($con, $cadena)){
                return 'ok';
            }else{
               
                return mysqli_error($con);
            }
        }
  


}

?>