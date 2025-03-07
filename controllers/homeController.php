<?php
class homeController extends controller
{
	public function __construct()
	{
		if (!isset($_SESSION['user'])) {
			header("Location: " . BASE_URL . "auth");
			exit;
		}
	}

	public function index()
	{
		$dados = ["page" => "Home"];
		$this->loadTemplate('home', $dados);
	}
}
