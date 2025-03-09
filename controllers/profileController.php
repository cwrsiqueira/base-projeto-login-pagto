<?php
class profileController extends controller
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
		$dados = ["page" => "Perfil", 'user' => $this->user];

		if (!empty($_POST)) {
			$id = $this->user['user_id'];
			$name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
			$password_confirm = htmlspecialchars($_POST['password_confirm'], ENT_QUOTES, 'UTF-8');

			if (!empty($password) || !empty($password_confirm)) {

				if ($password !== $password_confirm) {
					$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Para alterar a senha<br>a Nova senha e Confirmar senha devem ser iguais.</p>";
					header("Location: " . BASE_URL . "profile");
					exit;
				}

				// Atualizar senha do usuário
				if (!(new User)->updateUserPassword($password, $id)) {
					$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Erro ao alterar a senha.</p>";
					header("Location: " . BASE_URL . "profile");
					exit;
				}
			}

			// Atualizar dados do usuário
			if (!(new User)->updateUser($name, $email, $id)) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Erro ao alterar os dados.</p>";
				header("Location: " . BASE_URL . "profile");
				exit;
			}

			// Buscar dados do usuário alterado
			$user = (new User)->getUserById($id);

			$_SESSION['user'] = $user;
			$_SESSION['msg'] = "<p class='container mt-3 alert alert-success'>Alterações salvas com sucesso.</p>";
			header("Location: " . BASE_URL . "profile");
			exit;
		}

		$this->loadTemplate('profile', $dados);
	}
}
