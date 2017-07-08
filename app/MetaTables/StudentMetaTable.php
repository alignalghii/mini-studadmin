<?php

namespace app\MetaTables;

class StudentMetaTable
{
	const class54 = __CLASS__;

	const NAME = 'student';

	public static $MOBILE_FIELDS = [
		'name'           => \PDO::PARAM_STR,    'is_male'       => \PDO::PARAM_BOOL,
		'place_of_birth' => \PDO::PARAM_STR,    'date_of_birth' => \PDO::PARAM_STR,
		'email'          => \PDO::PARAM_STR
	];

	public static function convert($record)
	{
		$convertedRecord = [];
		foreach ($record as $attr => $val) {
			$convertedRecord[$attr] = array_key_exists($attr, static::$MOBILE_FIELDS) && static::$MOBILE_FIELDS[$attr] == \PDO::PARAM_BOOL
			                        ? (bool) $val
			                        :        $val;
		}
		return $convertedRecord;
	}
}
