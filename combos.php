<?php

require_once 'template.php';

head('Paquetes');
body(['Paquetes']);
?>

<!-- Page Header -->
<div class="row">
	<div class="col-12">
		<h1><?= 'Paquetes' ?></h1>
		<hr>
	</div>
</div>
<!-- /.Page Header -->

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
						<th>Nombre</th>
						<th>Precio</th>
						<th>Descripción</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody id="combosTable">
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /card -->
</br>

<!--Add Item Modal -->
<div id="addModal" class="modal fade" role="dialog">
	<form id="addForm" class="form-horizontal" role="form">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nuevo</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-ligth alert-dismissible text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Tip:</strong> Para fijar un precio con centavos use un punto. <br> Ejemplo: 13.5
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="addName">Nombre</label>
							<input type="text" class="form-control" id="addName" placeholder="Nombre" required>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label" for="addPrice">Precio</label>
							<input type="number" class="form-control" id="addPrice" value="1" min="1" step=".1" step="any">
						</div>
					</div>
					<div class="form-row">
						<label class="control-label" for="description">Descripción</label><br>
						<textarea id="description" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btnAdd"><span class="fa fa-fw fa-check"></span></button>
					<button type="button" class="btn btn-secundary" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
			<!-- /Modal content-->
		</div>
	</form>
</div>
<!--/Add Item Modal -->

<!--Edit Item Modal -->
<div id="editModal" class="modal fade" role="dialog">
	<form id="editForm" class="form-horizontal" role="form">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Editar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="editId">
					<div class="alert alert-ligth alert-dismissible text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Tip:</strong> Para fijar un precio con centavos use un punto. <br> Ejemplo: 13.5
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="editName">Nombre</label>
							<input type="text" class="form-control" id="editName" required>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label" for="editPrice">Precio</label>
							<input type="number" class="form-control" id="editPrice" min="1" step=".1" step="any">
						</div>
					</div>
					<div class="form-row">
						<label class="control-label" for="editDescription">Descripción</label><br>
						<textarea id="editDescription" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="editDish"><span class="fa fa-fw fa-check"></span></button>
					<button type="button" class="btn btn-secundary" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
			<!-- /Modal content-->
		</div>
	</form>
</div>
<!--/Edit Item Modal -->

<?php
footer(['js/combos/combos.js']);
?>