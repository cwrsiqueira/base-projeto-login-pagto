<!DOCTYPE html>
<html>

<head>
	<title>Título | Página Inicial</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/default.jpg" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>

<body>




	<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.mask.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>

</html>