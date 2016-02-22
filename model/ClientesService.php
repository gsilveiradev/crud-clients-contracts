<?php

require_once 'ClientesGateway.php';
require_once 'ValidationException.php';
require_once 'Database.php';

class ClientesService extends ClientesGateway
{

	private $clientesGateway = null;

	public function __construct()
	{
		$this->clientesGateway = new ClientesGateway();
	}

	public function getAllClientes($order) { 
	    try { 
	        self::connect();
	        $res = $this->clientesGateway->selectAll($order); 
	        self::disconnect();
	        return $res; 
	    } catch (Exception $e) { 
	        self::disconnect();
	        throw $e; 
	    } 
	} 

	public function getCliente($id) 
	{
		try {
			self::connect();
			$result = $this->clientesGateway->selectById($id);
			self::disconnect();
			return $result;
		} catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
		return $this->clientesGateway->selectById($id);
	}

	private function validateClienteParams($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento)
	{
		$errors = array();
		if ( !isset($nome) || empty($nome) ) { 
			    $errors[] = 'Nome é obrigatório'; 
			}
			if ( !isset($cpf) || empty($cpf) ) { 
			    $errors[] = 'CPF é obrigatório'; 
			}
			if ( !isset($cidade) || empty($cidade) ) { 
			    $errors[] = 'Cidade é obrigatório'; 
			}
			if ( !isset($estado) || empty($estado) ) { 
			    $errors[] = 'Estado é obrigatório'; 
			}
			if ( !isset($telefone) || empty($telefone) ) { 
			    $errors[] = 'Telefone é obrigatório'; 
			}
			if ( !isset($data_nascimento) || empty($data_nascimento) ) { 
			    $errors[] = 'Data de Nascimento é obrigatório'; 
			} else {

				if (strlen($data_nascimento) != 10) {
					$errors[] = 'Data de Nascimento está com formato inválido.'; 
				}

				$dt = DateTime::createFromFormat("d/m/Y", $data_nascimento);

				if ($dt === false || array_sum($dt->getLastErrors())) {
					$errors[] = 'Data de Nascimento está com formato inválido.'; 
				}
			}
		if (empty($errors)) {
			return;
		}
		throw new ValidationException($errors);
	}

	public function createNewCliente($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento)
	{
		try {
			self::connect();
			$this->validateClienteParams($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento);
			
			if ($data_nascimento) {

				list($d, $m, $Y) = explode('/', $data_nascimento);
				$data_nascimento = date("$Y-$m-$d 00:00:00");
			}

			$result = $this->clientesGateway->insert($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento);
			self::disconnect();
			return $result;
		} catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}

	public function editCliente($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento, $id)
	{
		try {
			self::connect();
			$this->validateClienteParams($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento);

			if ($data_nascimento) {

				list($d, $m, $Y) = explode('/', $data_nascimento);
				$data_nascimento = date("$Y-$m-$d 00:00:00");
			}

			$result = $this->clientesGateway->edit($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento, $id);
			self::disconnect();
		}catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}

	public function deleteCliente($id)
	{
		try {
			self::connect();
			$result = $this->clientesGateway->delete($id);
			self::disconnect();
		} catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}
}

?>
