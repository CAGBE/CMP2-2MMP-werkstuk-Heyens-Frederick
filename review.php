<?php
	include('_inc/start.php');

// Dit PHP-script genereert een HTML-pagina die een review weergeeft.
// Bvb. review.php?id=1 toont de review met reviewID = 1 uit de database.

	//Indien de variabele id bestaat:
	//Haalt de variabele id uit de hyperlink die is doorgestuurd vanuit de index.php pagina
	//De id wordt opgehaalt en direct bewaard als een integer
	if(!isset($id)) $id = (int) $_GET['id'];
	

	// id type casten zodat er geen queries via url kunnen worden ingegeven
	if($id == 0) die('ID moet numeriek zijn en groter dan 0');


	//SQL query om de gegevens op te halen van de film met het betreffende ID.
	$sql = 'SELECT * FROM movies INNER JOIN reviewers ON movies.reviewerID = reviewers.reviewerID WHERE movieID = ' . $id;
	$result = $db->query($sql);
	$row = $result->fetch_object();
	
	// 404 wanneer het id niet bestaat (goed voor SEO)
	if($result->num_rows == 0) {
		http_response_code(404); // header (moet boven doctype etc gedeclareerd worden)
		die('<h1>404</h1>'); // text op pagina
	}



	// bij verzenden van form komen we terug op deze pagina terecht, daarom check of post gebeurd is
	if(isset($_POST['action']) && $_POST['action'] == 'add_comment'){
		
		$reviewID = $_POST['id'];
		$author = $_POST['author'];
		$comment = $_POST['comment'];
		

		// insert niet uitvoeren als niet alle velden zijn ingevuld
		if(empty($author) || empty($comment)) die('Gelieve alle velden in te vullen');
	
		$sql = 'INSERT INTO comments (movieID, author, content, pubdate) VALUES (' . $reviewID . ', "'
																				  . $db->real_escape_string($author) . '", "' 
																				  . $db->real_escape_string($comment)
																	  				. '", NOW()
																				  )';
		if(!$db->query($sql)){
			die('Commentaar opslaan in database mislukt.');
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Movie Reviews</title>

		<link href="_css/main.css" rel="stylesheet">
		<!-- Vervang op de volgende twee regels `123` door de huidige review ID. -->
		<link rel="alternate" href="review-json.php?id=123" type="application/json" title="JSON version of the data for this movie/review">
		<link rel="alternate" href="review-json.php?id=123&amp;callback=foo" type="application/javascript" title="JSON-P version of the data for this movie/review">
	</head>
	<body>
<?php
/*
Op deze pagina wordt alle informatie over een specifieke review/recensie weergegeven:

* titel van de film (ok)
* regisseur van de film (ok)
* naam van de auteur van de recensie (ok)
* de recensie zelf (ok)
* de rating van de film volgens de recensent (van 0 tot 5), weergegeven d.m.v. sterretjes (via CSS) (ok maar via een loop)
* publicatiedatum van deze recensie (ok)
* link naar de IMDb-pagina voor deze film (ok)

Daaronder worden alle commentaren voor deze film/review getoond, met telkens de volgende informatie:

* naam van de auteur van de reactie (ok)
* de reactie zelf (ok)
* de datum waarop de reactie werd geplaatst (ok)

Daaronder bevindt zich een formulier waar bezoekers van de website reacties kunnen nalaten. Hiertoe moeten ze enkel hun naam en de reactie zelf ingeven. Toon een foutmelding indien een van deze velden niet werd ingevuld. (ok, maar staat erboven)
*/?>	<div id="page-wrapper" class="page">
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
						<li><a href="add-review.php">Movies</a></li>
					</ul>
				</nav>
				<nav id="courtesey">
					<ul>
						<li>login</li>
						<li>logout</li>
						<li>register</li>
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
					$sql = 'SELECT * FROM movies INNER JOIN reviewers ON movies.reviewerID = reviewers.reviewerID WHERE movieID = ' . $id;
					$result = $db->query($sql);
					while($row = $result->fetch_object()){

				?>
				
					<div class="review">
                         <h2 class="title">
                         	<a href="review.php?id=<?php echo $row->movieID; ?>"><?php echo htmlspecialchars($row->title)?></a>
                         	<span class="rating">
                         		<?php
                          			$aantal = (int)($row->rating);
                         			for($i=0; $i<$aantal; $i++)
                         			{
                         				echo "<img alt='star-rating' class='star-rating' src='./_css/img/star.png'/>";
                         			}
                         		?>

                       		</span>
                         </h2>
                         <div class="author"><h3>A movie by: <?php echo htmlspecialchars($row->director) ?></h3></div>
                         <p class="meta"><span class="date"><?php echo $row->pubdate; ?></span>
                         <span class="posted">Posted by <a href="#"><?php echo htmlspecialchars($row->name); ?></a></span></p>
                         <div style="clear: both;">&nbsp;</div>
                         
                         <div class="entry">
                         	<p><?php echo md(htmlspecialchars(substr($row->review,0))); ?></p>
                         </div>
                         <div class="imdb"><a href="<?php echo htmlspecialchars($row->imdbURL); ?>">Bekijken via IMDB</a>
                         	&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                         	<a href="<?php echo htmlspecialchars($row->imdbURL); ?>">Bekijk via JSON</a></div>
					</div>



				<?php } ?>

					<div class="comments">
						<div id="comments-header">
							<h2>Add your comment</h2>
						</div>
						<div id="add-comments">	
                        		<form id="commentform" action="review.php?id=<?php echo $id; ?>" method="post">
                        			<input type="hidden" name="action" value="add_comment">
                        			<input type="hidden" name="id" value="<?php echo $id; ?>">
                        			<p>
                                    	<input type="text" id="author" name="author" placeholder="Name..." required/>
                                	</p>
                        			<p>
                                    	<textarea id="comment" name="comment" placeholder="Your message..." required></textarea>
                                	</p>
                        			<p>
                                    	<input name="submit" type="submit" id="submit" value="Submit Comment" />
                                    </p>
                        		</form>
						</div>
						<div id="wrapper-comments">
							<div id="wrapper-comments-header">
								<!-- Geeft weer hoeveel comments er al geplaatst zijn -->
								<h2>Comments (<?php echo $result->num_rows; ?>)</h2>
							</div>
							<?php
								//SQL Query die alle comments opvraagt van de betreffende film.
                    			$sql = 'SELECT * FROM comments WHERE movieID = ' . $id;
                    			$result = $db->query($sql);
                    			
                    			//Indien er nog geen comments zijn verschijnt volgende boodschap.
                    			if($result->num_rows == 0) {
                    				echo '<div class="comment"><p>No comments yet.</p></div>';
                    			}else{
                    				//Indien er wel comments zijn vraagt hij alle resultaten op
	                    			while($row = $result->fetch_object()){
                    		?>

                    		<!-- COMMENT SECTION -->
                    		<div class="comment">
                         		<p class="meta2">
                         			<span class="posted"><cite><?php echo htmlspecialchars($row->author); ?></cite> says:</span>
                         			<span class="date"><?php echo $row->pubdate; ?></span>
                            	</p>
                         		<div style="clear: both;">&nbsp;</div>
                         		<div class="entry2">
                         			<p><?php echo md(htmlspecialchars($row->content)); ?></p>
                         		</div>
                           		<hr />
                         	</div>				
                         	
                         	<?php } } ?>
						</div>
					</div>
			</div>
		</div>

		<!--START FOOTER -->
		<div id="footer-wrapper">
			<p>Copyright &copy; 2013 - Arteveldehogeschool - Crossmedia Publishing II - By Frederick Heyens</p>

		</div>
	</div>
	<!-- Back to top -->
	<a href="#" class="scrolltotop"></a>

	<!-- LIB SCRIPTS -->


	<!-- EIGEN SCRIPT -->
	<script src="_scripts/mylibs/default.js"></script>
			</body>
</html>
