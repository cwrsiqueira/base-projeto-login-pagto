<?php

class loginController extends controller
{

	public function index()
	{
		$dados = array();
		$this->loadTemplate('login', $dados);
	}

	public function sair()
	{

		session_start();
		unset($_SESSION['cLogin']);
		header("Location: " . BASE_URL);
	}
}
