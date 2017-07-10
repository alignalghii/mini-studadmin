		<h1><?php echo $title; ?></h1>
		<table>
			<tr>
				<th rowspan="2">#</th>
				<th rowspan="2">Name</th>
				<th rowspan="2">Gender</th>
				<th>Place</th>
				<th>Date</th>
				<th rowspan="2">Email</th>
				<th colspan="2" rowspan="2">Actions</th>
			</tr>
			<tr>
				<th colspan="2">of birth</th>
			</tr>
<?php foreach ($students as $student): ?>
			<tr>
<?php foreach ($student as $attr => $val): ?>
				<td><?php echo $val; ?></td>
<?php endforeach; ?>
				<td><a href="/student/<?php echo $student['id']; ?>">Show</a></td>
				<td><form method="POST" action="/student/<?php echo $student['id']; ?>/delete"><input type="submit" value="Delete"/></form></td>
			</tr>
<?php endforeach; ?>
		</table>
		<a href="/student/new">Add a new student</a>
