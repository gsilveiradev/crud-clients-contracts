<?php

require_once ROOT_PATH . 'model/Autoloader.php';
require_once ROOT_PATH . 'model/ClientesService.php';


class ClientesController
{

	private $clientesService = null;

	
	public function __construct()
	{
		$this->clientesService = new ClientesService();
	}

	public function redirect($location)
	{
		header('Location: ' . $location);
	}

	public function handleRequest()
	{
		$op = isset($_GET['op']) ? $_GET['op'] : null;

		try {

			if (!$op || $op == 'list') {
				$this->listClientes();
			} elseif ($op == 'new') {
				$this->saveCliente();
			} elseif ($op == 'edit') {
				$this->editCliente();
			} elseif ($op == 'delete') {
				$this->deleteCliente();
			} elseif ($op == 'show') {
				$this->showCliente();
			} else {
				$this->showError("Página não encontrada", "Operação: " . $op . " não encontrada!");
			}
		} catch(Exception $e) {
			$this->showError("Erro", $e->getMessage());
		}
	}

	public function listClientes()
	{
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
		$clientes = $this->clientesService->getAllClientes($orderby);
		include ROOT_PATH . '/view/clientes.php';
	}

	public function saveCliente()
	{
		$title = 'Criar novo cliente';

		$nome 			 = '';
		$cpf			 = '';
		$cidade			 = '';
		$estado			 = '';
		$telefone		 = '';
		$data_nascimento = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {

			$nome 				= isset($_POST['nome']) 			? trim($_POST['nome']) 	  			: null;
			$cpf 				= isset($_POST['cpf']) 				? trim($_POST['cpf'])   			: null;
			$cidade 	 		= isset($_POST['cidade']) 			? trim($_POST['cidade'])   			: null;
			$estado 	 		= isset($_POST['estado']) 			? trim($_POST['estado'])   			: null;
			$telefone 	 		= isset($_POST['telefone']) 		? trim($_POST['telefone'])   		: null;
			$data_nascimento 	= isset($_POST['data_nascimento']) 	? trim($_POST['data_nascimento'])	: null;

			try {
				$this->clientesService->createNewCliente($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento);
				$this->redirect('clientes.php');
				return;
			} catch(ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		
		include ROOT_PATH . '/view/cliente-form.php';
	}

	public function editCliente()
	{
		$title  = "Editar cliente";

		$nome 			 = '';
		$cpf			 = '';
		$cidade			 = '';
		$estado			 = '';
		$telefone		 = '';
		$data_nascimento = '';
		$id      		 = $_GET['id'];

		$errors = array();

		$cliente = $this->clientesService->getCliente($id);

		if (isset($_POST['form-submitted'])) {

			$nome 				= isset($_POST['nome']) 			? trim($_POST['nome']) 	  			: null;
			$cpf 				= isset($_POST['cpf']) 				? trim($_POST['cpf'])   			: null;
			$cidade 	 		= isset($_POST['cidade']) 			? trim($_POST['cidade'])   			: null;
			$estado 	 		= isset($_POST['estado']) 			? trim($_POST['estado'])   			: null;
			$telefone 	 		= isset($_POST['telefone']) 		? trim($_POST['telefone'])   		: null;
			$data_nascimento 	= isset($_POST['data_nascimento']) 	? trim($_POST['data_nascimento'])	: null;
			
			try {
				$this->clientesService->editCliente($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento, $id);
				$this->redirect('clientes.php');
				return;
			} catch(ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		
		include ROOT_PATH . 'view/cliente-form-edit.php';
	}

	public function deleteCliente()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
			if (!$id) {
				throw new Exception('Internal error');
			}
			$this->clientesService->deleteCliente($id);

			$this->redirect('clientes.php');
	}

	public function showCliente()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id) {
			throw new Exception('Internal error');
		}
		$cliente = $this->clientesService->getCliente($id);

		include ROOT_PATH . 'view/cliente.php';
	}

	public function showError($title, $message)
	{
		include ROOT_PATH . 'view/error.php';
	}
}

?>
