<?php
use Future\App\Router\Controller\ErrorController;
use Future\App\Router\Controller\ViewController;
use Future\App\Router\Router;

$error_handler = new ErrorController();

try {
	Router::setErrorHandler($error_handler);

	Router::route('GET', '/([a-zA-Z0-9_-]+)', [ViewController::class, 'handle']);
	Router::route('DELETE', '/test', [ViewController::class, 'handle']);

	Router::run();
} catch (Exception $ex) {
	echo $ex->getMessage();
	exit;
}
