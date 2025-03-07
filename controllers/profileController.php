<?php
class profileController extends controller
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
		$dados = ["page" => "Perfil", 'user' => $this->user];

		if (!empty($_POST)) {
			$id = $this->user['user_id'];
			$name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

			if (!empty($password)) {
				$password_confirm = htmlspecialchars($_POST['password_confirm'], ENT_QUOTES, 'UTF-8');

				if ($password !== $password_confirm) {
					$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Para alterar a senha<br>a Nova senha e Confirmar senha devem ser iguais.</p>";
					header("Location: " . BASE_URL . "profile");
					exit;
				}

				$newPassword = password_hash($password, PASSWORD_DEFAULT);

				$sql = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
				$sql->bindParam(':password', $newPassword,  PDO::PARAM_STR);
				$sql->bindParam(':id', $id,  PDO::PARAM_INT);
				if (!$sql->execute()) {
					$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Erro ao alterar a senha.</p>";
					header("Location: " . BASE_URL . "profile");
					exit;
				}
			}

			$sql = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
			$sql->bindParam(':name', $name,  PDO::PARAM_STR);
			$sql->bindParam(':email', $email,  PDO::PARAM_STR);
			$sql->bindParam(':id', $id,  PDO::PARAM_INT);
			if (!$sql->execute()) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-danger'>Erro ao alterar os dados.</p>";
				header("Location: " . BASE_URL . "profile");
				exit;
			}

			// Buscar dados do usuário alterado
			$stmt = $this->db->prepare("SELECT id as user_id, tenant_id, name, email, role, (select name from tenants where users.tenant_id = tenants.id) as tenant_nome FROM users WHERE id = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$user) {
				$_SESSION['msg'] = "<p class='container mt-3 alert alert-success'>Alterações salvas!</p>";
				header("Location: " . BASE_URL . "auth/login");
				exit;
			}

			$_SESSION['user'] = $user;

			$_SESSION['msg'] = "<p class='container mt-3 alert alert-success'>Alterações salvas com sucesso.</p>";
			header("Location: " . BASE_URL . "profile");
			exit;
		}

		$this->loadTemplate('profile', $dados);
	}
}
