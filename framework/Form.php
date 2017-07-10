<?php

namespace framework;

use framework\AlgebraicDataTypes\Maybe;

class Form
{
	const class54 = __CLASS__;

	private $metaTableName;

	public function __construct($metaTableName)
	{
		$this->metaTableName = $metaTableName;
	}

	public function convert($record)
	{
		// $mobileFields = $this->metaTableName::$MOBILE_FIELDS;
		// Thle line above is valid in PHP 7, but not in older PHP versions. The following two lines are more portable:
		$metaTableName = $this->metaTableName;
		$mobileFields = $metaTableName::$MOBILE_FIELDS;
		return Util::array_mapMaybe_access_keys(
			function ($attr, $val) use ($mobileFields, $record) {
				return $mobileFields[$attr] == \PDO::PARAM_BOOL
				     ? Maybe::just(array_key_exists($attr, $record))
				     : (
				            array_key_exists($attr, $record) ? Maybe::just($record[$attr])
				                                             : Maybe::nothing()
				       );
			},
			$mobileFields
		);
	}

	public function createBlank()
	{
		// $mobileFields = $this->metaTableName::$MOBILE_FIELDS;
		// Thle line above is valid in PHP 7, but not in older PHP versions. The following two lines are more portable:
		$metaTableName = $this->metaTableName;
		$mobileFields = $metaTableName::$MOBILE_FIELDS;

		return array_map([self::class54, 'typeDefaults'], $mobileFields);
	}

	private static function typeDefaults($pdoType)
	{
		switch ($pdoType) {
			case \PDO::PARAM_INT:  return 0;
			case \PDO::PARAM_BOOL: return false;
			default:               return "";
		}
	}
}
