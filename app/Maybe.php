<?php

class Maybe
{
	private $isJust;
	private $value;

	public static function just($value)
	{
		return new Maybe(true, $value);
	}

	public static function nothing()
	{
		return new Maybe(false);
	}

	public function maybe($nothingCallback, $justCallback)
	{
		return $this->isJust ? $justCallback($this->value)
		                     : $nothingCallback();
	}

	private function __construct($isJust, $value = null)
	{
		$this->isJust = $isJust;
		$this->value = $value;
	}
}
