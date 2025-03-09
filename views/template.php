<!DOCTYPE html>
<html>

<head>
	<title> <?= APP_NAME ?> | <?= ucfirst($viewName) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="icon" href="<?= BASE_URL ?>assets/images/logo.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css" />
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="<?= BASE_URL ?>">
			<img src="<?= BASE_URL ?>/assets/images/logo.png" alt="Dulang Web" width="80" height="80">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>content">Feed</a></li>
				<li class="nav-item"><a class="nav-link" href="#por-que-o-dulang">Por que o Dulang?</a></li>
				<li class="nav-item"><a class="nav-link" href="#como-funciona">Como funciona?</a></li>
				<!-- <li class="nav-item"><a class="nav-link" href="#testemunhos">Testemunhos</a></li> -->
				<li class="nav-item"><a class="nav-link" href="#preco">Preço</a></li>
				<li class="nav-item"><a class="nav-link btn btn-primary text-white" href="<?= BASE_URL ?>auth/signup">Teste por 7 dias grátis</a></li>
			</ul>
		</div>
	</nav>

	<?php $this->loadViewInTemplate($viewName, $viewData); ?>

	<footer class="bg-dark text-white text-center py-3">
		<p>&copy; 2025 Dulang. Todos os direitos reservados.</p>
		<p><i class="fas fa-envelope"></i> contato@carlosdev.com.br</p>
	</footer>

	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.mask.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
	<script>
		var BASE_URL = "<?php echo BASE_URL; ?>";
	</script>
</body>

</html>