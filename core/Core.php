<?php
class Core
{
	public function run()
	{
		$url = '/';

		if (isset($_GET['url'])) {
			$url .= filter_var($_GET['url'], FILTER_SANITIZE_URL); // Remove caracteres perigosos
			$url = rtrim($url, '/'); // Remove barra extra no final
		}

		$params = [];
		$currentController = 'homeController';
		$currentAction = 'index';

		if (!empty($url) && $url !== '/') {
			$url = explode('/', $url);
			array_shift($url);

			// Sanitiza nomes de controller e ação para evitar nomes inválidos
			$currentController = ucfirst(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $url[0]))) . 'Controller';
			array_shift($url);

			if (!empty($url[0])) {
				$currentAction = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $url[0]));
				array_shift($url);
			}

			if (count($url) > 0) {
				$params = $url;
			}
		}

		// Se o arquivo do controller não existir, redireciona para NotFound
		if (!file_exists('controllers/' . $currentController . '.php')) {
			$this->notFound();
			return;
		}

		require_once 'controllers/' . $currentController . '.php';
		$c = new $currentController();

		// Se o método não existir, redireciona para NotFound
		if (!method_exists($c, $currentAction)) {
			$this->notFound();
			return;
		}

		call_user_func_array([$c, $currentAction], $params);
	}

	private function notFound()
	{
		require_once 'controllers/notfoundController.php';
		$c = new notfoundController();
		$c->index();
		exit;
	}
}
