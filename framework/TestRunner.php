<?php

namespace framework;

use app\Routes; /** @todo: dependency injection */

class TestRunner
{
	private $testCases;
	private $noMatch_regexp;

	public function __construct($testCases, $noMatch_regexp)
	{
		$this->testCases     = $testCases;
		$this->noMatch_regexp = $noMatch_regexp;
	}

	public function run()
	{
		$allStatus = true;
		foreach ($this->testCases as $name => $testCase) {
			extract($testCase); // $fixture, $expectation
			$expectation = $expectation->map(
				function ($textReference) {
					list($isDirectText, $txtOrFile) = $textReference;
					return $isDirectText ? $txtOrFile                     // as direct text
					                     : file_get_contents($txtOrFile); // as contents of provided filename
				}
			);
			list($serverFixture, $get, $post) = $fixture;
			list($method, $uri) = $serverFixture;
			$server = ['REQUEST_METHOD' => $method, 'REQUEST_URI' => $uri];
			$request = new Request($server, $get, $post);
			echo "=== $method $uri ===\n";
			$router = new Router(Routes::$CONFIG, $request);
			$rawActual = IO::outputOf([$router, 'routeOrReport']);
			$actual = preg_match($this->noMatch_regexp, $rawActual)
					     ? Maybe::nothing()
					     : Maybe::just($rawActual);
			echo "A $rawActual";
			echo 'E ' . $expectation->maybe(function () {return "---\n";}, function ($rawExp) {return $rawExp;});
			$status = $expectation->eq($actual);
			$allStatus = $allStatus && $status;
			echo $status ? 'OK'
			             : 'Wrong';
			echo "\n";
		}
		echo "All-status: " . ($allStatus ? 'OK' : "Wrong") . "\n";
	}

	/*private static function noMatch($method, $uri)
	{
		return sprintf(static::NO_MATCH, $method, $uri);
	}*/

}
