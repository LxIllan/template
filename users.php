<?php
    require_once 'template.php';
    head('Usuarios');
    body(['Usuarios']);
?>

<!-- card -->
<div>
	<div>
		<div class="text-center">
			<a href="#addModal" data-toggle="modal">
				<button type='button' class='btn btn-primary btn-sm'><span class='fa fa-fw fa-plus' aria-hidden='true'></span></button>
			</a>
		</div>
		<br>
		<div class="table-responsive">
			<table class="table table-hover table-condensed">
				<thead>
				<tr class="bg-light">
					<th>Foto</th>
					<th>Nombre</th>
					<th>Rol</th>
					<th></th>
					<th></th>
				</tr>
				</thead>
				<tbody id="usersTable">
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /card -->
</br>

<!--Add Item Modal -->
<div id="addModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">            
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Nuevo</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="addForm">
					<label class="control-label">Foto:</label>
					<div class="text-center">
						<img class="rounded-circle" id="image" height="200" width="200" src="" hidden/>
						<output id="list"></output>
						<br>
						<input class="btn-light" accept=".jpg" type="file" id="uploadImage">
					</div>
					<br>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label class="control-label" for="addName">Nombre</label>
							<input type="text" class="form-control" id="addName"
								placeholder="Nombre" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*">
						</div>
						<div class="col-md-4 mb-3">
							<label class="control-label" for="addLastName">Apellido</label>
							<input type="text" class="form-control" id="addLastName"
								placeholder="Apellido" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*">
						</div>
						<div class="col-md-4 mb-3">
							<label class="control-label" for="addEmail">Email</label>
							<input type="email" class="form-control" id="addEmail" placeholder="cajero@gmail.com" required>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label class="control-label" for="addAddress">Domicilio</label>
							<input type="text" class="form-control" id="addAddress" placeholder="Domicilio">
						</div>
						<div class="col-md-4 mb-3">
							<label class="control-label" for="addPhone">Teléfono</label>
							<input type="text" class="form-control" id="addPhone" placeholder="386-106-3066">
						</div>
						<div class="col-md-4 mb-3">
							<div class="text-center">
								<label class="control-label">Administrador</label><br>
								<input type="checkbox" class="form-control" id="addRoot">
							</div>
						</div>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary" id="btnAdd"><span class="fa fa-fw fa-check"></span></button>
						<button type="button" class="btn btn-secundary" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Add Item Modal -->

<?php 
	footer([
		'js/users/users.js'
	]);
?>