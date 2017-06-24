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

	public function eq($maybeOther)
	{
		return $this->maybe(
			function () use ($maybeOther) {
				return $maybeOther->maybe(
					function () {return true;},                                                 // Nothing == Nothing
					function ($otherValue) {return false;}                                      // Nothing /= Just _
				);
			},
			function ($thisValue) use ($maybeOther) {
				return $maybeOther->maybe(
					function () {return false;},                                                // Just _  /= Nothing
					function ($otherValue) use ($thisValue) {return $thisValue == $otherValue;} // Just x  == Just y    =    x == y
				);
			}
		);
	}

	private function __construct($isJust, $value = null)
	{
		$this->isJust = $isJust;
		$this->value = $value;
	}
}
