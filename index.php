<?php

require_once 'model/Autoloader.php';
require_once 'controller/HomeController.php';

$controller = new HomeController();

$controller->handleRequest();

?>
