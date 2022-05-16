<?php
namespace Future\App\Router\Controller;

class ViewController extends AbstractController {

	public static function handle(string $name): void {
		echo sprintf('Current page: %s', $name);
	}

}
