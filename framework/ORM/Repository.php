<?php

namespace framework\ORM;

use framework\Meta;

class Repository
{
	private $tableName;
	private $mobileFields;

	public function __construct($metaTableClassName)
	{
		$this->tableName    = $metaTableClassName::NAME;
		$this->mobileFields = array_map(
			function ($arr) {return $arr[0];}, // mapHead
			$metaTableClassName::$MOBILE_FIELDS
		);
	}

	public function find($id)
	{
		$statement = new Statement(
			'SELECT * FROM `'.$this->tableName.'` WHERE `id` = :id',
			[':id' => [$id, \PDO::PARAM_INT]]
		);
		$record = $statement->queryOneOrAll(true);
		return $this->convertFetched($record);
	}

	public function findAll()
	{
		$statement = new Statement('SELECT * FROM `'.$this->tableName.'`', []);
		$records   = $statement->queryOneOrAll(false);
		return array_map([$this, 'convertFetched'], $records);
	}

	public function countAll()
	{
		$statement = new Statement('SELECT COUNT(*) AS `n` FROM `'.$this->tableName.'`', []);
		return $statement->queryOneOrAll(true)['n'];
	}

	public function create($validationEntity)
	{
		$builder = new Builder($this->tableName);
		$creationInfo = $builder->create($validationEntity, $this->mobileFields);
		extract($creationInfo); // $sql, $typedBindings
		new Statement($sql, $typedBindings); // object not used, but statement execution is a side effect
	}

	public function update($formEntity, $id)
	{
		$builder = new Builder($this->tableName);
		$updateInfo = $builder->update($formEntity, $this->mobileFields, $id);
		extract($updateInfo); // $sql, $typedBindings
		new Statement($sql, $typedBindings); // object not used, but statement execution is a side effect
	}

	public function delete($id)
	{
		$builder = new Builder($this->tableName);
		$deletionInfo = $builder->delete($id);
		extract($deletionInfo); // $sql, $typedBindings
		new Statement($sql, $typedBindings); // object not used, but statement execution is a side effect
	}

	private function convertFetched($record)
	{
		$mobileFields = $this->mobileFields;
		$convertedRecord = [];
		foreach (['id' => \PDO::PARAM_INT] + $mobileFields as $fieldName => $type) {
			if (array_key_exists($fieldName, $record)) {
				$value = $record[$fieldName];
				switch ($type) {
					case \PDO::PARAM_BOOL:
						$convertedRecord[$fieldName] = (bool)   $value;
						break;
					case \PDO::PARAM_INT:
						$convertedRecord[$fieldName] = (int)    $value;
						break;
					case \PDO::PARAM_STR:
						$convertedRecord[$fieldName] = (string) $value;
						break;
					default:
						$convertedRecord[$fieldName] =          $value;
				}
			}
		}
		return $convertedRecord;
	}

}
