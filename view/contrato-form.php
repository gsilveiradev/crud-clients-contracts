<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			<?php echo htmlentities($title); ?>
		</title>
	</head>
	<body>
		<h3>Criar novo Contrato</h3>
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
				<label for="codigo">Código: </label><br>
				<input type="text" name="codigo" value="<?php echo htmlentities($codigo); ?>">
			<br>
			<label for="cliente_id">Cliente: </label><br>
				<select name="cliente_id">
					<?php foreach ($clientes as $cliente ) : ?>
					<option value="<?php echo $cliente->id ?>"><?php echo $cliente->nome ?></option>
					<?php endforeach ?>
				</select>
			<br>
			<label for="valor">Valor: </label><br>
				<input type="text" name="valor" value="<?php echo htmlentities($valor); ?>">
			<br>

			<input type="hidden" name="form-submitted" value="1">
			<input type="submit" value="Enviar">
			<button type="button" onclick="location.href='index.php'">Cancelar</button>
		</form>
	</body>
</html>