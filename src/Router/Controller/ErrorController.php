<?php
namespace Future\App\Router\Controller;

use Throwable;

class ErrorController extends ErrorControllerInterface {

	public function handle(Throwable $exception): void {}

}