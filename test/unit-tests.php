<?php

require '../autoload.php';

use framework\Util;
use framework\Maybe;

$r = Util::array_mapMaybe_access_keys(function($k, $v) {return Maybe::just($k + $v);}, [10,20,30]);
$status = $r === [10, 21, 32];
echo $status ? 'OK' : 'Wrong';
echo "\n";


