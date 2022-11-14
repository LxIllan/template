<?php
require_once 'template.php';
head('Gastos');
body(['Gastos']);
?>

<!-- Page Header -->
<div class="row">
	<div class="col-12">
		<h1 class="modal-header">Gastos</h1>
		<hr>
		<h3 id="total">Loading...</h3>
		<hr>
	</div>
</div>
<!-- /.Page Header -->

<!-- row -->
<div class="row">
	<div class="col-12">
		<form id="searchForm">
			<div class="form-row">
				<div class="form-group col-md-4">
					<div class="text-center">
						<input type="date" class="form-control" id="from" value="<?= date('Y-m-d') ?>" min="2022-11-11" max="<?= date("Y-m-d") ?>">
					</div>
				</div>
				<div class="form-group col-md-4">
					<div class="text-center">
						<input type="date" class="form-control" id="to" value="<?= date('Y-m-d') ?>" min="2022-11-11" max="<?= date("Y-m-d") ?>">
					</div>
				</div>
				<div class="form-group col-md-2">
					<div class="text-center">
						<label class="control-label" for="deleted">Mostrar eliminados</label>
						<input type="checkbox" class="form-control" id="deleted">
					</div>
				</div>
				<div class="form-group col-md-2">
					<div class="text-center">
						<button type="submit" class="btn btn-primary" id="btnSearch"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</div>
		</form>
		<br>
	</div>
</div>
<!-- /row -->

<hr>

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
						<th>Fecha</th>
						<th>Cantidad</th>
						<th>Justificación</th>
						<th>Usuario</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody id="expensesTable">
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
						<strong>Tip:</strong> Para fijar una cantidad con centavos use un punto. <br> Ejemplo: 13.5
					</div>
					<div class="form-row">
						<div class="form-group col-md-3">
							<label class="control-label" for="addAmount">Cantidad</label>
							<input type="number" class="form-control" id="addAmount" value="0" , step=".01" required>
						</div>
						<div class="form-group col-md-9">
							<label class="control-label" for="addReason">Justificacion</label>
							<input type="text" id="addReason" class="form-control" required>
						</div>
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
<!--Add Item Modal -->

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
					<div class=" alert alert-ligth alert-dismissible text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Tip:</strong> Para fijar una cantidad con centavos use un punto. <br> Ejemplo: 13.5
					</div>
					<div class="form-row">
						<div class="form-group col-md-3">
							<label class="control-label" for="editAmount">Cantidad</label>
							<input type="number" class="form-control" id="editAmount" value="0" , step=".01" required>
						</div>
						<div class="form-group col-md-9">
							<label class="control-label" for="editReason">Justificacion</label>
							<input type="text" id="editReason" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btnEdit"><span class="fa fa-fw fa-check"></span></button>
					<button type="button" class="btn btn-secundary" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
			<!-- /Modal content-->
		</div>
	</form>
</div>
<!--Edit Item Modal -->

<?php
footer(['js/expenses/expenses.js']);
?>