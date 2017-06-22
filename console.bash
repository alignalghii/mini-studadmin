#!/bin/bash

source bin-lib/aux.bash;    # used by `parser` module
source bin-lib/parser.bash; # used by `parse` function call
source bin-lib/test.bash;   # used by `parse` function call

if test $# -eq 0;
	then help;
	else parse "$1";
fi;
