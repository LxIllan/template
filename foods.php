<?php
require_once 'template.php';
head('Alimentos');
body(['Alimentos']);
?>


<?php
require_once 'php/Controllers/FetchController.php';
$controller = new FetchController($_SESSION['jwt']);
$categories = $controller->getAll('categories')->categories;
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
						<th>Nombre</th>
						<th>Cantidad</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="foodsTable">
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
						<div class="form-group col-md-4">
							<label class="control-label" for="addName">Nombre:</label>
							<input type="text" class="form-control" id="addName" placeholder="Nombre" required>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label" for="addCategory">Categoría:</label>
							<select id="addCategory" class="form-control custom-select">
								<?php
								foreach ($categories as $category) {
									if ($category->id == 1) {
										continue;
									}
									echo "<option value='$category->id'>$category->name</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label" for="addQtyNotify">Notificar si hay:</label>
							<input type="number" class="form-control" id="addQtyNotify" value="5" min="0">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="control-label" for="addCost">Costo:</label>
							<input type="number" class="form-control" id="addCost" value="0" min="0">
						</div>
						<div class="form-group col-md-4">
							<label class="control-label" for="addQty">Cantidad:</label>
							<input type="number" class="form-control" id="addQty" value="0" min="0" step=".01" required>
						</div>
						<div class="form-group col-md-4">
							<!-- <label class="control-label">Precio:</label>
							<input type="number" class="form-control" name="precio" value="1" min="1" step="any" required> -->
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

<!--Alter Item Modal -->
<div id="alterModal" class="modal fade" role="dialog">
	<form id="alterForm" class="form-horizontal" role="form">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="alterFoodId" value="">
					<div class="alert alert-ligth alert-dismissible text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="alterName">Nombre:</label>
							<input type="text" class="form-control" id="alterName" readonly>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label" for="alterQty">Cantidad:</label>
							<input type="number" class="form-control" id="alterQty" readonly>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="control-label" for="alterPieces">Piezas:</label>
							<input type="number" class="form-control" id="alterPieces" value="0" , step=".01" required>
						</div>
						<div class="form-group col-md-8">
							<label class="control-label" for="alterReason">Justificacion:</label>
							<input type="text" id="alterReason" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btnAlter" name="supply"><span class="fa fa-fw fa-check"></span></button>
					<button class="btn btn-light" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
			<!-- /Modal content-->
		</div>
	</form>
</div>
<!-- /Alter Item Modal -->

<!-- Supply Item Modal -->
<div id="supplyModal" class="modal fade" role="dialog">
	<form id="supplyForm" class="form-horizontal" role="form">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Surtir</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="supplyFoodId" value="">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="supplyName">Nombre:</label>
							<input type="text" class="form-control" id="supplyName" readonly>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label" for="supplyQty">Cantidad:</label>
							<input type="number" class="form-control" id="supplyQty" readonly>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-12">
							<label class="control-label" for="supplyPieces">Piezas:</label>
							<input type="number" class="form-control" id="supplyPieces" value="0" , step=".01" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btnSupply" name="supply"><span class="fa fa-fw fa-check"></span></button>
					<button class="btn btn-light" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
			<!-- /Modal content-->
		</div>
	</form>
</div>
<!-- /Supply Item Modal -->

<?php
footer(['js/foods/foods.js']);
?>