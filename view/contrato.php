<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contrato: <?php echo $contrato->codigo; ?></title>
    </head>
    <body>
        <h1>Contrato: <?php echo $contrato->codigo; ?></h1>
        <div>
            <span class="label">Código:</span>
            <?php echo $contrato->codigo; ?>
        </div>
        <div>
            <span class="label">Cliente:</span>
            <?php echo $contrato->cliente_id; ?>
        </div>
        <div>
            <span class="label">Valor:</span>
            <?php echo $contrato->valor; ?>
        </div>
    </body>
</html>