<?php

namespace Imie;

include('..\autoloader.php');
include('cfg\config.php');

$router = new Router();
$router->dispatch();