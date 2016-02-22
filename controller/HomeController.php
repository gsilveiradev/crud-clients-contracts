<?php

require_once ROOT_PATH . 'model/Autoloader.php';
require_once ROOT_PATH . 'model/ContratosService.php';
require_once ROOT_PATH . 'model/ClientesService.php';


class HomeController
{

	private $contratosService = null;
	private $clientesService = null;

	
	public function __construct()
	{
		$this->contratosService = new ContratosService();
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
				$this->listContratos();
			} elseif ($op == 'new') {
				$this->saveContrato();
			} elseif ($op == 'edit') {
				$this->editContrato();
			} elseif ($op == 'delete') {
				$this->deleteContrato();
			} elseif ($op == 'show') {
				$this->showContrato();
			} else {
				$this->showError("Página não encontrada", "Operação: " . $op . " não encontrada!");
			}
		} catch(Exception $e) {
			$this->showError("Erro:", $e->getMessage());
		}
	}

	public function listContratos()
	{
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
		$contratos = $this->contratosService->getAllContratos($orderby);

		include ROOT_PATH . '/view/contratos.php';
	}

	public function saveContrato()
	{
		$title = 'Criar novo Contrato';

		$codigo 	= '';
		$cliente_id	= '';
		$valor 	 	= '';

		$clientes = $this->clientesService->getAllClientes('nome');

		$errors = array();

		if (isset($_POST['form-submitted'])) {

			$codigo 	= isset($_POST['codigo']) 		? trim($_POST['codigo']) 	  : null;
			$cliente_id = isset($_POST['cliente_id']) 	? trim($_POST['cliente_id'])   : null;
			$valor 	 	= isset($_POST['valor']) 		? trim($_POST['valor'])   : null;

			try {
				$this->contratosService->createNewContrato($codigo, $cliente_id, $valor);
				$this->redirect('index.php');
				return;
			} catch(ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		
		include ROOT_PATH . '/view/contrato-form.php';
	}

	public function editContrato()
	{
		$title  = "Editar Contrato";

		$codigo 	= '';
		$cliente_id	= '';
		$valor 	 	= '';
		$id      	= $_GET['id'];

		$clientes = $this->clientesService->getAllClientes('nome');

		$errors = array();

		$contrato = $this->contratosService->getContrato($id);

		if (isset($_POST['form-submitted'])) {

			$codigo 	= isset($_POST['codigo']) 		? trim($_POST['codigo']) 	  : null;
			$cliente_id = isset($_POST['cliente_id']) 	? trim($_POST['cliente_id'])   : null;
			$valor 	 	= isset($_POST['valor']) 		? trim($_POST['valor'])   : null;
			
			try {
				$this->contratosService->editContrato($codigo, $cliente_id, $valor, $id);
				$this->redirect('index.php');
				return;
			} catch(ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		
		include ROOT_PATH . 'view/contrato-form-edit.php';
	}

	public function deleteContrato()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
			if (!$id) {
				throw new Exception('Internal error');
			}
			$this->contratosService->deleteContrato($id);

			$this->redirect('index.php');
	}

	public function showContrato()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id) {
			throw new Exception('Internal error');
		}
		$contrato = $this->contratosService->getContrato($id);

		include ROOT_PATH . 'view/contrato.php';
	}

	public function showError($title, $message)
	{
		include ROOT_PATH . 'view/error.php';
	}
}

?>
