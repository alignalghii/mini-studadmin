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
		echo "Show student #$id\n";
	}

	public function update($id)
	{
		echo "Update student #$id with the following data:\n";
		var_dump($this->request()->post());
	}
}
