<?php

namespace framework;

use framework\AlgebraicDataTypes\Maybe;

class IO
{
	public static function outputOf($callback)
	{
		ob_start();
			$callback();
		return ob_get_clean();
	}

	public static function outputOf1($callback, $arg)
	{
		ob_start();
			$callback($arg);
		return ob_get_clean();
	}

	public static function obtain($directTextOrFileName)
	{
		if (file_exists($directTextOrFileName)) {
			$fileContent = file_get_contents($directTextOrFileName);
			return Maybe::just($fileContent);
		} else {
			return Maybe::nothing();
		}
	}
}
