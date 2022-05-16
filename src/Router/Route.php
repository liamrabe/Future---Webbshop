<?php
namespace Future\App\Router;

use InvalidArgumentException;
use RuntimeException;

class Route {

	protected array $arguments = [];
	protected array $callback;
	protected string $method;
	protected string $route;

	protected function __construct(string $method = '', string $route = '', array $callback = []) {
		$this->callback = $callback;
		$this->method = $method;
		$this->route = $route;
	}

	public function setArguments(array $arguments): void {
		$this->arguments = $arguments;
	}

	public function getArguments(): array {
		return $this->arguments ?? [];
	}

	public function getUri(bool $escape = false): string {
		return $this->route ?? '';
	}

	public function getMethod(): string {
		return strtoupper($this->method ?? '');
	}

	public function getCallback(): array {
		return $this->callback ?? [];
	}

	/* Static methods */

	/** @throws RuntimeException|InvalidArgumentException */
	public static function create(string $request_method = '', string $route = '', array $callback = []): Route {
		if (empty($request_method) && empty($route) && empty($callback)) {
			return new self();
		}

		/* Check if method is supported by the router */
		if (!in_array($request_method, Router::METHODS)) {
			throw new RuntimeException(sprintf("Method '%s' is not supported", strtoupper($request_method)));
		}

		/* Check if callback-array only contains 2 elements */
		if (is_multidimensional($callback) || !array_count($callback, 2)) {
			throw new RuntimeException(sprintf('Callback expected 2 arguments, got %d', count($callback)));
		}

		/* Destruct array for easier readability */
		[$class, $method] = $callback;

		/* Check if class-method exists */
		if (!method_exists($class, $method)) {
			throw new InvalidArgumentException(__("Class method '%s' is not defined in class '%s'", $method, $class));
		}

		return new self($request_method, $route, $callback);
	}

}