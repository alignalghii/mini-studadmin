<?php

class Router
{
	private $routes;
	private $method, $uri;

	public function __construct($routes, $superglobal)
	{
		$this->routes = $routes;
		$this->method = $superglobal['REQUEST_METHOD'];
		$this->uri    = $superglobal['REQUEST_URI'];
	}

	public function routeOrReport()
	{
		$status = $this->route();
		if (!$status) {
			printf("Request `%s %s` does not match any routes\n", $this->method, $this->uri);
		}
	}

	private function route()
	{
		foreach ($this->routes as $uri => /*list($method, $controller, $action)*/ $package) { // only since PHP 7
			list($method, $controller, $action) = $package;
			$thatIsIt = $this->match($method, $uri, $controller, $action);
			if ($thatIsIt) {
				return true;
			}
		}
		return false;
	}

	private function match($method, $uri, $controller, $action)
	{
		$ok = [$method, $uri] === [$this->method, $this->uri];
		if ($ok) {
			$controller::$action();
		}
		return $ok;
	}
}
