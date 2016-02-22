<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Clientes</title>
		<style type="text/css">
			table.clientes {
				width: 100%;
			}
			table.clientes thead {
				background-color: #eee;
				text-align: left;

			}
			table.clientes thead th {
				border: solid 1px #fff;
				padding: 3px;
			}
			table.clientes tbody td {
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
		<h3>Clientes</h3>
		<div><a href="clientes.php?op=new">Criar novo Cliente</a> | <a href="index.php">Listar Contratos</a> | <a href="index.php?op=new">Criar novo Contrato</a></div><br>
			<table class="clientes" border="0" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><a href="?orderby=id">#</a></th>
						<th><a href="?orderby=nome">Nome</a></th>
						<th><a href="?orderby=cpf">CPF</a></th>
						<th><a href="?orderby=qtd">Qtd. Contratos</a></th>
						<th>&nbsp</th>
						<th>&nbsp</th>
					</tr>
				</thead>
			
				<tbody>
					<?php foreach ($clientes as $cliente) : ?>
						<tr>	
							<td><?php echo htmlentities($cliente->id); ?></td>
							<td><a href="clientes.php?op=show&id=<?php echo $cliente->id; ?>"><?php echo htmlentities($cliente->nome); ?></a></td>
							<td><?php echo htmlentities($cliente->cpf); ?></td>
							<td><?php echo htmlentities($cliente->qtd); ?></td>
							<td><a href="clientes.php?op=edit&id=<?php echo $cliente->id; ?>">editar</a></td>
							<td><a href="clientes.php?op=delete&id=<?php echo $cliente->id; ?>" onclick="return confirm('Você tem certeza que quer deletar esse registro?');">deletar</a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>		
			</table>
	</body>
</html>