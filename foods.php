<?php
    require_once 'template.php';
    head('Alimentos');
    body(['Alimentos']);	
?>


<?php
	require_once 'php/Controllers/FoodController.php';
	$foodController = new FoodController($_SESSION['jwt']);
	$foods = $foodController->getAll();
?>

<!-- card -->
<div>
	<div>
		<div class="text-center">
			<a href="#add" data-toggle="modal">
				<button type='button' class='btn btn-primary btn-sm'><span class='fa fa-fw fa-plus' aria-hidden='true'></span></button>
			</a>
		</div>
		<br>
		<div class="table-responsive">
			<table class="table table-hover table-condensed">
				<thead>
				<tr class="bg-primary">
					<th>Nombre</th>
					<th>Cantidad</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($foods as $food) { ?>
					<tr <?php if ($food->quantity <= $food->quantity_notif) { echo "class=\"table-secondary\"";} ?>>
						<td><a href="frm_platillos.php?id_alimento=<?= $food->id; ?>"><?= $food->name; ?></a></td>
						<td><?= $food->quantity; ?></td>
						<td><div class="btn-group">
								<button type="button" class="btn btn-ligth
									dropdown-toggle btn-sm"
										data-toggle="dropdown">&nbsp;&nbsp;<i
											class="fa fa-fw fa-cogs"></i>&nbsp;&nbsp;
									<span class="caret"></span>
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" 
										href="#supply<?= $food->id; ?>" data-toggle="modal">
											<i class="fa fa-fw fa-cart-plus"></i>
											Surtir
										</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item"
										href="#alter<?= $food->id; ?>" data-toggle="modal">
										<i class="fa fa-fw fa-exclamation"></i>
											Alterar
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item"
										href="#delete<?= $food->id; ?>" data-toggle="modal">
										<i class="fa fa-fw fa-trash"></i>
											Eliminar
									</a>
								</div>
							</div>
						</td>
					</tr>
						<!-- Supply Item Modal -->
						<div id="supply<?php echo $food->id; ?>" class="modal fade" role="dialog">
							<form method="post" class="form-horizontal" role="form">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Surtir Alimento</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<input type="hidden" name="food_id" value="<?php echo $food->id; ?>">
											<div class="form-row">
												<div class="form-group col-md-6">
													<label class="control-label">Nombre:</label><br>
													<input type="text" class="form-control" name="name" value="<?php echo $food->name; ?>" readonly>
												</div>                                                    
													<div class="form-group col-md-6">
														<label class="control-label">Cantidad:</label><br>
														<input type="number" class="form-control" name="quantity" value="<?php echo $food->quantity;?>" readonly>                                                       
													</div>
												
											</div>
											<div class="form-row">
												<div class="col-12">
													<input type="text" class="form-control" name="pieces" placeholder="12,13,15" pattern="[0-9.,]+" required>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" name="supply"><span class="fa fa-fw fa-check"></span></button>
											<button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /Supply Item Modal -->

						<!--Alter Item Modal -->
						<div id="alter<?php echo $food->id; ?>" class="modal fade" role="dialog">
							<form method="post" class="form-horizontal" role="form">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Alterar Alimento</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<input type="hidden" name="food_id" value="<?php echo $food->id; ?>">
											<div class="alert alert-ligth alert-dismissible text-center">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label class="control-label">Nombre:</label><br>
													<input type="text" class="form-control" name="name" value="<?php echo $food->name; ?>" readonly>
												</div>                                                    
													<div class="form-group col-md-6">
														<label class="control-label">Cantidad:</label><br>
														<input type="number" class="form-control" name="quantity" value="<?php echo $food->quantity; ?>" readonly>
													</div>                                                    
											</div>                                            
											<div class="form-row">
												<div class="form-group col-md-4">
													<label class="control-label">Cantidad:</label><br>
													<input type="number" class="form-control" name="pieces" value="0", step=".01" required>
												</div>
												<div class="form-group col-md-8">
													<label class="control-label">Justificacion:</label><br>
													<input type="text" name="reason" class="form-control" required>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" name="alter"><span class="fa fa-fw fa-check"></span></button>
											<button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /Alter Item Modal -->

				<?php
				} // end foreach

				if (count($foods) == 0) { 
					echo <<<HTML
						<div class="alert alert-primary text-center">
							<strong>¡Error!</strong> No tenemos alimentos registrados.
						</div>
					HTML;
				}

				if (isset($_POST['supply'])) {
					$foodId = $_POST['food_id'];
					$pieces = explode(',', trim($_POST['pieces']));

					if (Util::isArrayOfFloats($pieces)) {
						foreach ($pieces as $piece) {
							if ($piece > 0) {
								$foodController->supply($foodId, $piece);
							}
						}
						echo '<script>window.location.href="foods.php"</script>';
					} else {
						echo '<script>alert("Error in supply field.");</script>';
					}
				}

				if (isset($_POST['alter'])) {
					$foodId = $_POST['food_id'];
					$pieces = $_POST['pieces'];
					$reason = $_POST['reason'];
					
					if ($pieces != 0) {
						$foodController->alter($foodId, $pieces, $reason);
					}
					echo '<script>window.location.href="foods.php"</script>';
				}
				?>

				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /card -->



<div id="foodsCardJs"></div>

<?php 
	footer(['js/foods.js']);
?>