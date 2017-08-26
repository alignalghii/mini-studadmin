		<table class="tree">
			<tr>
				<th colspan="9" title="alignalghii/mini-studadmin"><a class="source" href="https://github.com/alignalghii/mini-studadmin" target="_blank">GitHub repository</a></td>
			</tr>
			<tr>
				<td colspan="5"></td>
				<td>&#8599;</td>
				<td title="Table name `student` + field metadata" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/MetaTables/StudentMetaTable.php" target="_blank">Table metadata @ PHP</a></td>
				<td rowspan="2">&nbsp;</td>
				<td rowspan="2" title="CREATE TABLE `student`"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/database/schema/table-create-student.sql" target="_blank">Raw SQL schema</a></td>
			</tr>
			<tr>
				<td rowspan="2" title="GET /student"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/Routes.php#L21" target="_blank">Route match</a></td>
				<td rowspan="2" title="called at &hellip;">&rarr;</td>
				<td rowspan="2" title="StudentController::index"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/Controller/StudentController.php#L17-L33" target="_blank">Controller action</a></td>
				<td>&#8599;</td>
				<td title="ORM\Repository::findAll"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Repository.php#L31-L36" target="_blank">Model/DB-repo</a></td>
				<td title="called at &hellip;">&rarr;</td>
				<td title="Build+prep+exec: [SELECT * FROM `student`]" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Statement.php#L39-L46" target="_blank">SQL statement preparer</a></td>
			</tr>
			<tr>
				<td title="called at &hellip;">&#8600;</td>
				<td title="Student/index" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/View/Student/index.php" target="_blank">View</a></td>
				<td colspan="4"></td>
			</tr>
		</table>
