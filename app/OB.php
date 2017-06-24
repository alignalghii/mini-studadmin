<?php

class OB
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

}
