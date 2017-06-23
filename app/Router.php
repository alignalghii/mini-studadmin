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
		if (Config::DEBUG) echo '[' . $this->method . ' ' . $this->uri . '] ';
	}

	public function routeOrReport()
	{
		$matched = $this->route();
		if (!$matched) {
			printf("Request `%s %s` does not match any routes\n", $this->method, $this->uri);
		}
	}

	private function route()
	{
		foreach ($this->routes as $sluggedUri => /*list($method, $controller, $action)*/ $package) { // only since PHP 7
			list($method, $controller, $action) = $package;
			$matched = $this->executeIfMatching($method, $sluggedUri, $controller, $action);
			if ($matched) {
				return true;
			}
		}
		return false;
	}

	private function executeIfMatching($method, $sluggedUri, $controller, $action)
	{
		$maybeArgs = $this->match($method, $sluggedUri);
		return $maybeArgs->maybe(
			function () {return false;},
			function ($args) use ($controller, $action)
			{
				call_user_func_array([$controller, $action], $args);
				return true;
			}
		);
	}

	private function match($method, $sluggedUri)
	{
		$methodsMatched = $method == $this->method;
		$urisMatched    = preg_match("!^$sluggedUri$!", $this->uri, $matches);
		if ($methodsMatched && $urisMatched) {
			array_shift($matches);
			return Maybe::just($matches);
		} else {
			return Maybe::nothing();
		}
	}
}
