<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('Location: login.php');
}

require_once 'php/Util.php';

function head($title = Util::APP_NAME) {
	echo <<<HTML
	<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				<meta name="description" content="">
				<link rel="shortcut icon" href="img/logo.png">
				<meta name="author" content="Fernando Illan">
				<title>$title</title>
				<!-- Bootstrap core CSS-->
				<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
				<!-- Custom fonts for this template-->
				<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
				<!-- Custom styles for this template-->
				<link href="css/sb-admin.css" rel="stylesheet">
			</head>
	HTML;
}

function createBreadcrumbs(array $breadcrumbs = []): string  {
	$i = 0;
	$len = count($breadcrumbs);
	$breadcrumb = '';
	foreach ($breadcrumbs as $key => $value) {                                            
		$breadcrumb .= '<li class="breadcrumb-item"><a href="' . $key . '">' . $value . '</a></li>';
		if ($i == $len - 2) {
			break;
		}
		$i++;
	}
	return $breadcrumb;
}

function body(array $breadcrumbs = []) {
	$breadcrumbs = ['index.php' => Util::APP_NAME] + $breadcrumbs;        
	$breadcrumb = createBreadcrumbs($breadcrumbs);
	require_once 'navigation.php';
	echo <<<HTML
			<body class="fixed-nav sticky-footer bg-dark" id="page-top">

				<!-- content-wrapper-->
				<div class="content-wrapper">
				
					<!-- container-fluid-->
					<div class="container-fluid">

						<!-- Breadcrumbs-->
						<ol class="breadcrumb">
							$breadcrumb
							<li class="breadcrumb-item active">{$breadcrumbs[array_key_last($breadcrumbs)]}</li>
						</ol>
						<!-- /.Breadcrumbs-->

						<!-- Page Header -->
						<div class="row">
							<div class="col-12">
								<h1 class="modal-header">
								{$breadcrumbs[array_key_last($breadcrumbs)]}
								</h1>
							</div>
						</div>
						<!-- /.Page Header -->
	HTML;
}

function footer(array $sources = []) {
	$footer = Util::FOOTER;
	if (count($sources) > 0) {
        $source = "";
        foreach ($sources as $value) {
            $source .= "<script src=\"$value\"></script>";
        }
    } else {
        $source = "";
    }
	echo <<<HTML
					</div>
					<!-- /.container-fluid-->
					<br>

					<!-- footer -->
					<footer class="sticky-footer">
						<div class="container">
							<div class="text-center">
								<small>$footer</small>
							</div>
						</div>
					</footer>
					<!-- /.footer -->
		
					<!-- Scroll to Top Button-->
					<a class="scroll-to-top rounded" href="#page-top">
						<i class="fa fa-angle-up"></i>
					</a>
					<!-- /.Scroll to Top Button-->
	
					<!-- Bootstrap core JavaScript-->
					<script src="vendor/jquery/jquery.min.js"></script>
					<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
					<!-- Core plugin JavaScript-->
					<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
					<!-- Page level plugin JavaScript-->
					<script src="vendor/chart.js/Chart.min.js"></script>
					<script src="vendor/datatables/jquery.dataTables.js"></script>
					<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
					<!-- Custom scripts for all pages-->
					<script src="js/sb-admin.min.js"></script>
					<!-- Custom scripts for this page-->
					<script src="js/sb-admin-datatables.min.js"></script>
					<script src="js/sb-admin-charts.min.js"></script>
					<script src="js/sweetalert2@11.js"></script>
					<script src="js/helpers/fetch.js"></script>
					<script src="js/auth/logout.js"></script>
					$source
				</div>
				<!-- /.content-wrapper-->
			</body>
		</html>
	HTML;
}
