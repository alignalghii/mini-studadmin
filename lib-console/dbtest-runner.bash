#!/bin/bash

function dbtest-runner {
	db_name="$1";

	echo "Database: \`$db_name\`";

	find database/testsuites -mindepth 1 -maxdepth 1 -type d\
	|
	while read testsuite;
		do
			echo "Testsuite $testsuite";
			echo -e "\tSetup";
			if awk -f lib-console/truncate.awk < database/schema/dependencies.dat | mysql "`db_name`";
				then echo -e "\t\tTruncation successful";
				else echo -e "\t\tTruncation failed";
			fi;
			while read tableName;
				do
					fixtureFile="$testsuite/$tableName.fixture.sql"
					if test -f "$fixtureFile";
						then
							echo -en "\t\tLoading table \`$tableName\`... ";
							if mysql "$db_name" < "$fixtureFile";
								then echo "loaded successfully";
								else echo "failed loading";
							fi;
						else
							echo -e "\t\tNo testdata for $tableName: fixture file $fixtureFile does not exist";
					fi;
			done < database/schema/dependencies.dat;
			if test -f $testsuite/functionality-to-be-tested.bash;
				then
					echo -en "\tRunning the app functionality to be tested... ";
					if $testsuite/functionality-to-be-tested.bash;
						then echo " correct run";
						else echo " broken run";
					fi;
				else
					echo -e "\tImplicit idle functionality assumed: no interaction with app provided";
			fi;
			echo -e "\tComparisons";
			find "$testsuite" -name '*.expected.tsv'\
			|
			while read expected;
				do
					table=`basename ${expected%.expected.tsv}`;
					actual="${expected%.expected.tsv}.actual.tsv";
					echo -en "\t\tGenerating actual data for expectation of \`$table\`... ";
					if echo "SELECT * FROM \`$table\`" | mysql "$db_name" > "$actual";
						then echo "done";
						else echo "failed";
					fi;
					if diff $expected $actual;
						then echo -e "\t\t - OK, actual meets expectation";
						else echo -e "\t\t - Wrong, actual differs from expectation";
					fi;
			done;
	done;
}
