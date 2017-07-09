<?php

namespace framework;

class Form
{
	private $metaTable;

	public function __construct($metaTable)
	{
		$this->metaTable = $metaTable;
	}

	public function convert($record)
	{
		$mobileFields = $this->metaTable::$MOBILE_FIELDS;
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
