<?php
/**
 * Class Router
 * 
 * The Router class handles the registration and dispatching of routes.
 */
class Router
{
	/**
	 * @var array $routes An associative array to store registered routes.
	 * @var array $middleware An array to store middleware classes.
	 */
	private $routes = array();
	private $middleware = array();

	/**
	 * Register a route with the specified method, path, and action.
	 *
	 * @param string $method The HTTP method for the route.
	 * @param string $path The path for the route.
	 * @param callable $action The action to be executed when the route is matched.
	 * @return void
	 */
	public function register($method, $path, $action)
	{
		$this->routes[strtoupper($method)][$path] = $action;
	}

	/**
	 * Dispatches the request to the appropriate action based on the method and URI.
	 *
	 * @param string $method The HTTP method of the request.
	 * @param string $uri The URI of the request.
	 * @return void
	 */
	public function dispatch($method, $uri)
	{
		// $basepath = 'simple-rest-api';
		// $uri = substr($uri, strlen($basepath) + 1); // Remove the basepath from the URI
		$basepath = dirname($_SERVER['SCRIPT_NAME']);
		if (substr($uri, 0, strlen($basepath)) == $basepath)
		{
			$uri = substr($uri, strlen($basepath));
		}

		$method = strtoupper($method);
		if (isset($this->routes[$method][$uri]))
		{
			// Store the result of the action in a variable $data
			$data = call_user_func($this->routes[$method][$uri]);

			// Debugging code
			error_log(print_r($data, true));

			header('Content-Type: application/json'); // Set the response content type to JSON
			// echo json_encode($data);
			echo $data;

			return $data;
		}
		else
		{
			http_response_code(404);
			header('Content-Type: application/json');
			echo json_encode([
				'success' => false,
				'message' => 'Resource not found.'
			]);
		}
	}
}