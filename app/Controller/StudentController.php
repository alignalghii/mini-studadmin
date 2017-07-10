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
		$studentRepository = new Repository(StudentMetaTable::class54);
		$studentRecords = $studentRepository->findAll();
		$viewModelManager = new ViewModelManager(
			function ($attr, $val) {
				return $attr == 'is_male'
				     ? ($val ? 'Male' : 'Female')
				     : $val;
			}
		);
		$viewModel = [
			'title'    => 'List of all students',
			'students' => $viewModelManager->representRecordSet($studentRecords)
		];
		$this->render('Student/index', $viewModel);
	}

	public function show($id)
	{
		$studentRepository = new Repository(StudentMetaTable::class54);
		$viewModel = [
			'title'        => "Show student #$id",
			'student'      => $studentRepository->find($id),
			'isUpdateMode' => true,
			'actionLabel'  => "Update",
			'actionUri'    => "/student/$id"
		];
		$this->render('Student/show', $viewModel);
	}

	public function update($id)
	{
		$form              = new Form(StudentMetaTable::class54);
		$post              = $this->request()->post();
		$updaterEntity     = $form->convert($post);
		$studentRepository = new Repository(StudentMetaTable::class54);
		$studentRepository->update($updaterEntity, $id);
		$this->redirect('/student');
	}

	public function delete($id)
	{
		$studentRepository = new Repository(StudentMetaTable::class54);
		$studentRepository->delete($id);
		$this->redirect('/student');
	}

	public function new_GET()
	{
		$form = new Form(StudentMetaTable::class54);
		$viewModel = [
			'title'        => 'Add a new student',
			'actionLabel'  => 'Create',            'actionUri' => '/student/new',
			'isUpdateMode' => false,
			'student'      => $form->createBlank()
		];
		$this->render('Student/show', $viewModel);
	}

	public function new_POST()
	{
		$post              = $this->request()->post();
		$form              = new Form(StudentMetaTable::class54);
		$createrEntity     = $form->convert($post);
		$studentRepository = new Repository(StudentMetaTable::class54);
		$studentRepository->create($createrEntity);
		$this->redirect('/student');
	}
}
