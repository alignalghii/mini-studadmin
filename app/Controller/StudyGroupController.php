<?php

namespace app\Controller;

use app\MetaTables\StudyGroupMetaTable;

use framework\Controller;
use framework\ORM\Repository;
use framework\ViewModelManager;
use framework\Form;


class StudyGroupController extends Controller
{
	const class54 = __CLASS__;

	public function index()
	{
		$studyGroupRepository = new Repository(StudyGroupMetaTable::class54);
		$studyGroups          = $studyGroupRepository->findAll();
		$viewModel            = [
			'title'       => 'List of all study groups',
			'studyGroups' => $studyGroups
		];
		$this->render('StudyGroup/index', $viewModel, 'table-page');
	}

	public function show($id)
	{
		$form                 = new Form(StudyGroupMetaTable::class54);
		$studyGroupRepository = new Repository(StudyGroupMetaTable::class54);
		$studyGroup           = $studyGroupRepository->find($id);
		$viewModel = [
			'title'            => "Show study group #$id",
			'errorSummaryMsg'  => '',
			'studyGroup'          => $form->entityViewModel($studyGroup),
			'isUpdateMode'     => true,
			'actionLabel'      => "Update",
			'actionUri'        => "/study-group/$id",
			'validationErrors' => $form->errorViewModel([])
		];
		$this->render('StudyGroup/show', $viewModel, 'form-page');
	}

	public function update($id)
	{
		$form              = new Form(StudyGroupMetaTable::class54);
		$post              = compact('id') + $this->request()->post();
		$validation        = $form->convertAndValidate($post, true);
		$validation->either2Or1(
			function ($invalidEntity, $errorModel) use ($form, $id) {
				$viewModel = [
					'title'            => "Update study group #$id",
					'actionLabel'      => 'Update',
					'actionUri'        => "/study-group/$id",
					'studyGroup'          => $form->entityViewModel($invalidEntity),
					'isUpdateMode'     => true,
					'validationErrors' => $form->errorViewModel($errorModel),
					'errorSummaryMsg'  => "There are " . count($errorModel) . " validation errors",
				];
				$this->render('StudyGroup/show', $viewModel, 'form-page');
			},
			function ($validEntity) use ($id) {
				$studyGroupRepository = new Repository(StudyGroupMetaTable::class54);
				$studyGroupRepository->update($validEntity, $id);
				$this->redirect('/study-group');
			}
		);
	}

	public function delete($id)
	{
		$studyGroupRepository = new Repository(StudyGroupMetaTable::class54);
		$studyGroupRepository->delete($id);
		$this->redirect('/study-group');
	}

	public function new_GET()
	{
		$form = new Form(StudyGroupMetaTable::class54);
		$viewModel = [
			'title'            => 'Add a new study group',
			'actionLabel'      => 'Create',
			'actionUri'        => '/study-group/new',
			'isUpdateMode'     => false,
			'studyGroup'       => $form->entityViewModel([]),
			'validationErrors' => $form->errorViewModel ([]),
			'errorSummaryMsg'  => '',
		];
		$this->render('StudyGroup/show', $viewModel, 'form-page');
	}

	public function new_POST()
	{
		$post       = $this->request()->post();
		$form       = new Form(StudyGroupMetaTable::class54);
		$validation = $form->convertAndValidate($post, false);
		$validation->either2Or1(
			function ($invalidEntity, $errorModel) use ($form) { // in case of failed validation
				$viewModel = [
					'title'            => 'Add a new study group',
					'actionLabel'      => 'Create',
					'actionUri'        => '/study-group/new',
					'isUpdateMode'     => false,
					'studyGroup'       => $form->entityViewModel($invalidEntity),
					'validationErrors' => $form->errorViewModel ($errorModel),
					'errorSummaryMsg'  => "There are " . count($errorModel) . " validation errors",
				];
				$this->render('StudyGroup/show', $viewModel, 'form-page');
			},
			function ($validEntity) { // in case of successful validation
				$studyGroupRepository = new Repository(StudyGroupMetaTable::class54);
				$studyGroupRepository->create($validEntity);
				$this->redirect('/study-group');
			}
		);
	}
}
