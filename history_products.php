<?php

require_once 'template.php';

head('Productos');
body(['Productos']);

?>

<!-- Page Header -->
<div class="row">
	<div class="col-12">
		<h1>Productos</h1>
		<hr>
	</div>
</div>
<!-- /.Page Header -->

<!-- row -->
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
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

<ul class="nav nav-tabs nav-justified" id="productTabs" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="supplied-tab" data-toggle="tab" href="#supplied" role="tab" aria-controls="supplied" aria-selected="true">Surtidos</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="altered-tab" data-toggle="tab" href="#altered" role="tab" aria-controls="altered" aria-selected="false">Alterados</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="used-tab" data-toggle="tab" href="#used" role="tab" aria-controls="used" aria-selected="false">Usados</a>
	</li>
</ul>

<div class="tab-content" id="productTabsContent">
	<div class="tab-pane fade" id="altered" role="tabpanel" aria-labelledby="altered-tab">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="bg-light">
						<th>Fecha</th>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Justificación</th>
						<th>Nueva cantidad</th>
						<th>Costo</th>
						<th>Usuario</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="alteredTable">
				</tbody>
			</table>
		</div>
	</div>

	<div class="tab-pane fade show active" id="supplied" role="tabpanel" aria-labelledby="supplied-tab">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="bg-light">
						<th>Fecha</th>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Nueva cantidad</th>
						<th>Costo</th>
						<th>Usuario</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="suppliedTable">
				</tbody>
			</table>
		</div>
	</div>

	<div class="tab-pane fade" id="used" role="tabpanel" aria-labelledby="used-tab">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="bg-light">
						<th>Fecha</th>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Usuario</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="usedTable">
				</tbody>
			</table>
		</div>
	</div>
</div>

<!--Cancel altered Modal -->
<div id="cancelAlteredModal" class="modal fade" role="dialog">
	<form id="cancelAlteredForm">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cancelar surtido</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="alteredId" value="">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="alteredName">Producto</label>
							<input type="text" class="form-control" id="alteredName" readonly><br>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label" for="alteredReason">Justificación</label>
							<input type="text" class="form-control" id="alteredReason" readonly>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="alteredDate">Fecha</label>
							<input type="text" class="form-control" id="alteredDate" readonly>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label" for="alteredQty">Cantidad</label>
							<input type="number" class="form-control" id="alteredQty" readonly>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-light" name="btnCancelAltered"><span class="fa fa-fw fa-check"></span></button>
					<button class="btn btn-primary" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- /Cancel altered Modal -->

<!--Cancel supplied Modal -->
<div id="cancelSuppliedModal" class="modal fade" role="dialog">
	<form id="cancelSuppliedForm">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cancelar alterado</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="suppliedId" value="">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label class="control-label" for="suppliedName">Producto</label>
							<input type="text" class="form-control" id="suppliedName" readonly><br>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="suppliedDate">Fecha</label>
							<input type="text" class="form-control" id="suppliedDate" readonly>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label" for="suppliedQty">Cantidad</label>
							<input type="number" class="form-control" id="suppliedQty" readonly>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-light" name="btnCancelSupplied"><span class="fa fa-fw fa-check"></span></button>
					<button class="btn btn-primary" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- /Cancel supplied Modal -->

<!--Cancel used Modal -->
<div id="cancelUsedModal" class="modal fade" role="dialog">
	<form id="cancelUsedForm">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cancelar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="usedId" value="">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label class="control-label" for="usedName">Producto</label>
							<input type="text" class="form-control" id="usedName" readonly><br>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="usedDate">Fecha</label>
							<input type="text" class="form-control" id="usedDate" readonly>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label" for="usedQty">Cantidad</label>
							<input type="number" class="form-control" id="usedQty" readonly>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-light" name="btnCancelUsed"><span class="fa fa-fw fa-check"></span></button>
					<button class="btn btn-primary" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- /Cancel used Modal -->

<?php
footer(['js/products/histories.js']);
?>