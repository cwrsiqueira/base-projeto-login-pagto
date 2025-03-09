<?php
class subscriptionController extends controller
{
	private $user;

	public function __construct()
	{
		if (!(new User)->isLogged()) {
			header("Location: " . BASE_URL . "home");
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
			header("Location: " . BASE_URL . "checkoutMercadoPago");
			exit;
		}

		$dados['subscription'] = $subscription;
		$dados['payments'] = (new Payment)->getPaymentsBy($tenant_id);

		$this->loadTemplate('subscription', $dados);
	}

	public function view() {}

	public function edit() {}

	public function delete() {}

	public function plans()
	{
		$dados = ["page" => "Planos"];
		$dados['plans'] = [
			[
				'id' => 'planodulangweb',
				'name' => 'Plano Dulang Web',
				'description' => 'Apenas R$ 19,90 por mês, cobrado anualmente com desconto de 2 meses.',
				'price' => 199.00,
				'billing_cycle' => 'Anual'
			],
		];

		$this->loadTemplate('plans', $dados);
	}
}
