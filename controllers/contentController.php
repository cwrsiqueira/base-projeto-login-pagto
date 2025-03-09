<?php
class contentController extends controller
{
	private $user;

	public function __construct()
	{
		if (!(new User)->isLogged()) {
			header("Location: " . BASE_URL . "home");
			exit;
		}

		$this->user = $_SESSION['user'];

		if (!(new Subscription)->isActive($this->user['tenant_id'])) {
			$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Por favor, renove sua assinatura.</p>";
			header("Location: " . BASE_URL . "subscription");
			exit;
		}
	}

	public function index()
	{
		$dados = ["page" => "Conteúdo 1"];
		$this->loadTemplate('content/first', $dados);
	}

	public function first()
	{
		$dados = ["page" => "Conteúdo 1"];
		$this->loadTemplate('content/first', $dados);
	}

	public function second()
	{
		$dados = ["page" => "Conteúdo 2"];
		$this->loadTemplate('content/second', $dados);
	}

	public function third()
	{
		$dados = ["page" => "Conteúdo 3"];
		$this->loadTemplate('content/third', $dados);
	}
}
