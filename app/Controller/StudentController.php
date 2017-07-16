<?php

namespace app\Controller;

use app\MetaTables\StudentMetaTable;

use framework\Controller;
use framework\ORM\Repository;
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
		$this->render('Student/index', $viewModel, 'table-page');
	}

	public function show($id)
	{
		$form              = new Form(StudentMetaTable::class54);
		$studentRepository = new Repository(StudentMetaTable::class54);
		$student           = $studentRepository->find($id);
		$viewModel = [
			'title'            => "Show student #$id",
			'errorSummaryMsg'  => '',
			'student'          => $form->entityViewModel($student),
			'isUpdateMode'     => true,
			'actionLabel'      => "Update",
			'actionUri'        => "/student/$id",
			'validationErrors' => $form->errorViewModel([])
		];
		$this->render('Student/show', $viewModel, 'form-page');
	}

	public function update($id)
	{
		$form              = new Form(StudentMetaTable::class54);
		$post              = compact('id') + $this->request()->post();
		$validation        = $form->convertAndValidate($post, true);
		$validation->either2Or1(
			function ($invalidEntity, $errorModel) use ($form, $id) {
				$viewModel = [
					'title'            => "Update student #$id",
					'actionLabel'      => 'Update',
					'actionUri'        => "/student/$id",
					'student'          => $form->entityViewModel($invalidEntity),
					'isUpdateMode'     => true,
					'validationErrors' => $form->errorViewModel($errorModel),
					'errorSummaryMsg'  => "There are " . count($errorModel) . " validation errors",
				];
				$this->render('Student/show', $viewModel, 'form-page');
			},
			function ($validEntity) use ($id) {
				$studentRepository = new Repository(StudentMetaTable::class54);
				$studentRepository->update($validEntity, $id);
				$this->redirect('/student');
			}
		);
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
			'title'            => 'Add a new student',
			'actionLabel'      => 'Create',            'actionUri' => '/student/new',
			'isUpdateMode'     => false,
			'student'          => $form->entityViewModel([]),
			'validationErrors' => $form->errorViewModel ([]),
			'errorSummaryMsg'  => '',
		];
		$this->render('Student/show', $viewModel, 'form-page');
	}

	public function new_POST()
	{
		$post       = $this->request()->post();
		$form       = new Form(StudentMetaTable::class54);
		$validation = $form->convertAndValidate($post, false);
		$validation->either2Or1(
			function ($invalidEntity, $errorModel) use ($form) { // in case of failed validation
				$viewModel = [
					'title'            => 'Add a new student',
					'actionLabel'      => 'Create',
					'actionUri'        => '/student/new',
					'isUpdateMode'     => false,
					'student'          => $form->entityViewModel($invalidEntity),
					'validationErrors' => $form->errorViewModel ($errorModel),
					'errorSummaryMsg'  => "There are " . count($errorModel) . " validation errors",
				];
				$this->render('Student/show', $viewModel, 'form-page');
			},
			function ($validEntity) { // in case of successful validation
				$studentRepository = new Repository(StudentMetaTable::class54);
				$studentRepository->create($validEntity);
				$this->redirect('/student');
			}
		);
	}
}
