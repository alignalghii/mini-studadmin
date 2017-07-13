<?php

namespace framework;

class Meta
{
	/** There is no way:
	 * @see https://stackoverflow.com/questions/2251386/can-we-implement-a-php-extract-function-in-php-with-out-using-zend-api
	 */

	/**
	 * Pseudoimplementations:
	 * They do not work, due to lack of {{{OUTER}}} keyword, `global` does not work!
	 *
	 * public static function safeExtract($allowedNames, $valuesForNames)
	 * {
	 *	foreach ($valuesForNames as $variableName => $value) {
	 *		if (in_array($variableName, $allowedNames)) {
	 *			{{{OUTER}}} $$variableName;
	 *			$$variableName = $value;
	 *		}
	 *	}
	 */

	/**
	 * Another one, but it cannot be grasped in a function either:
	 * @see http://php.net/manual/de/function.extract.php#59152
	 *
	 * public static function safeExtract($allowedNames, $valuesForNames)
	 * {
	 * 	$allowedNames_asKeys    = array_flip($allowedNames);
	 * 	$valuesForNames_allowed = array_intersect_key($valuesForNames, $allowedNames_asKeys);
	 * 	extract($valuesForNames_allowed);
	 * }



	/** @todo */
	// public static function assocList(...)
}
