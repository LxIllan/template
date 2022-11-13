<?php
require_once 'template.php';

require_once 'php/Controllers/UserController.php';

$userId = (isset($_GET['id'])) ? $_GET['id'] : $_SESSION['user']['id'];
$userController = new UserController($_SESSION['jwt']);
$user = $userController->get($userId);

head('Usuario');
body(['users.php' => 'Usuarios', "$user->name $user->last_name"]);
?>

<!-- row -->
<div class="row">
	<div class="col-12">
		<form id="editUserForm">
			<div class="text-center">
				<img class="rounded-circle" height="200" width="200" src="<?= $user->photo; ?>" />
			</div>
			<br>
			<input type="hidden" id="userId" value="<?= $user->id; ?>">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label class="control-label" for="name">Nombre:</label>
					<input type="text" class="form-control" id="name" value="<?= $user->name; ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="lastName">Apellido:</label>
					<input type="text" class="form-control" id="lastName" value="<?= $user->last_name; ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="email">Correo electrónico:</label>
					<input type="email" class="form-control" id="email" value="<?= $user->email; ?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label class="control-label" for="address">Domicilio:</label>
					<input type="text" class="form-control" id="address" value="<?= $user->address; ?>">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="phone">Teléfono:</label>
					<input type="text" class="form-control" id="phone" value="<?= $user->phone; ?>">
				</div>
				<div class="form-group col-md-4">
					<div class="text-center">
						<label class="control-label">Administrador</label><br>
						<input type="checkbox" class="form-control" id="root" <?= ($user->root) ? 'checked' : ''; ?>>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-12">
					<div class="text-center">
						<button class="btn btn-light" id="btnResetPassword">
							Reset password
						</button>
					</div>
				</div>
			</div>
			<div class="text-center">
				<?php if ($user->id != $_SESSION['user']['id']) {
					echo <<<HTML
						<button class="btn btn-light" id="btnDeleteUser">Eliminar</button>
					HTML;
				} ?>
				<button type="submit" class="btn btn-primary" id="btnEditUser">Guardar</button>
			</div>
		</form>
	</div>
</div>
<!-- /.row -->


<?php
footer(['js/users/user.js']);
?>