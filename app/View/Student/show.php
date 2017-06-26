		<h1><?php echo $title; ?></h1>
		<table>
			<tr>
				<th rowspan="2">#</th>
				<th rowspan="2">Name</th>
				<th rowspan="2">Male?</th>
				<th>Place</th>
				<th>Date</th>
				<th rowspan="2">Email</th>
			</tr>
			<tr>
				<th colspan="2">of birth</th>
			</tr>
			<tr>
<?php foreach ($student as $attr => $val): ?>
				<td><?php echo $val; ?></td>
<?php endforeach; ?>
			</tr>
		</table>
