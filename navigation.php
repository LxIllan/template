<?php
if (!isset($_SESSION['user'])) {
	header('Location: login.php');
}
?>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
	<a class="navbar-brand" href="index.php"><i class="fa fa-fw fa-home"></i><?= $_SESSION['user']['branch']; ?></a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
			<!-- Venta -->
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Venta">
				<a class="nav-link" href="frm_venta.php">
					<i class="fa fa-fw fa-usd"></i>
					<span class="nav-link-text">Venta</span>
				</a>
			</li>
			<!-- /Venta -->

			<!-- Consumir Producto -->
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Consumir Producto">
				<a class="nav-link" data-toggle="modal" data-target="#usar_producto_modal">
					<i class="fa fa-fw fa-cubes"></i>
					<span class="nav-link-text">Consumir Producto</span>
				</a>
			</li>
			<!-- /Consumir Producto -->

			<!-- Realizar Gasto -->
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Realizar Gasto">
				<a class="nav-link" data-toggle="modal" data-target="#modalGasto">
					<i class="fa fa-fw fa-usd"></i>
					<span class="nav-link-text">Realizar Gasto</span>
				</a>
			</li>
			<!-- /Realizar Gasto -->

			<!-- Notas -->
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notas">
				<a class="nav-link" data-toggle="modal" data-target="#modalNotas">
					<i class="fa fa-fw fa-edit"></i>
					<span class="nav-link-text">Notas</span>
				</a>
			</li>
			<!-- /Notas -->

			<?php
			if (!$_SESSION['user']['root']) {
			?>
				<!-- Historial de gastos -->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Historial">
					<a class="nav-link" href="frm_historial_gastos.php">
						<i class="fa fa-fw fa-list-alt"></i>
						<span class="nav-link-text">Historial</span>
					</a>
				</li>
				<!-- /Historial de gastos -->
			<?php
			}
			?>

			<?php
			if ($_SESSION['user']['root']) {
			?>
				<!-- Productos -->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inventario">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProductos" data-parent="#exampleAccordion">
						<i class="fa fa-fw fa-cubes"></i>
						<span class="nav-link-text">Inventario</span>
					</a>
					<ul class="sidenav-second-level collapse" id="collapseProductos">
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Alimentos">
							<a class="nav-link" href="foods.php">
								<i class="fa fa-user fa-cutlery"></i>
								Alimentos
							</a>
						</li>
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Productos">
							<a class="nav-link" href="products.php">
								<i class="fa fa-user fa-cubes"></i>
								Productos
							</a>
						</li>
					</ul>
				</li>
				<!-- /Productos -->

				<!-- Historiales -->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Historiales">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseHistoriales" data-parent="#exampleAccordion">
						<i class="fa fa-fw fa-list-alt"></i>
						<span class="nav-link-text">Historiales</span>
					</a>
					<ul class="sidenav-second-level collapse" id="collapseHistoriales">
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Del día">
							<a class="nav-link" href="summary.php">
								<i class="fa fa-user fa-list-alt"></i>
								Del día
							</a>
						</li>
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Gastos">
							<a class="nav-link" href="expenses.php">
								<i class="fa fa-user fa-list-alt"></i>
								Gastos
							</a>
						</li>
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Alimentos surtidos">
							<a class="nav-link" href="history_foods.php">
								<i class="fa fa-user fa-list-alt"></i>
								Alimentos surtidos
							</a>
						</li>
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Productos">
							<a class="nav-link" href="history_products.php">
								<i class="fa fa-user fa-list-alt"></i>
								Productos
							</a>
						</li>
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Alimentos vendidos">
							<a class="nav-link" href="frm_historial_alimentos_vendidos.php">
								<i class="fa fa-user fa-list-alt"></i>
								Alimentos vendidos
							</a>
						</li>
					</ul>
				</li>
				<!-- /Historiales -->

				<!-- Configuracion -->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Configuración">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseConfiguracion" data-parent="#exampleAccordion">
						<i class="fa fa-fw fa-gear"></i>
						<span class="nav-link-text">Configuración</span>
					</a>
					<ul class="sidenav-second-level collapse" id="collapseConfiguracion">
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Paquetes">
							<a class="nav-link" href="combos.php">
								<i class="fa fa-fw fa-cubes"></i>
								<span class="nav-link-text">Paquetes</span>
							</a>
						</li>
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Platillos especiales">
							<a class="nav-link" href="special_dishes.php">
								<i class="fa fa-fw fa-cutlery"></i>
								<span class="nav-link-text">Platillos especiales</span>
							</a>
						</li>
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
							<a class="nav-link" href="users.php">
								<i class="fa fa-fw fa-users"></i>
								<span class="nav-link-text">Usuarios</span>
							</a>
						</li>
						<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sucursal">
							<a class="nav-link" href="branch.php">
								<i class="fa fa-fw fa-cubes"></i>
								<span class="nav-link-text">Sucursal</span>
							</a>
						</li>
						<li>
							<a class="nav-link" href="frm_resumen.php">
								<i class="fa fa-fw fa-list-alt"></i>
								<span class="nav-link-text">Resumen</span>
							</a>
						</li>
					</ul>
				</li>
				<!-- /Configuracion -->
			<?php
			}
			?>
		</ul>

		<ul class="navbar-nav sidenav-toggler">
			<li class="nav-item">
				<a class="nav-link text-center" id="sidenavToggler">
					<i class="fa fa-fw fa-angle-left"></i>
				</a>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<!-- User -->
			<li class="dropdown nav-item">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-user"></i>
					<?php
					echo "{$_SESSION['user']['name']} {$_SESSION['user']['last_name']}";
					if ($_SESSION['user']['root']) {
						echo ' #';
					} else {
						echo '  ';
					}
					?>
				</a>

				<ul class="dropdown-menu">
					<li class="dropdown-item">
						<a class="dropdown-item" href="profile.php">
							<i class="fa fa-user fa-fw"></i>
							Profile
						</a>
					<li class="dropdown-divider"></li>
					<li class="dropdown-item">
						<a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
							<i class="fa fa-fw fa-power-off"></i>
							Log out
						</a>
					</li>
				</ul>
			</li>
			<!-- /User -->
		</ul>
	</div>
</nav>
<!-- Navigation-->


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="logoutModalLabel">
					¿Desea salir?
				</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-footer">
				<a class="btn btn-primary" id="btnLogout" href="php/logout.php">Aceptar</a>
			</div>
		</div>
	</div>
</div>
<!-- /Logout Modal-->