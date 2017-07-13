<?php

namespace framework\AlgebraicDataTypes;

abstract class Either
{
	protected $value;

	public function __construct($value) {$this->value = $value;}

	public static function left ($value) {return new Left ($value);}
	public static function right($value) {return new Right($value);}

	public abstract function either($leftCallback, $rightCallback);
}


class Left extends Either
{
	public function either($leftCallback, $rightCallback) {return $leftCallback ($this->value);}
}


class Right extends Either
{
	public function either($leftCallback, $rightCallback) {return $rightCallback($this->value);}
}
