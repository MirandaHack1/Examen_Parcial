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

					<h1 class="h3 mb-3"><strong>PASAJEROS</strong></h1>
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
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>ID_Ruta</th>
                                                <th>Modelo</th>
                                                <th>Orgien</th>
                                                <th>Destino</th>
                                                <th>Fecha</th>
                                                
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
                                        <input type="hidden" name="ID_pasajero" id="ID_pasajero">
                                                    
                                                    <div class="form-group">
                                                        <label for="nombre" class="control-label">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ID_rutas" class="control-label">Ruta</label>
                                                        <select name="ID_rutas" id="ID_rutas" class="form-control"> 
                                                        </select>
                                                    </div>       
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
    <script src="./pasajeros.views.js"></script> 
    
</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}
?>