<?php
require_once 'template.php';
require_once 'php/Controllers/BranchController.php';

$branchId = $_SESSION['user']['branch_id'];
$branchController = new BranchController($_SESSION['jwt']);
$branch = $branchController->get($branchId);

head('Sucursal');
body([$branch->name]);
?>

<!-- Page Header -->
<div class="row">
	<div class="col-12">
		<h1><?= $branch->name ?></h1>
		<hr>
	</div>
</div>
<!-- /.Page Header -->

<!-- row -->
<div class="row">
	<div class="col-12">
		<form id="editBranchForm">
			<div class="text-center">
				<img class="" id="image" height="100" width="100" src="<?= $branch->logo; ?>" />
				<br>
				<br>
				<input type="file" accept=".jpg" class="btn-light" id="uploadImage">
				<br>
			</div>
			<br>
			<input type="hidden" id="branchId" value="<?= $branch->id; ?>">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label class="control-label" for="name">Sucursal</label>
					<input type="text" class="form-control" id="name" value="<?= $branch->name; ?>" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="phone">Teléfono</label>
					<input type="text" class="form-control" id="phone" value="<?= $branch->phone; ?>" pattern="[0-9a-zA-Z\s]*">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="adminEmail">Email del administrador</label>
					<input type="email" class="form-control" id="adminEmail" value="<?= $branch->admin_email; ?>">
				</div>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-primary" id="btnEditBranch">Guardar</button>
			</div>
		</form>
	</div>
</div>
<!-- /.row -->
</br>

<?php
footer(['js/branches/branch.js']);
?>