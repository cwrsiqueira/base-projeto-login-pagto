<?php
class homeController extends controller
{
	public function __construct()
	{
		if ((new User)->isLogged()) {
			header("Location: " . BASE_URL . "content");
			exit;
		}
	}

	public function index()
	{
		$dados = ["page" => "Home"];
		$this->loadView('home', $dados);
	}
}
