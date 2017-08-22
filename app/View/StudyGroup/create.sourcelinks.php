		<table class="tree">
			<tr>
				<td rowspan="3" title="POST <?php echo $actionUri; ?>" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/Routes.php#L32-L33" target="_blank">Route match</a></td>
				<td rowspan="3">&rarr;</td>
				<td rowspan="3" title="StudyGroupController::new_POST" class="full"><a class="source" href="
https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/Controller/StudyGroupController.php#L93-L117" target="_blank">Action</a></td>
				<td rowspan="2">&#8599;</td>
				<td rowspan="2" title="Form::validate" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/Form.php#L81-L133" target="_blank">Validation</a></td>
				<td>&#8599;</td>
				<td colspan="3" title="nonblank, dateformat" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/Form.php#L96-L112" target="_blank">Single-field constraints</a></td>
				<td>&rarr;</td>
				<td><a title="(name: nonblank), (subject: nonblank), (created: nonblank, dateformat)" class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/MetaTables/StudyGroupMetaTable.php#L12-L15" target="_blank">Table metadata @ PHP</a></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td>&#8600;</td>
				<td><a title="!Form::isNotUniqueWith" class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/Form.php#L135-L150" target="_blank">Constraint of uniqueness</a></td>
				<td>&rarr;</td>
				<td title="ORM\Repository::findAll"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Repository.php#L31-L36" target="_blank">Global check</a></td>
				<td>&#8600;</td>
				<td rowspan="2" title="name: unique" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/app/MetaTables/StudyGroupMetaTable.php#L12" target="_blank">Table metadata @ PHP</a></td>
				<td rowspan="2">&#8600;</td>
				<td></td>
			</tr>
			<tr>
				<td>&#8600;</td>
				<td colspan="5"></td>
				<td>&#8599;</td>
				<td title="CREATE TABLE `study_group`" class="full"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/database/schema/table-create-study_group.sql" target="_blank">Raw SQL schema</a></td>
			</tr>
			<tr>
				<td colspan="4"></td>
				<td class="full" colspan="5" title="ORM\Repository::create"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Repository.php#L44-L50" target="_blank">Model</a></td>
				<td>&rarr;</td>
				<td class="full" title="ORM\Builder::create"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Builder.php#L32-L49" target="_blank">SQL-builder</a></td>
				<td>&#8599;</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="9"></td>
				<td>&#8600;</td>
				<td title="ORM\Statement"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/Statement.php#L14-L37" target="_blank">SQL statement preparer</a></td>
				<td>&rarr;</td>
				<td title="ORM\DbConn"><a class="source" href="https://github.com/alignalghii/mini-studadmin/blob/92efdbce271416373b116ec348a40d30e216a2e2/framework/ORM/DbConn.php" target="_blank">DB-connection</a></td>
			</tr>
		</table>
