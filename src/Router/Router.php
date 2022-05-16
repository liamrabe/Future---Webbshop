<?php
/**
 * Liam's Router
 *
 * @version 1.0.0
 */
namespace Future\App\Router;

use Future\App\Router\Controller\ErrorControllerInterface;
use Future\App\Router\Exception\HttpException;
use InvalidArgumentException;
use PDO;
use RuntimeException;

class Router {

	public const METHOD_DELETE = 'DELETE';
	public const METHOD_PATCH = 'PATCH';
	public const METHOD_HEAD = 'HEAD';
	public const METHOD_POST = 'POST';
	public const METHOD_GET = 'GET';
	public const METHOD_PUT = 'PUT';

	public const METHODS = [
		self::METHOD_DELETE,
		self::METHOD_PATCH,
		self::METHOD_HEAD,
		self::METHOD_POST,
		self::METHOD_GET,
		self::METHOD_PUT,
	];

	protected static ErrorControllerInterface $error_controller;
	/** @var Route[] */
	protected static array $routes = [];

	public static function setErrorHandler(ErrorControllerInterface $error_controller): void {
		self::$error_controller = $error_controller;
	}

	/** @throws RuntimeException|InvalidArgumentException */
	public static function route(string $method, string $route, array $callback): Route {
		return self::$routes[] = Route::create($method, $route, $callback);
	}

	/** @throws HttpException */
	public static function run(): void {
		/* Filter out routes that doesn't match current request method */
		$routes = array_filter(self::$routes, static function(Route $route) {
			return $route->getMethod() === $_SERVER['REQUEST_METHOD'];
		});
		$uri = $_SERVER['REQUEST_URI'];

		$matches = [];
		foreach ($routes as $route) {
			$pattern = sprintf('/%s/', str_replace("/", "\/", $route->getUri()));
			$found_matches = preg_match_all($pattern, $uri, $_matches, PREG_OFFSET_CAPTURE);

			if ($found_matches === 0) {
				throw new HTTPException(__("No routes matching '%s' found", $uri), 404);
			}

			foreach ($_matches as $match_group) {
				foreach ($match_group as $match) {
					if ($match[0] === $uri) {
						$arg_count = count($_matches);
						$r_pattern = ext_str_repeat('$#', $arg_count, ',');
						$args_string = preg_replace($pattern, $r_pattern, $uri);
						$args = explode(',', $args_string);

						$route->setArguments($args);
						$matches[] = $route;
					}
				}
			}
		}

		/* Get the last match */
		$route = $matches[count($matches) - 1] ?? [];

		if (!$route instanceof Route) {
			throw new HTTPException(__("No routes matching '%s' found", $uri), 404);
		}

		call_user_func_array(
			$route->getCallback(),
			$route->getArguments(),
		);
	}

}