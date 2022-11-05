<?php
    require_once 'template.php';
    head('Usuarios');
    body(['Usuarios']);
?>

<?php
	require_once 'php/Controllers/UserController.php';
	$userController = new UserController($_SESSION['jwt'], 'user', 'users');
	$users = $userController->getAll();
?>

<!-- row -->
<div class="">
	<div class="">
		<div class="text-center">
			<a href="#add" data-toggle="modal">
				<button type='button' class='btn btn-primary btn-sm'><span class='fa fa-fw fa-user-plus' aria-hidden='true'></span></button>
			</a>
		</div>                
		<br>           
		<div class="">
			<div class="table-responsive">
				<table class="table table-hover table-sm">
					<thead>
					<tr class="bg-primary">
						<th>Foto</th>
						<th>Nombre</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody class="table-striped">
					<?php
					foreach ($users as $user) { ?>
						<tr>
							<td><img class="rounded-circle" height="120" width="120" src="<?= $user->photo_path; ?>"/></td>
							<td><?= $user->name . ' ' . $user->last_name ?></td>
							<td><?= ($user->root == 1) ? 'Administrador' : 'Cajero';?></td>
							<td>
								<a class="btn btn-light btn-sm"
									href="frm_editar_cajero.php?id=<?= $idRecepcionista;?>">
									<i class="fa fa-fw fa-edit"></i>
								</a>
							</td>
							<td>
								<a class="btn btn-secondary btn-sm"
									href="frm_eliminar_cajero.php?id=<?=
									$idRecepcionista;?>">
									<i class="fa fa-fw fa-trash"></i>
								</a>
							</td>
						</tr>
					<?php
					}
					if (count($users) == 0) {
						echo <<<HTML
							<div class="alert alert-primary text-center">
								<strong>¡Opps!</strong> No hay registros de lo que buscas.
							</div>
						HTML;
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- row -->

<?php 
	footer(['js/foods.js']);
?>