<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $cliente->nome; ?></title>
    </head>
    <body>
        <h1><?php echo $cliente->nome; ?></h1>
        <div>
            <span class="label">Nome:</span>
            <?php echo $cliente->nome; ?>
        </div>
        <div>
            <span class="label">CPF:</span>
            <?php echo $cliente->cpf; ?>
        </div>
        <div>
            <span class="label">Cidade:</span>
            <?php echo $cliente->cidade; ?>
        </div>
        <div>
            <span class="label">Estado:</span>
            <?php echo $cliente->estado; ?>
        </div>
        <div>
            <span class="label">Telefone:</span>
            <?php echo $cliente->telefone; ?>
        </div>
        <div>
            <span class="label">Data de Nascimento:</span>
            <?php echo $cliente->data_nascimento; ?>
        </div>
    </body>
</html>