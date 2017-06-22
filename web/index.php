<?php
/** The front controller */

require '../autoload.php';

$serverStub1 = ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/'               ];
$serverStub2 = ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/'               ];
$serverStub3 = ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/student'        ];
$serverStub4 = ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/student'        ];
$serverStub3 = ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/nonexisting'    ]; // builtin server passes it to index, even if no router file 
$serverStub4 = ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/nonexisting.php']; // builtin server tries to serve it as a file
$serverStub5 = ['REQUEST_METHOD' => 'GET',  'REQUEST_URI' => '/index.php/aaa'  ]; // builtin server tries to serve it as a file

$router = new Router(Routes::$CONFIG, $_SERVER); // PHP7: Routes::CONFIG
$router->routeOrReport();
