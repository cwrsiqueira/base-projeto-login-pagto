<?php
require_once __DIR__ . '/../database.php';

class authController extends controller
{
	private $db;

	public function __construct()
	{
		$this->db = Database::getConnection(); // Obtendo a instância do banco de dados
	}

	public function index()
	{
		$this->loadViewInTemplate('login');
	}

	public function signup()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); // Alternativa segura
			$password_confirm = htmlspecialchars($_POST['password_confirm'], ENT_QUOTES, 'UTF-8'); // Alternativa segura

			if ($password !== $password_confirm) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>As senhas devem ser iguais.</p>";
				header("Location: " . BASE_URL . "auth/signup");
				exit;
			}

			if (!$name || !$email || !$password) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Todos os campos são obrigatórios.</p>";
				header("Location: " . BASE_URL . "auth/signup");
				exit;
			}

			$hashPassword = password_hash($password, PASSWORD_DEFAULT);
			$role = "admin";

			// Verificar se o usuário existe no banco
			$stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($user) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Esse e-mail já está cadastrado!</p>";
				header("Location: " . BASE_URL . "auth/signup");
				exit;
			}

			// Cadastrar tenant no banco
			$stmt = $this->db->prepare("INSERT INTO tenants (name, email) VALUES (:name, :email)");
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->execute();
			$tenant_id = $this->db->lastInsertId();

			if (!$tenant_id) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Erro ao efetuar cadastro. Tente novamente!</p>";
				header("Location: " . BASE_URL . "auth/signup");
				exit;
			}

			// Cadastrar usuário no banco
			$stmt = $this->db->prepare("INSERT INTO users (tenant_id, name, email, password, role) VALUES (:tenant_id, :name, :email, :password, :role)");
			$stmt->bindParam(':tenant_id', $tenant_id, PDO::PARAM_INT);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $hashPassword, PDO::PARAM_STR);
			$stmt->bindParam(':role', $role, PDO::PARAM_STR);
			$stmt->execute();
			$user_id = $this->db->lastInsertId();

			// Cadastrar assinatura teste 7 dias grátis
			$plan = 'Teste 7 dias';
			$price = '0.00';
			$currency = 'BRL';
			$status = 'active';
			$renew_at = (new DateTime())->modify('+7 days')->format('Y-m-d 23:59:59');

			$stmt = $this->db->prepare("INSERT INTO subscriptions SET tenant_id = :tenant_id, plan = :plan, price = :price, currency = :currency, status = :status, renew_at = :renew_at");
			$stmt->bindParam(':tenant_id', $tenant_id, PDO::PARAM_INT);
			$stmt->bindParam(':plan', $plan, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_STR);
			$stmt->bindParam(':currency', $currency, PDO::PARAM_STR);
			$stmt->bindParam(':status', $status, PDO::PARAM_STR);
			$stmt->bindParam(':renew_at', $renew_at, PDO::PARAM_STR);
			$stmt->execute();

			// Buscar dados do usuário cadastrado
			$stmt = $this->db->prepare("SELECT id as user_id, tenant_id, name, email, role, (select name from tenants where users.tenant_id = tenants.id) as tenant_nome FROM users WHERE id = :user_id");
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$user) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-success'>Cadastro efetuado com sucesso. Faça o login!</p>";
				header("Location: " . BASE_URL . "auth/login");
				exit;
			}

			$_SESSION['user'] = $user;
			header("Location: " . BASE_URL . "home");
			exit;
		}

		$this->loadView('signup');
	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); // Alternativa segura

			// Verificar se o usuário existe no banco
			$stmt = $this->db->prepare("SELECT id as user_id, tenant_id, name, email, role, password, (select name from tenants where users.tenant_id = tenants.id) as tenant_nome FROM users WHERE email = :email LIMIT 1");
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$user || !password_verify($password, $user['password'])) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Usuário ou senha incorretos!</p>";
				header("Location: " . BASE_URL . "auth/login");
				exit;
			}

			// 🔥 Verificar se a senha precisa ser re-hashada
			if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
				$newHash = password_hash($password, PASSWORD_DEFAULT);

				$updateStmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
				$updateStmt->bindValue(":password", $newHash, PDO::PARAM_STR);
				$updateStmt->bindValue(":id", $user['id'], PDO::PARAM_INT);
				$updateStmt->execute();
			}

			$_SESSION['user'] = $user;
			unset($_SESSION['user']['password']);
			header("Location: " . BASE_URL . "home");
			exit;
		}

		$this->loadView('login');
	}

	public function forgotPassword()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

			echo '<pre>';
			var_dump($email);
			echo '</pre>';
			exit;
		}

		$this->loadView('forgot-password');
	}

	public function logout()
	{
		session_start();
		unset($_SESSION['user']);
		header("Location: " . BASE_URL . "home");
		exit;
	}
}
