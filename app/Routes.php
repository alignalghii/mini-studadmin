<?php

use Controller\HomeController;
use Controller\StudentController;

class Routes
{
	/** PHP 7: const CONFIG = [...] */
	public static $CONFIG = [
		'/'        => ['GET', HomeController::class54,    'index'],
		'/student' => ['GET', StudentController::class54, 'index'],
	];
}
