<?php
namespace Future\App\Router\Controller;

use Throwable;

abstract class ErrorControllerInterface extends AbstractController {

	abstract public function handle(Throwable $exception): void;

}