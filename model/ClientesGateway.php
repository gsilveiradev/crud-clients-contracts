<?php
require_once 'Database.php';

class ClientesGateway extends Database 
{

	public function selectAll($order)
	{
		if (!isset($order)) {
			$order = 'c.id';
		}
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT c.*, count(cc.id) as qtd FROM cliente c LEFT JOIN contrato cc ON c.id = cc.cliente_id GROUP BY c.id ORDER BY $order ASC");
		$sql->execute();
		// $result = $sql->fetchAll(PDO::FETCH_ASSOC);

		$clientes = array();
		while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
		
			$clientes[] = $obj;
		}
		return $clientes;
	}

	public function selectById($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM cliente WHERE id = ?");
		$sql->bindValue(1, $id);
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_OBJ);
		
		return $result;
	}

	public function insert($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("INSERT INTO cliente (nome, cpf, cidade, estado, telefone, data_nascimento) VALUES (?, ?, ?, ?, ?, ?)");
		$result = $sql->execute(array($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento));
	}

	public function edit($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento, $id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("UPDATE cliente set nome = ?, cpf = ?, cidade = ?, estado = ?, telefone = ?, data_nascimento = ? WHERE id = ? LIMIT 1");
		$result = $sql->execute(array($nome, $cpf, $cidade, $estado, $telefone, $data_nascimento, $id));
	}

	public function delete($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("DELETE FROM cliente WHERE id = ?");
		$sql->execute(array($id));
	}
}

?>
