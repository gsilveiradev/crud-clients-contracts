<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			<?php echo htmlentities($title); ?>
		</title>
	</head>
	<body>
		<h3>Criar novo Cliente</h3>
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
				<input type="text" name="nome" value="<?php echo htmlentities($nome); ?>">
			<br>
			<label for="cpf">CPF: </label><br>
				<input type="text" name="cpf" value="<?php echo htmlentities($cpf); ?>">
			<br>
			<label for="cidade">Cidade: </label><br>
				<input type="text" name="cidade" value="<?php echo htmlentities($cidade); ?>">
			<br>
			<label for="estado">Estado: </label><br>
				<input type="text" name="estado" value="<?php echo htmlentities($estado); ?>">
			<br>
			<label for="telefone">Telefone: </label><br>
				<input type="text" name="telefone" value="<?php echo htmlentities($telefone); ?>">
			<br>
			<label for="data_nascimento">Data de Nascimento: </label><br>
				<input type="text" name="data_nascimento" value="<?php echo htmlentities($data_nascimento); ?>">
			<br>

			<input type="hidden" name="form-submitted" value="1">
			<input type="submit" value="Enviar">
			<button type="button" onclick="location.href='clientes.php'">Cancelar</button>
		</form>
	</body>
</html>