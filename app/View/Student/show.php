		<h1><?php echo $title; ?></h1>
		<form method="POST" action="<?php echo $actionUri; ?>">
			<ul>
<?php if ($isUpdateMode): ?>
				<li>Identity: <?php echo $student['id']; ?></li>
<?php endif; ?>
				<li>
					Name:
					<input type="text" name="name" value="<?php echo $student['name']; ?>"/>
<?php if ($validationErrors['name']): ?>
					<?php echo $validationErrors['name']; ?>

<?php endif; ?>
				</li>
				<li>
					Is male?
					<input type="checkbox" name="is_male"<?php if ($student['is_male']): ?> checked<?php endif; ?>/>
				</li>
				<li>
					Place of birth:
					<input type="text" name="place_of_birth" value="<?php echo $student['place_of_birth']; ?>"/>
				</li>
				<li>
					Date of birth:
					<input type="text" name="date_of_birth" value="<?php echo $student['date_of_birth']; ?>"/>
<?php if ($validationErrors['date_of_birth']): ?>
					<?php echo $validationErrors['date_of_birth']; ?>

<?php endif; ?>
				</li>
				<li>
					Email:
					<input type="text" name="email" value="<?php echo $student['email']; ?>"/>
<?php if ($validationErrors['email']): ?>
					<?php echo $validationErrors['email']; ?>

<?php endif; ?>
				</li>
			</ul>
			<input type="submit" value="<?php echo $actionLabel; ?>"/>
			<a href="<?php echo $actionUri; ?>">Reset</a>
		</form>
