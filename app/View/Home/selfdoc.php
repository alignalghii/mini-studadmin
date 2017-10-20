<?php require '../app/View/Home/sourcelinks.php'; ?>
		<ul class="upper-menu internal">
			<li><a class="menu-icon" href="/">Back to home</a></li>
		</ul>
		<h1><?php echo $title; ?></h1>

		<p>
			This the other main goal of this site:
			experimenting with a self-documenting content structure:
		</p>
		<ul>
			<li>Provide a sourcecode link structure for each functionality of the <a href="/sample-webapp">sample web app</a>, just in place on the user interface.</li>
			<li>For each functionality, arrange the sourcecode link structure according to a call tree, maybe refined to represent the logics and architecture.</li>
		</ul>
		<p>
			Look at the top of this very page!
			The gray horizontal menubar with the colorful buttons belongs to the business logic and functionality of the sample web app.
		</p>
		<p>
			But now we are more interested in the graph-like figure above the horizontal menu bar.
			The label on each box is a link pointing to a section of the sourcecode as stored on GitHub.
			Each box is also tooltipped: if You hover with the mouse above it, a small description appears - a table name, a module name, a contraint name, or any essential thing that comprises its essence. The details can be seen by clicking on the label of the box: the linkfied sourcecode opens in a new tab of the browser.
		</p>
