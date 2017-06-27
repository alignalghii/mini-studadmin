<?php

namespace framework;

use app\Config; // @thodo: dependency injection

class Router
{
	private $routes;
	private $request;
	/** Cached properties from $request: */
	private $method, $uri;

	public function __construct($routes, $request)
	{
		$this->routes  = $routes;
		$this->request = $request;
		/** Cache: */
		$this->method  = $request->method();
		$this->uri     = $request->uri();
		/** Debug: */
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
		foreach ($this->routes as $sluggedUri => $uriFunctionalities) {
			foreach ($uriFunctionalities as $method => $controllerAction) {
				$matched = $this->executeIfMatching($method, $sluggedUri, $controllerAction);
				if ($matched) {
					return true;
				}
			}
		}
		return false;
	}

	private function executeIfMatching($method, $sluggedUri, $controllerAction)
	{
		$maybeArgs = $this->match($method, $sluggedUri);
		return $maybeArgs->maybe(
			function () {return false;},
			function ($args) use ($controllerAction)
			{
				list($controllerClass, $action) = $controllerAction;
				$controller = new $controllerClass($this->request);
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
