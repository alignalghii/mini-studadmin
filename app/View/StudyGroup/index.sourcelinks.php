		<table class="tree">
			<tr>
				<th colspan="9" title="alignalghii/mini-studadmin"><a class="source" href="https://github.com/alignalghii/mini-studadmin" target="_blank">GitHub repository</a></td>
			</tr>
			<tr>
				<td colspan="5"></td>
				<td>&#8599;</td>
				<td title="Table name `study_group` + field metadata" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/MetaTables/StudyGroupMetaTable.php" target="_blank">Table metadata @ PHP</a></td>
				<td rowspan="2">&nbsp;</td>
				<td rowspan="2" title="CREATE TABLE `study_group`"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/database/schema/table-create-study_group.sql" target="_blank">Raw SQL schema</a></td>
			</tr>
			<tr>
				<td rowspan="2" title="GET /study-group"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/Routes.php#L28" target="_blank">Route match</a></td>
				<td rowspan="2" title="called at &hellip;">&rarr;</td>
				<td rowspan="2" title="StudyGroupController::index"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/Controller/StudyGroupController.php#L17-L26" target="_blank">Controller action</a></td>
				<td>&#8599;</td>
				<td title="ORM\Repository::findAll"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Repository.php#L31-L36" target="_blank">Model/DB-repo</a></td>
				<td title="called at &hellip;">&rarr;</td>
				<td title="Build+prep+exec: [SELECT * FROM `study_group`]" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Statement.php#L39-L46" target="_blank">SQL statement preparer</a></td>
			</tr>
			<tr>
				<td title="called at &hellip;">&#8600;</td>
				<td title="StudyGroup/index" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/master/app/View/StudyGroup/index.php" target="_blank">View</a></td>
				<td colspan="4"></td>
			</tr>
		</table>
