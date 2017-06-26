<?php

/** Implement Haskell's `Maybe` algebraic datatype via abstract class inheritance and case classes */

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

	/** To be defined in the so-called ``case classes' Just and Nothing */
	abstract public function maybe($nothingCallback, $justCallback);

	public function map($f)
	{
		return $this->maybe(
			function ()                {return static::nothing();},
			function ($value) use ($f) {return static::just($f($value));}
		);
	}

	public function defaulting($defaultValue)
	{
		return $this->maybe(
			function () use ($defaultValue) {return $defaultValue;}, // constant combinator K
			function ($value)               {return $value;}         // identity combinator I
		);
	}

	/** Rewrite with map (map ...) and currying */
	public function map2($maybeOther, $f)
	{
		return $this->maybe(
			function ()                         {return Maybe::nothing();},
			function ($value) use ($maybeOther) {
				return $maybeOther->map(
					function ()                         {return Maybe::nothing();},
					function ($otherValue) use ($value) {return $f($value, $otherValue);}
				);
			}
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

/** The two case classes: */

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
