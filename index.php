<?php
include('_inc/start.php');
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

	<div id="page-wrapper" class="page">
		<!--START HEADER -->
		<div id="header-wrapper">
			<header id="header" class="">
				<hgroup id="header-group">
					<h1>
						<a href="index.php" title="MovieStar">
							<img src="./_css/img/siteLogo.png" alt="Logo MovieStar" id="siteLogo"/>
						</a>
					</h1>	
					<h2>MovieStar</h2>
				</hgroup>
				<nav id="main-navigation">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="add-review.php">Add review</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</nav>
			</header>
		</div>
		<!-- START BANNER WRAPPER-->
		<div id="banner-wrapper">

		</div>
		
		<!--START MAIN CONTENT -->
		<div id="main-wrapper">
			<div id="content">
				<?php
					// SQL Query die een orvaging van de laatste 5 toegevoegde films.
					// via een inner join naar de reviewers tabel, kan de naam van de autheur ook opgevraagd worden.
					$sql = 'SELECT * FROM movies INNER JOIN reviewers ON movies.reviewerID = reviewers.reviewerID ORDER BY pubdate DESC LIMIT 0, 5';
					$result = $db->query($sql);
					while($row = $result->fetch_object()){
				?>
				
					<div class="review">
                         <h2 class="title">
                         	<a href="review.php?id=<?php echo $row->movieID; ?>"><?php echo htmlspecialchars($row->title)?></a>

                         </h2>

                         <p class="meta"><span class="date"><?php echo $row->pubdate; ?></span>
                         <span class="posted">Posted by <a href="#"><?php echo htmlspecialchars($row->name); ?></a></span></p>
                         <div style="clear: both;">&nbsp;</div>
                         <div class="entry">
                         <p><?php echo md(htmlspecialchars(substr($row->review,0))); ?></p>
          
                         <p class="links"><a href="review.php?id=<?php echo $row->movieID; ?>">Read More</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="post.php?id=<?php echo $row->movieID; ?>">Comments</a></p>
                         </div>
					</div>
				<?php } ?>
			</div>
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