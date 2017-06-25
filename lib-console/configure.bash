#!/bin/bash

function configure {
	if test -f database/config.sed;
		then
			sed -f database/config.sed app/Config.php.tpl > app/Config.php;
		else
			echo 'No configuration datafile `config.sed` found.'
			echo 'Type `cp config.sample.sed config.sed`, and customize it.';
	fi;
}
