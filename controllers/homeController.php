<?php
class homeController extends controller
{
	public function __construct()
	{
		if (!isset($_SESSION['user'])) {
			header("Location: " . BASE_URL . "login");
			exit;
		}
	}

	public function index()
	{
		$dados = array();
		$this->loadTemplate('home', $dados);
	}
}
