<?php

/** Test the front controller */

require '../autoload.php';

$tests = [
	'serverStubGI'  => ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/'               ],
	'serverStubPI'  => ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/'               ],
	'serverStubGS'  => ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/student'        ],
	'serverSrubGS1' => ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/student/12'     ],
	'serverSrubGS0' => ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/student/'       ],
	'serverSrubGS_' => ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/student/1a2'    ],
	'serverStubPS'  => ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/student'        ],
	'serverStubGN'  => ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/nonexisting'    ], // builtin server passes it to index, even if no router file test
	'serverStubGNE' => ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/nonexisting.php'], // builtin server tries to serve it as a file
	'serverStubIPA' => ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/index.php/aaa'  ], // builtin server tries to serve it as a file
];

foreach ($tests as $serverName => $serverFixture) {
	printf("=== %s %s ===\n", $serverFixture['REQUEST_METHOD'], $serverFixture['REQUEST_URI']);
	$router = new Router(Routes::$CONFIG, $serverFixture);
	$router->routeOrReport();
	echo "\n";
}
