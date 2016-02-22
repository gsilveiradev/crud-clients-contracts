<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Contratos</title>
		<style type="text/css">
			table.contratos {
				width: 100%;
			}
			table.contratos thead {
				background-color: #eee;
				text-align: left;

			}
			table.contratos thead th {
				border: solid 1px #fff;
				padding: 3px;
			}
			table.contratos tbody td {
				border: solid 1px #eee;
				padding: 3px;
			}
			a, a:hover, a:active, a:visited {
				color: blue;
				text-decoration: underline;
			}
		</style>
	</head>
	<body>
		<h3>Contratos</h3>
		<div><a href="index.php?op=new">Criar novo Contrato</a> | <a href="clientes.php">Listar Clientes</a> | <a href="clientes.php?op=new">Criar novo Cliente</a></div><br>
			<table class="contratos" border="0" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><a href="?orderby=codigo">Código</a></th>
						<th><a href="?orderby=cliente_nome">Cliente</a></th>
						<th><a href="?orderby=valor">Valor</a></th>
						<th>&nbsp</th>
						<th>&nbsp</th>
					</tr>
				</thead>
			
				<tbody>
					<?php foreach ($contratos as $contrato) : ?>
						<tr>	
							<td><a href="index.php?op=show&id=<?php echo $contrato->id; ?>"><?php echo htmlentities($contrato->codigo); ?></a></td>
							<td><?php echo htmlentities($contrato->cliente_nome); ?></td>
							<td><?php echo htmlentities($contrato->valor); ?></td>
							<td><a href="index.php?op=edit&id=<?php echo $contrato->id; ?>">editar</a></td>
							<td><a href="index.php?op=delete&id=<?php echo $contrato->id; ?>" onclick="return confirm('Você tem certeza que quer deletar esse registro?');">deletar</a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>		
			</table>
	</body>
</html>