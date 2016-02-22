<?php

require_once 'model/Autoloader.php';
require_once 'controller/ClientesController.php';

$controller = new ClientesController();

$controller->handleRequest();

?>
