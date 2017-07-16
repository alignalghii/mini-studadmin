<?php

namespace app\MetaTables;

class StudyGroupMetaTable
{
	const class54 = __CLASS__;

	const NAME = 'study_group';

	public static $MOBILE_FIELDS = [
		'name'    => [\PDO::PARAM_STR, false, null,  ['nonblank', 'unique']    ],
		'leader'  => [\PDO::PARAM_STR, true,  null,  []                        ],
		'subject' => [\PDO::PARAM_STR, false, null,  ['nonblank']              ],
		'created' => [\PDO::PARAM_STR, false, null,  ['nonblank', 'dateformat']],
	];
}
