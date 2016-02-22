<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			<?php echo htmlentities($title); ?>
		</title>
	</head>
	<body>
		<h3>Editar Cliente</h3>
		<?php
			if ($errors) {
				echo '<ul class="errors">';
				foreach ($errors as $field => $error) {
					echo '<li>' . htmlentities($error) . '</li>';
				}
				echo '</ul>';
			}
		?>
		
		<form method="post" action="">
			<label for="nome">Nome: </label><br>
				<input type="text" name="nome" value="<?php echo htmlentities($cliente->nome); ?>">
			<br>
			<label for="cpf">CPF: </label><br>
				<input type="text" name="cpf" value="<?php echo htmlentities($cliente->cpf); ?>">
			<br>
			<label for="cidade">Cidade: </label><br>
				<input type="text" name="cidade" value="<?php echo htmlentities($cliente->cidade); ?>">
			<br>
			<label for="estado">Estado: </label><br>
				<input type="text" name="estado" value="<?php echo htmlentities($cliente->estado); ?>">
			<br>
			<label for="telefone">Telefone: </label><br>
				<input type="text" name="telefone" value="<?php echo htmlentities($cliente->telefone); ?>">
			<br>
			<label for="data_nascimento">Data de Nascimento: </label><br>
				<input type="text" name="data_nascimento" value="<?php echo htmlentities(date("d/m/Y", strtotime($cliente->data_nascimento))); ?>">
			<br>

			<input type="hidden" name="form-submitted" value="1">
			<input type="submit" value="Editar">
			<button type="button" onclick="location.href='clientes.php'">Cancelar</button>
		</form>
	</body>
</html>