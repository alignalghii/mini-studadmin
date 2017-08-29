<?php

namespace framework\Utility;

use framework\AlgebraicDataTypes\Maybe;

class ArrayExt
{
	public static function safeAssoc($arr, $key)
	{
		return array_key_exists($key, $arr)
		     ? Maybe::just($arr[$key])
		     : Maybe::nothing();
	}
}
