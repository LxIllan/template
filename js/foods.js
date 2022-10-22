$(document).ready(function () {    
	getFetch('foods').then((data) => {
		renderFoods(data.foods);
	});

	$('#btnSupply').click(() => {
		foodId = $('#foodId').val();
		quantity = $('#quantity').val();
		supply(foodId, quantity);
	});
});

const supply = (foodId, quantity) => {
	console.log(`file: foods.js - line 15 - quantity`, quantity);
	console.log(`file: foods.js - line 15 - foodId`, foodId);
}

const renderFoods = (foods) => {
	let html = `<!-- card -->
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
					<tbody>`;
	foods.forEach(food => {
		html += `<tr>
					<tr <?php if ($food->quantity <= $food->quantity_notif) { echo "class=\"table-secondary\"";} ?>>
						<td><a href="frm_platillos.php?id_alimento=${food.id}">${food.name}</a></td>
						<td>${food.quantity}</td>
						<td><div class="btn-group">
								<button type="button" class="btn btn-ligth
									dropdown-toggle btn-sm"
										data-toggle="dropdown">&nbsp;&nbsp;<i
											class="fa fa-fw fa-cogs"></i>&nbsp;&nbsp;
									<span class="caret"></span>
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" 
										href="#supply${food.id}" data-toggle="modal">
											<i class="fa fa-fw fa-cart-plus"></i>
											Surtir
										</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item"
										href="#alter${food.id}" data-toggle="modal">
										<i class="fa fa-fw fa-exclamation"></i>
											Alterar
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item"
										href="#delete${food.id}" data-toggle="modal">
										<i class="fa fa-fw fa-trash"></i>
											Eliminar
									</a>
								</div>
							</div>
						</td>
					</tr>
						<!-- Supply Item Modal -->
						<div id="supply${food.id}" class="modal fade" role="dialog">
							<form method="post" class="form-horizontal" role="form">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Surtir Alimento</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<input type="hidden" id="foodId" name="food_id" value="${food.id}">
											<div class="form-row">
												<div class="form-group col-md-6">
													<label class="control-label">Nombre:</label><br>
													<input type="text" class="form-control" name="name" value="${food.name}" readonly>
												</div>                                                    
													<div class="form-group col-md-6">
														<label class="control-label">Cantidad:</label><br>
														<input type="number" class="form-control" id="quantity" name="quantity" value="${food.quantity}" readonly>                                                       
													</div>
												
											</div>
											<div class="form-row">
												<div class="col-12">
													<input type="text" class="form-control" name="pieces" placeholder="12,13,15" pattern="[0-9.,]+" required>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-primary" id="btnSupply" name="supply"><span class="fa fa-fw fa-check"></span></button>
											<button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /Supply Item Modal -->

						<!--Alter Item Modal -->
						<div id="alter${food.id}" class="modal fade" role="dialog">
							<form method="post" class="form-horizontal" role="form">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Alterar Alimento</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<input type="hidden" name="food_id" value="${food.id}">
											<div class="alert alert-ligth alert-dismissible text-center">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label class="control-label">Nombre:</label><br>
													<input type="text" class="form-control" name="name" value="${food.name}" readonly>
												</div>                                                    
													<div class="form-group col-md-6">
														<label class="control-label">Cantidad:</label><br>
														<input type="number" class="form-control" name="quantity" value="${food.quantity}" readonly>
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
				} // end foreach`;
			});
	html += `</tbody>
			</table>
		</div>
	</div>
	</div>
	<!-- /card -->
	</br>`;
	$('#foodsCardJs').html(html);		
};