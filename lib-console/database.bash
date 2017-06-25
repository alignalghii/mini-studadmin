
function database-create {
	sed -f database/config.sed database/database/create.sql.tpl | mysql;
}

function database-drop {
	sed -f database/config.sed database/database/drop.sql.tpl | mysql;
}

function schema-create {
	while read tablename;
		do
			mysql "`db_name`" < "database/schema/table-create-$tablename.sql";
	done < database/schema/dependencies.dat;
	mysql "`db_name`" < database/schema/trigger-create.sql;
}

function schema-drop {
	tac database/schema/dependencies.dat\
	|
	while read tablename;
		do
			echo 'DROP TABLE `'"$tablename"'`' | mysql "`db_name`";
	done;
}

function db_name {
	echo '{{{DB_NAME}}}' | sed -f database/config.sed;
}
