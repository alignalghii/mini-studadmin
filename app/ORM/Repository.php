<?php

namespace ORM;

class Repository
{
	private $tableName;
	private $mobileFields;

	public function __construct($metaTableClassName)
	{
		$this->tableName    = $metaTableClassName::NAME;
		$this->mobileFields = $metaTableClassName::$MOBILE_FIELDS;
	}

	public function find($id)
	{
		$statement = new Statement(
			'SELECT * FROM `'.$this->tableName.'` WHERE `id` = :id',
			[':id' => [$id, \PDO::PARAM_INT]]
		);
		return $statement->queryOneOrAll(true);
	}

	public function findAll()
	{
		$statement = new Statement('SELECT * FROM `'.$this->tableName.'`', []);
		return $statement->queryOneOrAll(false);
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
		$updateInfo = $builder->update($formEntity, $this->mobileFields);
		extract($updateInfo); // $sql, $typedBindings
		$typedBindings[':id'] = [$id, \PDO::PARAM_INT];
		new Statement($sql, $typedBindings); // object not used, but statement execution is a side effect
	}

	public function delete($id)
	{
		$builder = new Builder($this->tableName);
		$deletionInfo = $builder->delete($id);
		extract($deletionInfo); // $sql, $typedBindings
		new Statement($sql, $typedBindings); // object not used, but statement execution is a side effect
	}
}
