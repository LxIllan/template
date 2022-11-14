<?php

require_once 'template.php';

head("Inicio");
body(["Inicio"]);
?>

<!-- Page Header -->
<div class="row">
	<div class="col-12">
		<h1>Inicio</h1>
		<hr>
	</div>
</div>
<!-- /.Page Header -->

<!-- row -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header text-center">Notas</div>
			<textarea id="notes" class="form-control"></textarea>
		</div>
	</div>
</div>
<!-- row -->

<br>

<!-- row -->
<div class="row">
	<div class="col-md-4">
		<div class="card bg-light mb-3">
			<div class="card-body">
				<a href="">
					<h5 class="card-title text-center">Cortesías</h5>
				</a>
				<p class="card-text text-center" id="totalCourtesies">Loading...</p>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-light mb-3">
			<div class="card-body">
				<a href="expenses.php">
					<h5 class="card-title text-center">Gastos</h5>
				</a>
				<p class="card-text text-center" id="totalExpenses">Loading...</p>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-light mb-3">
			<div class="card-body">
				<a href="">
					<h5 class="card-title text-center">Ventas</h5>
				</a>
				<p class="card-text text-center" id="totalSales">Loading...</p>
			</div>
		</div>
	</div>
</div>

<?php
footer(['js/index.js', 'js/dashboard.js']);
?>