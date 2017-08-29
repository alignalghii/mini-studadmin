<?php

namespace app\Controller;

use framework\Controller;
use framework\Utility\ArrayExt;

class HomeController extends Controller
{
	/** `::class54`: no need for it since PHP 5.5, use `::class` instead */
	const class54 = __CLASS__;

	/** PHP-7: const DOC = [...] */
	static $DOC = [
		'sample-webapp'    => 'A sample web application',
		'custom-framework' => 'A custom web framework',
		'selfdoc'          => 'A self-documenting content structure',
	];

	public function index()
	{
		$title = 'Home';
		$viewModel = compact('title');
		$this->render('Home/index', $viewModel);
	}

	public function doc($pageName)
	{
		$maybeTitle = ArrayExt::safeAssoc(self::$DOC, $pageName);
		$maybeTitle->maybe(
			function () {echo 'No such documentation subpage exists';}, // failure: Nothing
			function ($title) use ($pageName) {                         // success: Just title
				$viewModel = compact('pageName', 'title');
				$this->render("Home/$pageName", $viewModel);
			}
		);
	}
}
