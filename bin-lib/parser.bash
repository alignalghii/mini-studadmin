# Little parser for command-line options of the `console.bash` miniapplication

function parse {
	case "$1" in
		server-start)
			(
				cd web;
				php -S localhost:8000 htaccess-for-builtin-server.php &
			);;
		server-status)
			server-status;;
		server-stop)
			line=`server-status`;
			pid=`echo "$line" | awk '{print $2}'`;
			if test -z $pid;
				then
					message "No process found to stop";
				else
					echo $line;
					if confirm "Confirm killing process $pid? (empty: no, any other: yes) ";
						then kill "$pid";
					fi;
			fi;;
		test-HTTP)
			testWithHosts localhost:8000 mini-studadmin http://web.studentadministrationframework.nhely.hu;;
		test-unit)
			(
				cd test;
				php frontal-test.php;
			);;
		*)
			help;
	esac;
}
