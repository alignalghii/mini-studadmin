function testSo {
	host=$1;
	command=$2;
	slow $host;
	(
		set -o xtrace;
		$command;
	);
}

function testWithHost {
	host="$1";
	testSo $host "curl                             $host";
	testSo $host "curl                             $host/";
	testSo $host "curl -X POST -H Content-Length:0 $host";
	testSo $host "curl                             $host/student";
	testSo $host "curl                             $host/nonexisting";
	testSo $host "curl                             $host/nonexisting.php";
}

function slow {
	host="$1";
	if [[ "$host" =~ "http://" ]];
		then sleep 2;
			#until
			#	read -p "Overlaod protection: comfirm request with typing 'yes' exactly" cf;
			#	test "$cf" = "yes";
			#	do
			#		echo Not confirmed;
			#done;
		fi;
}

function testWithHosts {
	for host;
		do
			echo === $host ===;
			testWithHost "$host";
			echo;
	done;
}
