<?php
require_once __DIR__ . '/../database.php';

class authController extends controller
{
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
			$user = (new User)->getUserByEmail($email);

			if ($user) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Esse e-mail já está cadastrado!</p>";
				header("Location: " . BASE_URL . "auth/signup");
				exit;
			}

			// Cadastrar tenant no banco
			$tenant_id = (new Tenant)->addTenant($name, $email);

			if (!$tenant_id) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Erro ao efetuar cadastro. Tente novamente!</p>";
				header("Location: " . BASE_URL . "auth/signup");
				exit;
			}

			// Cadastrar usuário no banco
			$user_id = (new User)->addUser($tenant_id, $name, $email, $hashPassword, $role);

			// Buscar dados do usuário cadastrado
			$user = (new User)->getUserById($user_id);

			if (!$user) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-success'>Cadastro efetuado com sucesso. Faça o login!</p>";
				header("Location: " . BASE_URL . "auth/login");
				exit;
			}

			$_SESSION['user'] = $user;
			header("Location: " . BASE_URL . "content");
			exit;
		}

		$this->loadView('signup');
	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); // Alternativa segura

			$user = (new User)->authentication($email, $password);

			if (!$user) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Usuário ou senha incorretos!</p>";
				header("Location: " . BASE_URL . "auth/login");
				exit;
			}

			$_SESSION['user'] = $user;
			header("Location: " . BASE_URL . "content");
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
		header("Location: " . BASE_URL . "content");
		exit;
	}
}
