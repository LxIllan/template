<?php
    require_once 'template.php';
    head('Perfil');
    body(['Perfil']);
?>


<?php	
	require_once 'php/Controllers/UserController.php';

	$userId = (isset($_GET['id'])) ? $_GET['id'] : $_SESSION['user']['id'];
	$userController = new UserController($_SESSION['jwt']);
	$user = $userController->get($userId);
?>

<!-- row -->
<div class="row">
	<div class="col-12">
		<form id="editUserForm">
			<div class="text-center">
				<img class="rounded-circle" id="image" height="200" width="200" src="<?= $user->photo_path; ?>"/>
				<br>
				<br>				
				<input type="file" accept=".jpg" class="btn-light" id="uploadImage">
				<br>
			</div>
			<br>
			<input type="hidden" id="userId" value="<?= $user->id; ?>">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label class="control-label" for="name">Nombre</label>
					<input type="text" class="form-control" id="name" <?= (!$user->root) ? 'readonly' : ''; ?>
						value="<?= $user->name; ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="lastName">Apellido</label>
					<input type="text" class="form-control" id="lastName" <?= (!$user->root) ? 'readonly' : ''; ?>
						value="<?= $user->last_name; ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="email">Correo electrónico</label>
					<input type="email" class="form-control" id="email" <?= (!$user->root) ? 'readonly' : ''; ?>
						value="<?= $user->email; ?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label class="control-label" for="address">Domicilio</label>
					<input type="text" class="form-control" id="address" <?= (!$user->root) ? 'readonly' : ''; ?>
						value="<?= $user->address; ?>">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="phone">Teléfono</label>
					<input type="text" class="form-control" id="phone" <?= (!$user->root) ? 'readonly' : ''; ?>
						value="<?= $user->phone_number; ?>">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="root">Administrador</label><br>
					<input type="checkbox" id="root" <?= ($user->root) ? 'checked' : ''; ?> class="form-control" hidden>
					<input type="text" class="form-control" value="<?= ($user->root) ? 'Sí' : 'No'; ?>" readonly>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-3">
					<!--  -->
				</div>
				<div class="form-group col-md-3">
					<label class="control-label" for="password">Nueva Contraseña:</label>
					<input type="password" id="password" class="form-control" placeholder="Contraseña">        
				</div>
				<div class="form-group col-md-3">
					<label class="control-label" for="confirmPassword">Confirmar contraseña:</label>
					<input type="password" id="confirmPassword" class="form-control" placeholder="Contraseña">  
				</div>
				<div class="form-group col-md-3">
					<!--  -->
				</div>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-primary" id="btnEditProfile">Guardar</button>
			</div>
		</form>
	</div>
</div>
<!-- /.row -->

<?php 
	footer(['js/users/user.js']);
?>