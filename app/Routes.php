<?php

use Controller\HomeController;

class Routes
{
	/** PHP 7: const CONFIG = [...] */
	public static $CONFIG = [
		'/' => ['GET', HomeController::class54, 'index'],
	];
}
