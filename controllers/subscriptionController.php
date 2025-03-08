<?php
class subscriptionController extends controller
{
	private $user;

	public function __construct()
	{
		if (!(new User)->isLogged()) {
			header("Location: " . BASE_URL . "auth");
			exit;
		}

		$this->user = $_SESSION['user'];
	}

	public function index()
	{
		$dados = ["page" => "Assinatura", 'subscription' => []];

		$tenant_id = $this->user['tenant_id'];

		// Buscar dados da assinatura
		$subscription = (new Subscription)->getSubscriptionByTenantId($tenant_id);

		if (!$subscription) {
			$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Nenhum assinatura encontrada.</p>";
		}

		$dados['subscription'] = $subscription;

		$this->loadTemplate('subscription', $dados);
	}

	public function plans()
	{
		$dados = ["page" => "Planos"];
		$dados['plans'] = [
			[
				'id' => 'planoanual',
				'name' => 'Plano Anual',
				'description' => 'Apenas R$ 1,99 por mês, cobrado anualmente com desconto de 2 meses.',
				'price' => 19.90,
				'billing_cycle' => 'Anual'
			],
			[
				'id' => 'planovitalicio',
				'name' => 'Plano Vitalício',
				'description' => 'Pagamento único, acesso vitalício.',
				'price' => 19.90 * 4,
				'billing_cycle' => 'Vitalício'
			]
		];

		$this->loadTemplate('plans', $dados);
	}
}
