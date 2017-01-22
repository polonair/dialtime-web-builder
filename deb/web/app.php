<?php

use Symfony\Component\HttpFoundation\Request;

umask(0002);

$loader = require '/usr/share/dialtime/api/app/autoload.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
