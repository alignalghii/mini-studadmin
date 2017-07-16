<?php

namespace app\MetaTables;

class StudentMetaTable
{
	const class54 = __CLASS__;

	const NAME = 'student';

	public static $MOBILE_FIELDS = [
		'name'           => [\PDO::PARAM_STR,  false, null,  ['nonblank']                         ],
		'is_male'        => [\PDO::PARAM_BOOL, false, false, []                                   ],
		'place_of_birth' => [\PDO::PARAM_STR,  true,  null,  []                                   ],
		'date_of_birth'  => [\PDO::PARAM_STR,  true,  null,  ['dateformat']                       ],
		'email'          => [\PDO::PARAM_STR,  false, null,  ['nonblank', 'emailformat', 'unique']]
	];
}
