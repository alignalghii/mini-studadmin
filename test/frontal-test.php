<?php

/** Test the front controller */

require '../autoload.php';

$testRunner = new TestRunner(Routes::TESTCASES(), Routes::NO_MATCH_REGEXP);
$testRunner->run();
