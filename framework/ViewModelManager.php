<?php

namespace framework;

use framework\Utility\MaybeExt;

class ViewModelManager
{
	private $attrValRepresentFunction;

	public function __construct($attrValRepresentFunction)
	{
		$this->attrValRepresentFunction = $attrValRepresentFunction;
	}

	public function representRecordSet($records)
	{
		return array_map(
			function ($record) {return MaybeExt::array_map_access_keys($this->attrValRepresentFunction, $record);},
			$records
		);
	}
}
