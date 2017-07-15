<?php

namespace framework\AlgebraicDataTypes;

abstract class Either2Or1
{
	public static function left2 ($value1, $value2) {return new Left2 ($value1, $value2);}
	public static function right1($value)           {return new Right1($value);}

	public abstract function either2Or1($leftCallbackN2, $rightCallbackWithN1);
}


class Left2 extends Either2Or1
{
	private $value1, $value2;

	public function __construct($value1, $value2)
	{
		$this->value1 = $value1;
		$this->value2 = $value2;
	}

	public function either2Or1($leftCallbackN2, $rightCallbackN1)
	{
		return $leftCallbackN2($this->value1, $this->value2);
	}
}


class Right1 extends Either2Or1
{
	private $value;

	public function __construct($value) {$this->value = $value;}

	public function either2Or1($leftCallbackN2, $rightCallbackN1)
	{
		return $rightCallbackN1($this->value);
	}
}
