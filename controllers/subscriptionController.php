<?php
class subscriptionController extends controller
{
	private $db;
	private $user;

	public function __construct()
	{
		if (!isset($_SESSION['user'])) {
			header("Location: " . BASE_URL . "auth");
			exit;
		}

		$this->db = Database::getConnection();
		$this->user = $_SESSION['user'];
	}

	public function index()
	{
		$dados = ["page" => "Assinatura", 'subscription' => []];

		$tenant_id = $this->user['tenant_id'];

		$sql = $this->db->prepare("SELECT * FROM subscriptions WHERE tenant_id = :tenant_id");
		$sql->bindParam(':tenant_id', $tenant_id, PDO::PARAM_INT);
		$sql->execute();

		if ($sql->rowCount() <= 0) {
			$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Nenhum assinatura encontrada.</p>";
		}

		$dados['subscription'] = $sql->fetch();

		$this->loadTemplate('subscription', $dados);
	}

	public function plans()
	{
		$dados = ["page" => "Planos"];
		$dados['plans'] = [
			[
				'name' => 'Plano Anual',
				'description' => 'Apenas R$ 1,99 por mês, cobrado anualmente com desconto de 2 meses.',
				'price' => 19.90,
				'billing_cycle' => 'Anual'
			],
			[
				'name' => 'Plano Vitalício',
				'description' => 'Pagamento único, acesso vitalício.',
				'price' => 19.90 * 4,
				'billing_cycle' => 'Vitalício'
			]
		];

		$this->loadTemplate('plans', $dados);
	}
}
