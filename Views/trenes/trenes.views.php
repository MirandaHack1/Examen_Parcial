<?php
include_once('../../config/sesiones.php');
if (isset($_SESSION["id"])) {
    $_SESSION["ruta"] = "Tabla Usuario";
?>
<!DOCTYPE html>
<html lang="es">
<!--HEAD   -->     
<head>
<?php require_once('../html/head.php')  ?>

</head>
<body>
	<div class="wrapper">
    <?php require_once('../html/menu.php')  ?>

		<div class="main">	
        <?php require_once('../html/header.php')  ?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>TRENES</strong></h1>
					<!-- Button trigger modal -->
                    <button type="button" onclick="cargaRol()" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#ModalUsu">
                        Inserte Datos
                    </button>

					<div class="row">

							<div class="card flex-fill">
								<div class="card-header">

								<h5 class="card-title mb-0">Latest Projects</h5>
								</div>

								<table class="table table-striped">
                                <thead>
                                            <tr>
                                               
                                                <th>ID_TREN</th>
                                                <th>MODELO</th>
                                                <!--
                                                <th>Cedula</th>
                                                <th>Correo</th>
                                                <th>Rol</th>
                                                <th>Opciones</th>
                                                -->
                                            </tr>
                                        </thead>
                                        <tbody id="TUsuario">

                                        </tbody>
                                </table>
							</div>	
					</div>
				</div> 
			</main>
            <!-- Modal -->
                            <div class="modal fade" id="ModalUsu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="titulousuario">Nuevo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="usu_form">
                                    <div class="modal-body">
                                        <input type="hidden" name="ID_tren" id="ID_tren">
                                                    
                                                    <div class="form-group">
                                                        <label for="modelo" class="control-label">modelo</label>
                                                        <input type="text" name="modelo" ID_tren="modelo" class="form-control" required>
                                                    </div>
                                                     <!--
                                                    <div class="form-group">
                                                        <label for="nombre" class="control-label">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="apellido" class="control-label">Apellido</label>
                                                        <input type="text" name="apellido" id="apellido" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correo" class="control-label">Correo</label>
                                                        <input type="text" name="correo" id="correo" class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="contrasena" class="control-label">Contraseña</label>
                                                        <input type="text" name="contrasena" id="contrasena" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id_rol" class="control-label">Rol</label>
                                                        <select name="id_rol" id="id_rol" class="form-control"> 
                                                        </select>
                                                    </div>    
                                                    -->   
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>

                                </form>
                                </div>
                            </div>
                            </div>
          <!--  <?php require_once('../html/footer.php')  ?> -->
		</div>
	</div>

    <?php require_once('../html/scripts.php')  ?>
    <script src="./trenes.views.js"></script> 
    
</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}
?>