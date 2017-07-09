<?php

namespace app\Controller;

use app\MetaTables\StudentMetaTable;

use framework\Controller;
use framework\ORM\Repository;
use framework\Util;
use framework\ViewModelManager;
use framework\Form;


class StudentController extends Controller
{
	const class54 = __CLASS__;

	public function index()
	{
		$title = 'List of all students';
		$studentRepository = new Repository(StudentMetaTable::class54);
		$studentRecords = $studentRepository->findAll();
		$viewModelManager = new ViewModelManager(
			function ($attr, $val) {
				return $attr == 'is_male'
				     ? ($val ? 'Male' : 'Female')
				     : $val;
			}
		);
		$students = $viewModelManager->representRecordSet($studentRecords);
		$viewModel = compact('title', 'students');
		$this->render('Student/index', $viewModel);
	}

	public function show($id)
	{
		$studentRepository = new Repository(StudentMetaTable::class54);
		$title        = "Show student #$id";
		$student      = $studentRepository->find($id);
		$isUpdateMode = true;
		$action       = "/student/$id";
		$viewModel = compact('title', 'student', 'isUpdateMode', 'action');
		$this->render('Student/show', $viewModel);
	}

	public function update($id)
	{
		$form = new Form(StudentMetaTable::class54);
		$post = $this->request()->post();
		$updater = $form->convert($post);
		$studentRepository = new Repository(StudentMetaTable::class54);
		$studentRepository->update($updater, $id);
		$this->redirect('/student');
	}

	public function delete($id)
	{
		$studentRepository = new Repository(StudentMetaTable::class54);
		$studentRepository->delete($id);
		$this->redirect('/student');
	}
}
