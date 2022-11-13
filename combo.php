<?php
require_once 'template.php';
require_once 'php/Controllers/FetchController.php';

$comboId = $_GET['comboId'];
$fetchController = new FetchController($_SESSION['jwt']);

$combo = $fetchController->get("combos", $comboId)->dish;
$dishes = $fetchController->getAll("combos/$comboId/dishes")->dishes;

head('Paquetes');
body(['combos.php' => 'Paquetes', $combo->name]);
?>

<?php
require_once 'php/Controllers/FetchController.php';
$controller = new FetchController($_SESSION['jwt']);
$categories = $controller->getAll('categories?dishes=true&all=true')->categories;
?>

<p id="comboId" hidden><?= $combo->id ?></p>
<?= $combo->description ?>

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
	footer(['js/combos/dishes.js']);
	?>