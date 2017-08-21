		<table class="tree">
			<tr>
				<th colspan="9" title="alignalghii/mini-studadmin"><a class="source" href="https://github.com/alignalghii/mini-studadmin" target="_blank">GitHub repository</a></td>
			</tr>
			<tr>
				<td rowspan="2" title="GET <?php echo $actionUri; ?>"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/Routes.php#L22" target="_blank">Route match</a></td>
				<td rowspan="2" title="called at &hellip;">&rarr;</td>
				<td rowspan="2" title="StudentController::show"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/Controller/StudentController.php#L35-L50" target="_blank">Controller action</a></td>
				<td>&#8599;</td>
				<td title="ORM\Repository::find"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Repository.php#L21-L29" target="_blank">Model/DB-repo</a></td>
				<td title="called at &hellip;">&rarr;</td>
				<td title="name, is_male, place_of_birth, date_of_birth, email"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/MetaTables/StudentMetaTable.php" target="_blank">Table metadata @ PHP</a></td>
				<td title="called at &hellip;">&rarr;</td>
				<td title="CREATE TABLE `student`"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/database/schema/table-create-student.sql" target="_blank">SQL schema</a></td>
			</tr>
			<tr>
				<td title="called at &hellip;">&#8600;</td>
				<td colspan="5" title="Student/show"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/View/Student/show.php" target="_blank">View</a></td>
			</tr>
		</table>
