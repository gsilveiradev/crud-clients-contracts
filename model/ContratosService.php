<?php

require_once 'ContratosGateway.php';
require_once 'ValidationException.php';
require_once 'Database.php';

class ContratosService extends ContratosGateway
{

	private $contratosGateway = null;

	public function __construct()
	{
		$this->contratosGateway = new ContratosGateway();
	}

	public function getAllContratos($order) { 
	    try { 
	        self::connect();
	        $res = $this->contratosGateway->selectAll($order); 
	        self::disconnect();
	        return $res; 
	    } catch (Exception $e) { 
	        self::disconnect();
	        throw $e; 
	    } 
	} 

	public function getContrato($id) 
	{
		try {
			self::connect();
			$result = $this->contratosGateway->selectById($id);
			self::disconnect();
			return $result;
		} catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
		return $this->contratosGateway->selectById($id);
	}

	private function validateContratoParams($codigo, $cliente_id, $valor)
	{
		$errors = array();
		if ( !isset($codigo) || empty($codigo) ) { 
			    $errors[] = 'Código é obrigatório'; 
			}
			if ( !isset($cliente_id) || empty($cliente_id) ) { 
			    $errors[] = 'Cliente ID é obrigatório'; 
			}
			if ( !isset($valor) || empty($valor) ) { 
			    $errors[] = 'Valor é obrigatório'; 
			}
		if (empty($errors)) {
			return;
		}
		throw new ValidationException($errors);
	}

	public function createNewContrato($codigo, $cliente_id, $valor)
	{
		try {
			self::connect();
			$this->validateContratoParams($codigo, $cliente_id, $valor);
			$result = $this->contratosGateway->insert($codigo, $cliente_id, $valor);
			self::disconnect();
			return $result;
		} catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}

	public function editContrato($codigo, $cliente_id, $valor, $id)
	{
		try {
			self::connect();
			$result = $this->contratosGateway->edit($codigo, $cliente_id, $valor, $id);
			self::disconnect();
		}catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}

	public function deleteContrato($id)
	{
		try {
			self::connect();
			$result = $this->contratosGateway->delete($id);
			self::disconnect();
		} catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}
}

?>
