<?php
    require_once 'template.php';
    head('Perfil');
    body(['Perfil']);
?>


<?php
	require_once 'php/Controllers/UserController.php';
	$userController = new UserController($_SESSION['jwt']);
	$user = $userController->get($_SESSION['user']['id']);
?>

<!-- row -->
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<form class="" action="" method="post" enctype="multipart/form-data">
			<div class="text-center">
				<img class="rounded-circle" height="200" width="200"
						src="<?= $user->photo_path; ?>"/>
				<br>
				<br>
				<output id="list"></output>
				<input type="file" accept=".jpg" class="btn-light" id="files" name="files">
				<br>
			</div>
			<br>
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label class="control-label" for="txtNombre">Nombre:</label>
					<input type="text" class="form-control" name="nombre" id="txtNombre"
						value="<?= $user->name; ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" readonly>
				</div>
				<div class="col-md-4 mb-3">
					<label class="control-label" for="txtApellido1">Primer apellido:</label>
					<input type="text" class="form-control" name="apellido1" id="txtApellido1"
						value="<?= $user->last_name; ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" readonly>
				</div>
				<div class="col-md-4 mb-3">
					<label class="control-label" for="txtApellido2">Segundo apellido:</label>
					<input type="text" class="form-control" name="apellido2" id="txtApellido2"
						value="<?= $user->last_name; ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*">
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label class="control-label" for="txtTelefono">Teléfono:</label>
					<input type="text" class="form-control" name="telefono" id="txtTelefono"
						value="<?= $user->phone_number; ?>">
				</div>
				<div class="col-md-4 mb-3">
					<label class="control-label" for="txtCorreo">Correo electrónico:</label>
					<input type="text" class="form-control" name="correo" id="txtCorreo"
						value="<?= $user->email; ?>">
				</div>
				<div class="col-md-4 mb-3">
					<label class="control-label" for="txtDomicilio">Domicilio:</label>
					<input type="text" class="form-control" name="domicilio" id="txtDomicilio"
						value="<?= $user->address; ?>">
				</div>
			</div>
			<?php
				if (isset($_GET['error'])) {
					if ($_GET['error'] == 1) {
						$error = 'Las contraseñas no coinciden.';
					} elseif ($_GET['error'] == 2) {
						// Claves menores de 8 chars
						$error = 'Tiene que ingresar una contraseña de al menos 4 caracteres';
					}?>
					<div class="alert alert-danger alert-dismissible text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span> </button>
						<strong>¡Error!</strong> <?= $error; ?>
					</div>
					<?php
				}
			?>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label class="control-label">Nueva Contraseña:</label>
					<input type="password" name="clave" class="form-control"
						placeholder="Contraseña">        
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Confirmar contraseña:</label>
					<input type="password" name="clave1" class="form-control"
						placeholder="Contraseña">  
				</div>
			</div>
			<div class="text-center">
				<input type="submit" name="aceptar" value="Guardar Cambios" class="btn btn-primary">

				<input type="submit" name="Salir" value="Cancelar" class="btn btn-light">
			</div>
		</form>
	</div>
</div>
<!-- /.row -->


<?php 
	footer(['js/foods.js']);
?>