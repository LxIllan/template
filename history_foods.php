<?php    
	
	require_once 'template.php';    

	head('Blank');
	body(['Blank']);        
?>

<!-- card Surtidos -->
<div class="card">
	<div class="card-header" role="tab" id="headingOne">
		<h5 class="mb-0">
			<div class="text-center">
				<a data-toggle="collapse" href="#collapseSuppliedFoods" aria-expanded="true" aria-controls="collapseSuppliedFoods">
					Surtidos
				</a>
			</div>
		</h5>
	</div>

	<div id="collapseSuppliedFoods" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
				<tr class="bg-light">
					<th>Fecha</th>
					<th>Alimento</th>
					<th>Cantidad</th>
					<th>Nueva cantidad</th>
					<th>Usuario</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /card Surtidos -->  

<!--Cancelar surtido Item Modal -->
<div id="cancelar_surtido<?php echo $id_alimento_surtido; ?>" class="modal fade" role="dialog">
	<form method="post" class="form-horizontal" role="form">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cancelar surtido</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_surtido_cancelado" value="<?php echo $id_alimento_surtido; ?>">
					<label class="control-label">Alimento:</label>
					<input type="text" class="form-control" name="alimento" value="<?php echo $alimento; ?>" readonly><br>
					<label class="control-label">Cantidad:</label><br>
					<input type="text" class="form-control" name="cantidad" value="<?php echo $cantidad; ?>" readonly>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info" name="cancelar_surtido"><span class="fa fa-fw fa-check"></span></button>
					<button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-fw fa-remove"></span></button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- /Cancelar surtido Item Modal -->

<?php 
	footer();
?>
