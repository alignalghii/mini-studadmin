<?php

namespace Controller;

use ORM\Repository;
use MetaTables\StudentMetaTable;

class StudentController extends \Controller
{
	const class54 = __CLASS__;

	public function index()
	{
		$studentRepository = new Repository(StudentMetaTable::class54);
		$students = $studentRepository->findAll();
		echo "Students list:\n";
		var_dump($students);
	}

	public function show($id)
	{
		$studentRepository = new Repository(StudentMetaTable::class54);
		$student = $studentRepository->find($id);
		echo "Show student #$id:\n";
		var_dump($student);
	}

	public function update($id)
	{
		echo "Update student #$id with the following data:\n";
		var_dump($this->request()->post());
	}
}
