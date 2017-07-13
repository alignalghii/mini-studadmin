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

	public static function catMaybes_access_keys($a)
	{
		$results = [];
		foreach ($a as $key => $maybeVal) {
			$maybeVal->maybe(
				function () {},
				function ($val) use ($key, &$results) {$results[$key] = $val;},
				$maybeVal
			);
		}
		return $results;
	}

	public static function array_mapMaybe_access_keys($f, $a)
	{
		$results = [];
		foreach ($a as $key => $val) {
			$maybeRes = $f($key, $val);
			$maybeRes->maybe(
				function () {},
				function ($res) use ($key, &$results) {$results[$key] = $res;}
			);
		}
		return $results;
	}

}
