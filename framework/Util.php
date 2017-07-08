<?php

namespace framework;

class Util
{
	const class54 = __CLASS__;

	public static function eq($a, $b) {return $a == $b;}

	public static function array_map_access_keys($f, $a)
	{
		$results = [];
		foreach ($a as $key => $val) {
			$results[$key] = $f($key, $val);
		}
		return $results;
	}
}
