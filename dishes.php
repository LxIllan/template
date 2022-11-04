<?php
    require_once 'template.php';
	require_once 'php/Controllers/FoodController.php';
	$foodId = $_GET['foodId'];
	$foodController = new FoodController($_SESSION['jwt']);
	$food = $foodController->get($foodId);

    head('Alimentos');
    body(['foods.php' => 'Alimentos', $food->name]);	
?>


<?php	
?>

<!-- row -->
<div class="row">
	<div class="col-12">
		<form id="editFoodForm">
			<input type="hidden" id="foodId" value="<?= $food->id; ?>">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label class="control-label">Nombre:</label>
					<input type="text" class="form-control" id="foodName" value="<?= $food->name; ?>" required>
				</div>
				<div class="form-group col-md-4">
					<label class="control-label">Cantidad:</label>
					<input type="number" class="form-control" id="foodQuantity" value="<?= $food->quantity; ?>" readonly>
				</div>
				<div class="form-group col-md-4">
					<label class="control-label">Notificar si hay:</label>
					<input type="number" class="form-control" id="foodQuantityNotify" value="<?= $food->quantity_notif; ?>">
				</div>				
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label class="control-label">Costo:</label>
					<input type="number" class="form-control" id="foodCost" value="<?= $food->cost; ?>" value="0" min="0" step="any">
				</div>
				<div class="form-group col-md-4">
					<label class="control-label">Piezas por paquete:</label>
					<input type="number" class="form-control" id="foodPiecesPerPackage" value="<?= $food->pieces_per_package; ?>">
				</div>
				<div class="form-group col-md-4">
					<div class="text-center">
						<label class="control-label">Ver en inicio</label>
						<input type="checkbox" id="foodShowInIndex" class="form-control" <?= ($food->show_in_index) ? 'checked' : ''; ?>>
					</div>
				</div>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-primary" id="editFood"><span class="fa fa-fw fa-check"></span></button>
			</div>
		</form>
	</div>
</div>
<!-- /.row -->
</br>

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
					<th>Porcion</th>
					<th>Precio</th>
					<th>Venta individual</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				</thead>
				<tbody id="dishesTable">
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
					<input type="hidden" id="addFoodId" value="<?= $food->id ?>">
					<input type="hidden" id="addCategoryId" value="<?= $food->category_id ?>">
					<div class="alert alert-ligth alert-dismissible text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Tip:</strong> Para fijar un precio con centavos use un punto. <br> Ejemplo: 13.5
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label">Nombre:</label>
							<input type="text" class="form-control" id="addName" placeholder="Nombre" required>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label">Precio:</label>
							<input type="number" class="form-control" id="addPrice" value="1" min="1" step=".1" step="any">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label">Porción:</label>
							<input type="number" class="form-control" id="addServing" value=".5" min=".01" step=".01" required>
						</div>
						<div class="form-group col-md-6">
							<div class="text-center">
								<label class="control-label">Venta individual</label>
								<input type="checkbox" class="form-control" id="addSellIndividually" checked>
							</div>
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
<!--/Add Item Modal -->

<!--Edit Item Modal -->
<div id="editModal" class="modal fade" role="dialog">
	<form id="editDishForm" class="form-horizontal" role="form">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Editar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="editDishId">
					<div class="alert alert-ligth alert-dismissible text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Tip:</strong> Para fijar un precio con centavos use un punto. <br> Ejemplo: 13.5
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label">Nombre:</label>
							<input type="text" class="form-control" id="editDishName" required>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label">Precio:</label>
							<input type="number" class="form-control" id="editDishPrice" min="1" step=".1" step="any">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label">Porción:</label>
							<input type="number" class="form-control" id="editDishServing" min=".01" step=".01" required>
						</div>
						<div class="form-group col-md-6">
							<div class="text-center">
								<label class="control-label">Venta individual</label>
								<input type="checkbox" class="form-control" id="editDishSellIndividually">
							</div>
						</div>
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
	footer(['js/dishes.js']);
?>