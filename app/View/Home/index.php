<?php require '../app/View/Home/index.sourcelinks.php'; ?>
		<ul class="upper-menu internal">
			<li><a class="menu-icon" href="/student">Students list</a></li>
			<li><a class="menu-icon" href="/study-group">Study groups list</a></li>
		</ul>
		<h1><?php echo $title; ?></h1>
		<p>
			This is an educational site for web programming,  try to make the understanding of web apps and frameworks easier.
			It tries to tackle two problems:
		</p>
		<ul>
			<li>Most frameworks are usually complex and hard. This site tries to present an an artificially simplified web framework.</li>
			<li>
				Besides this, true understanding requires the ability to associate the dynamic behavior of the living web application to the static structure of the source code. The dynamic behavior and the static code should be understood almost side-by-side.
			</li>
		</ul>
		<p>
			This latter is the other main goal of this site. The user, looking at the visible surface of the web app, can see the various subpages and widgets. These act as control points, where he/she can trigger functionalities. The main novelty is that there is a call tree link graph beside each control point/widget. These documentary links show the sourcecodes associated to each user-visible control widget,
			thus for each functionality/behaviour the user can see the underlying sourcecode, moreover, he/she can look through the whole call tree.
		</p>
		<p>For an example, just look at the top of this very page!</p>
		<ul>
			<li>
				The gray horizontal menubar with the colorful buttons belongs to the business logic and functionality of the sample web app.
				As You can see, this sample app is a simple CRUD for two tables (students and studygroups).
			</li>
			<li>
				Now look above the hotizontal menu bar:
				there is a graph/tree-like figure consisting of black rectangular boxes connected by arrows.
				Each box is labeled, and each label is linkified: they are clickable.
				This graph does not belong to the business logic of the web app:
				these links do not contain any functionality, they simply point to appropriate GitHub sourcecode sections.
				What the whole graph figure represents is the call tree triggered by the GET request when accessing this page.
			</li>
		</ul>
		In short, summarizing all above:
		<ul>
			<li>
				the site itself is <a href="/doc/sample-webapp">a tiny web application</a>,
				a sample barely surpassing the level of a simple CRUD.
			</li>
			<li>
				But there is a <a href="/doc/custom-framework">self-made web application framework</a> underlying the sample application. This provides the real topics of the site.
			</li>
			<li>
				The pages of the sample app can show the sourcecode associated to all its widgets and behavior <a href="/doc/selfdoc">in a self-documenting way</a>.
			</li>
		</ul>
		<h2>Contents, site map</h2>
		<ul>
		</ul>
