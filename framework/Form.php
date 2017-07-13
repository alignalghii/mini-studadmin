<?php

namespace framework;

use framework\ORM\Repository;
use framework\AlgebraicDataTypes\Either;

class Form
{
	const class54 = __CLASS__;

	private $metaTableName;

	public function __construct($metaTableName)
	{
		$this->metaTableName = $metaTableName;
	}

	public function convertAndValidate($post, $isUpdateMode)
	{
		$entity = $this->convertRequest($post, $isUpdateMode);
		if (!$isUpdateMode) {
			$this->checkCreationFormConsistency($entity);
		}
		return $this->validate($entity);
	}

	public function convertRequest($post, $isUpdateMode)
	{
		// $mobileFields = $this->metaTableName::$MOBILE_FIELDS;
		// Thle line above is valid in PHP 7, but not in older PHP versions. The following two lines are more portable:
		$metaTableName = $this->metaTableName;
		$fields  = ['id' => [\PDO::PARAM_INT, false, null]] + $metaTableName::$MOBILE_FIELDS;

		$convertedRecord = [];
		foreach ($fields as $fieldName => $fieldMetaData) {
			list($type, $nullable, $defaultIfAny) = $fieldMetaData;
			$presence = array_key_exists($fieldName, $post);
			if ($type == \PDO::PARAM_BOOL) {
				$convertedRecord[$fieldName] = array_key_exists($fieldName, $post);
			} elseif ($presence) {
				$value = $post[$fieldName];
				switch ($type) {
					case \PDO::PARAM_STR:
						$trimmed = trim($value);
						if (empty($trimmed)) {
							if (!$nullable) {
								$convertedRecord[$fieldName] = "";
							} elseif ($isUpdateMode) {
								$convertedRecord[$fieldName] = null;
							}
						} else {
							$convertedRecord[$fieldName] = $value;
						}
						break;
					default: // \PDO::PARAM_BOOL is impossible to occur
						$convertedRecord[$fieldName] = $value;
				}
			}
		}
		return $convertedRecord;
	}


	private function checkCreationFormConsistency($entity)
	{
		// $mobileFields = $this->metaTableName::$MOBILE_FIELDS;
		// Thle line above is valid in PHP 7, but not in older PHP versions. The following two lines are more portable:
		$metaTableName = $this->metaTableName;
		$mobileFields  = $metaTableName::$MOBILE_FIELDS;

		foreach ($mobileFields as $fieldName => $fieldMetaData) {
			list($type, $nullable, $defaultIfAny) = $fieldMetaData;
			$specialCase = !array_key_exists($fieldName, $entity) && !$nullable && !isset($defaultIfAny);
			if ($specialCase) {
				throw new Exception('Wrong form: some mandatory fields are missing');
			}
		}
	}

	public function validate($entity)
	{
		$errorModel = [];
		foreach ($entity as $fieldName => $value) {
			switch ($fieldName) {
				case 'name':
					if (!$value) $errorModel[$fieldName] = 'Cannot be blank';
					break;
				case 'date_of_birth':
					try {
						if ($value != null) {
							$date = new \DateTime($value);
							$entity[$fieldName] = $date->format('Y-m-d');
						}
					} catch(\Exception $e) {
						$errorModel[$fieldName] = 'Invalid date format';
					}
					break;
				case 'email':
					if (!$value) {
						$errorModel[$fieldName] = 'Cannot be blank';
					} elseif (!preg_match('/^\w+@(\w+\.)*\w+/', $value)) {
						$errorModel[$fieldName] = 'Invalid email format';
					} elseif ($n = $this->isNotUniqueWith($fieldName, $value, $entity)) {
						$errorModel[$fieldName] = "Multiple ($n) identical `$value`-occurrence(s) of the unique field `$fieldName`";
					}
					break;
			}
		}
		return empty($errorModel)
		     ? Either::right($entity)                // valid entity
		     : Either::left([$entity, $errorModel]); // invalid entity
	}

	private function isNotUniqueWith($fieldName, $value, $entity)
	{
		$repository = new Repository($this->metaTableName);
		$entities = $repository->findAll();
		$otherEntities = array_key_exists('id', $entity)
		          ? array_filter(
		                 $entities,
		                 function ($each) use ($entity) {return $each['id'] != $entity['id'];}
		            )
		          : $entities;
		$redundants = array_filter(
			$otherEntities,
			function ($each) use ($fieldName, $value) {return $each[$fieldName] == $value;}
		);
		return count($redundants);
	}

	public function entityViewModel($entity)
	{
		// $mobileFields = $this->metaTableName::$MOBILE_FIELDS;
		// Thle line above is valid in PHP 7, but not in older PHP versions. The following two lines are more portable:
		$metaTableName = $this->metaTableName;
		$fields  = ['id' => [\PDO::PARAM_INT, false, null]] + $metaTableName::$MOBILE_FIELDS;

		$entityViewModel = [];
		foreach ($fields as $fieldName => $fieldMetaData) {
			list($pdoType) = $fieldMetaData;
			if (array_key_exists($fieldName, $entity)) {
				$entityViewModel[$fieldName] = $entity[$fieldName];
			} elseif ($fieldName != 'id') {
				$entityViewModel[$fieldName] = self::typeDefaults($pdoType);
			}
		}
		return $entityViewModel;
	}

	public function errorViewModel($errors)
	{
		// $mobileFields = $this->metaTableName::$MOBILE_FIELDS;
		// Thle line above is valid in PHP 7, but not in older PHP versions. The following two lines are more portable:
		$metaTableName    = $this->metaTableName;
		$mobileFieldNames = array_keys($metaTableName::$MOBILE_FIELDS);

		$errorViewModel = [];
		foreach ($mobileFieldNames as $fieldName) {
			$errorViewModel[$fieldName] = array_key_exists($fieldName, $errors)
			                            ? $errors[$fieldName]
			                            : '';
		};
		return $errorViewModel;
	}

	private static function typeDefaults($pdoType)
	{
		switch ($pdoType) {
			case \PDO::PARAM_INT:  return 0;
			case \PDO::PARAM_BOOL: return false;
			default:               return "";
		}
	}
}
