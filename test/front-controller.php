<?php

/** Test the front controller */

require '../autoload.php';

$requestFixtures = [
	'GI'  => [['GET',  '/'               ], [], []                             ],
	'PI'  => [['POST', '/'               ], [], []                             ],

	'GS'  => [['GET',  '/student'        ], [], []                             ],
	'PS'  => [['POST', '/student'        ], [], []                             ],

	'GS1' => [['GET',  '/student/12'     ], [], []                             ],
	'GS0' => [['GET',  '/student/'       ], [], []                             ],
	'GS_' => [['GET',  '/student/1a2'    ], [], []                             ],
	'PS1' => [['POST', '/student/12'     ], [], ['name' => 'John', 'age' => 23]],
	'PS0' => [['POST', '/student/'       ], [], []                             ],
	'PS_' => [['POST', '/student/1a2'    ], [], []                             ],

	'GN'  => [['GET',  '/nonexisting'    ], [], []                             ], // builtin server passes it to index, even if no router file test
	'GNE' => [['POST', '/nonexisting.php'], [], []                             ], // builtin server tries to serve it as a file
	'IPA' => [['GET',  '/index.php/aaa'  ], [], []                             ], // builtin server tries to serve it as a file
];

foreach ($requestFixtures as $name => $requestFixture) {
	/** PHP-7: `list` can be put directly into `foreach` */
	list($serverFixture, $get, $post) = $requestFixture;
	list($method, $uri) = $serverFixture;
	$server = ['REQUEST_METHOD' => $method, 'REQUEST_URI' => $uri];
	$request = new Request($server, $get, $post);
	echo "=== $method $uri ===\n";
	$router = new Router(Routes::$CONFIG, $request);
	$router->routeOrReport();
	echo "\n";
}
