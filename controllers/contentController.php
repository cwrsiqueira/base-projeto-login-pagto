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
		$this->loadTemplate('content/feed', $dados);
	}

	public function single()
	{
		$dados = ["page" => "Conteúdo 1"];
		$this->loadTemplate('content/single', $dados);
	}
}
