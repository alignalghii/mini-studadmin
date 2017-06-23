<?php

namespace Controller;

class StudentController
{
	const class54 = __CLASS__;

	public static function index()
	{
		echo "Students list...\n";
	}

	public static function show($id)
	{
		printf("Student #%s\n", $id);
	}
}
