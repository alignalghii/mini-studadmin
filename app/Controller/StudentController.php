<?php

namespace app\Controller;

use framework\Controller;
use framework\ORM\Repository;
use framework\Util;

use app\MetaTables\StudentMetaTable;

class StudentController extends Controller
{
	const class54 = __CLASS__;

	public function index()
	{
		$title = 'List of all students';
		$studentRepository = new Repository(StudentMetaTable::class54);
		$studentRecords = $studentRepository->findAll();
		$students = array_map(
			function ($studentRecord) {
				return Util::array_map_access_keys(
					function ($attr, $val) {
						return $attr == 'is_male'
						     ? ($val ? 'Male' : 'Female')
						     : $val;
					},
					$studentRecord
				);
			},
			$studentRecords
		);
		$viewModel = compact('title', 'students');
		$this->render('Student/index', $viewModel);
	}

	public function show($id)
	{
		$title = "Show student #$id";
		$studentRepository = new Repository(StudentMetaTable::class54);
		$student = $studentRepository->find($id);
		$viewModel = compact('title', 'student');
		$this->render('Student/show', $viewModel);
	}

	public function update($id)
	{
		echo "Update student #$id with the following data:\n";
		var_dump($this->request()->post());
	}
}
