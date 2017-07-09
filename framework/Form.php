<?php

namespace framework;

class Form
{
	private $metaTableName;

	public function __construct($metaTableName)
	{
		$this->metaTableName = $metaTableName;
	}

	public function convert($record)
	{
		// $this->metaTableName::$MOBILE_FIELDS; // valid in PHP 7, but not in older PHP version. The following two lines are more portable:
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
}
