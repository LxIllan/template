<?php
require_once 'template.php';
require_once 'php/Controllers/FetchController.php';

$specialDishId = $_GET['specialDishId'];
$fetchController = new FetchController($_SESSION['jwt']);

$specialDish = $fetchController->get("special-dishes", $specialDishId)->dish;
$dishes = $fetchController->getAll("special-dishes/$specialDishId/dishes")->dishes;

head('Paquetes');
body(['special_dishes.php' => 'Platillos Especiales', $specialDish->name]);
?>

<?php
require_once 'php/Controllers/FetchController.php';
$controller = new FetchController($_SESSION['jwt']);
$categories = $controller->getAll('categories?dishes=true&all=true')->categories;
?>

<!-- Page Header -->
<div class="row">
	<div class="col-12">
		<h1><?= $specialDish->name ?></h1>
		<hr>
	</div>
</div>
<!-- /.Page Header -->

<!-- Combo description -->
<p id="specialDishId" hidden><?= $specialDish->id ?></p>
<?= $specialDish->description ?>
<hr>
<!-- /Combo description -->

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
	<div class="modal-dialog modal-md">
		<!-- Modal content-->
		<div class="modal-content">
			<form id="addDishToComboForm" class="form-horizontal">
				<div class="modal-header">
					<h4 class="modal-title">Agregar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<?php
						foreach ($categories as $category) {
							if ($category->id == Util::COMBO_ID) {
								continue;
							}
							if (!empty($category->dishes)) {
								echo <<<HTML
									<div class="form-group col-md-12">
										<label class="control-label">$category->name</label>
										<select id="$category->name" class="form-control custom-select">
											<option value="0">Elegir...</option>
								HTML;
								foreach ($category->dishes as $dish) {
									if ($dish->id == $specialDish->id) {
										continue;
									}
									echo <<<HTML
										<option value="$dish->id">$dish->name</option>
									HTML;
								}
								echo <<<HTML
										</select>
									</div>
								HTML;
							}
						}
						?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btnAddDishToCombo"><span class="fa fa-fw fa-plus"></span></button>
					<button class="btn btn-secundary" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</form>
		</div>
	</div>
	<!-- /Add Item Modal -->

	<?php
	footer(['js/special_dishes/dishes.js']);
	?>