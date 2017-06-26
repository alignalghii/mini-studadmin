<?php

abstract class Maybe
{
	public static function just($value)
	{
		return new Just($value);
	}

	public static function nothing()
	{
		return new Nothing();
	}

	abstract public function maybe($nothingCallback, $justCallback);

	public function map($f)
	{
		return $this->maybe(
			function ()                {return static::nothing();},
			function ($value) use ($f) {return static::just($f($value));}
		);
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
}

class Just extends Maybe
{
	private $value;

	public function __construct($value) {$this->value = $value;}

	public function maybe($nothingCallback, $justCallback)
	{
		return $justCallback($this->value);
	}
}

class Nothing extends Maybe
{
	public function __construct() {}

	public function maybe($nothingCallback, $justCallback)
	{
		return $nothingCallback();
	}
}
