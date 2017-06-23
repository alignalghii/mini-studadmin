<?php

namespace Controller;

class StudentController extends \Controller
{
	const class54 = __CLASS__;

	public function index()
	{
		echo "Students list...\n";
	}

	public function show($id)
	{
		printf("Student #%s\n", $id);
	}

	public function newOrUpdate($id)
	{
		printf("Create/update student #%s with the following data:\n", $id);
		var_dump($this->request()->post());
	}
}
