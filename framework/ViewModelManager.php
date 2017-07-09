<?php

namespace framework;

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
			function ($record) {return Util::array_map_access_keys($this->attrValRepresentFunction, $record);},
			$records
		);
	}
}
