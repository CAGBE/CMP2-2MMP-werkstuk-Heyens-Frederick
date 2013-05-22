<?php
require('_inc/start.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Movie Reviews</title>
		<link href="_css/main.css" rel="stylesheet">
		<link rel="alternate" href="feed-rss.php" type="application/rss+xml" title="RSS feed for the latest movie reviews">
		<link rel="alternate" href="feed-atom.php" type="application/atom+xml" title="Atom feed for the latest movie reviews">
	</head>
	<body>
<?php
/*
Op deze pagina worden de laatste 5 reviews getoond, met telkens een link naar de detailpagina voor die review, alsook een link die rechtstreeks naar de commentaar-sectie verwijst.
*/
?>
lallaaa

	<div id="page-wrapper" class="page">
		<!--START HEADER -->
		<div id="header-wrapper">
			<header id="header" class="">
				<hgroup id="header-logo">
					<h1>
						<a href="index.php" title="MovieStar">
							<img src="" alt="Logo MovieStar"/>
						</a>
					</h1>	
					<h2>MovieStar</h2>
				</hgroup>
				<nav id="courtesey">
					<ul>
						<li>login</li>
						<li>logout</li>
						<li>register</li>
					</ul>
				</nav>
			</header>
			<section id="main-navigation-wrapper">
				<nav id="main-navigation">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="movies.php">Movies</a></li>
					</ul>
				</nav>
			</section>
		</div>
		
		<!--START MAIN CONTENT -->
		<div id="main-wrapper">
			<!-- laatste 5 reviews, met verkorte weergave

				-titel film (ook link naar film)
				-rev date
				-reviewer name
				-link naar film
				-link naar alle comments

				<article>
					<h1></h1> 


					
				</article>


			-->
		</div>

		<!--START FOOTER -->
		<div id="footer-wrapper">

		</div>
	</div>
	<!-- Back to top -->
	<a href="#" class="scrolltotop"></a>

	<!-- LIB SCRIPTS -->


	<!-- EIGEN SCRIPT -->
	<script src="_scripts/mylibs/default.js"></script>
	</body>
</html>
