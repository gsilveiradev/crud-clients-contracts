<?php
require_once 'Database.php';

class ContratosGateway extends Database 
{

	public function selectAll($order)
	{
		if (!isset($order)) {
			$order = 'cc.cliente_id';
		}
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT cc.*, c.nome as cliente_nome FROM contrato cc LEFT JOIN cliente c ON cc.cliente_id = c.id GROUP BY cc.id ORDER BY $order ASC");
		$sql->execute();
		// $result = $sql->fetchAll(PDO::FETCH_ASSOC);

		$contratos = array();
		while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
		
			$contratos[] = $obj;
		}
		return $contratos;
	}

	public function selectById($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM contrato WHERE id = ?");
		$sql->bindValue(1, $id);
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_OBJ);
		
		return $result;
	}

	public function insert($codigo, $cliente_id, $valor)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("INSERT INTO contrato (codigo, cliente_id, valor) VALUES (?, ?, ?)");
		$result = $sql->execute(array($codigo, $cliente_id, $valor));
	}

	public function edit($codigo, $cliente_id, $valor, $id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("UPDATE contrato set codigo = ?, cliente_id = ?, valor = ? WHERE id = ? LIMIT 1");
		$result = $sql->execute(array($codigo, $cliente_id, $valor, $id));
	}

	public function delete($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("DELETE FROM contrato WHERE id = ?");
		$sql->execute(array($id));
	}
}

?>
