<!DOCTYPE html>
<html>

<head>
	<title> <?= APP_NAME ?> | <?= ucfirst($viewName) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="icon" href="<?= BASE_URL ?>assets/images/logo.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>

<body>
	<div class="container mt-3">
		<h1>Seja bem vindo(a), <small><?= $_SESSION['user']['name'] ?></small>!</h1>
		<hr>
		<a href="<?= BASE_URL ?>home" class="badge badge-primary p-2 mr-1" style="font-size: medium">Home </a>
		<a href="<?= BASE_URL ?>content/first" class="badge badge-secondary p-2 mr-1" style="font-size: medium">Conteúdo 1 <span class="badge badge-dark">Pago</span></a>
		<a href="<?= BASE_URL ?>content/second" class="badge badge-success p-2 mr-1" style="font-size: medium">Conteúdo 2 <span class="badge badge-secondary">Pago</span></a>
		<a href="<?= BASE_URL ?>content/third" class="badge badge-danger p-2 mr-1" style="font-size: medium">Conteúdo 3 <span class="badge badge-secondary">Pago</span></a>
		<a href="<?= BASE_URL ?>subscription/plans" class="badge badge-warning p-2 mr-1" style="font-size: medium">Planos </a>
		<a href="<?= BASE_URL ?>profile" class="badge badge-info p-2 mr-1" style="font-size: medium">Perfil </a>
		<a href="<?= BASE_URL ?>subscription" class="badge badge-light p-2 mr-1 border border-muted" style="font-size: medium">Assinatura </a>
		<a href="<?= BASE_URL ?>auth/logout" class="badge badge-dark p-2 mr-1" style="font-size: medium">Sair </a>
	</div>




	<?php $this->loadViewInTemplate($viewName, $viewData); ?>

	<footer class="text-center fixed-bottom p-3 border border-left-0 border-right-0 border-dark text-light bg-dark">
		®Base Projeto - <?= date('Y') ?> - Todos os direitos reservados.
	</footer>

	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.mask.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>

</html>