
<?php

	$error = "";
	$feedback = "";
/*

Als de gebruiker niet is ingelogd:

	Toon een formulier waar de gebruiker zijn e-mailadres en wachtwoord kan ingeven om in te loggen.
	Toon een foutmelding indien de gebruiker het formulier verstuurt met een foutief e-mailadres/wachtwoord ingevuld.

Als de gebruiker wel is ingelogd:

	Toon een formulier waar de gebruiker een nieuwe recensie kan toevoegen. De gebruiker moet volgende informatie kunnen ingeven:

	* titel van de film
	* regisseur van de film
	* de recensie zelf (in Markdown)
	* de rating van de film volgens de recensent (van 0 tot 5)
	* link naar de IMDb-pagina voor deze film

	Zorg voor een gebruikersvriendelijke interface.

	Wanneer het formulier wordt verzonden:

		Controleer je of alle velden correct werden ingevuld (bvb. is `rating` wel een getal van 0 tot 5?). Indien niet, toon je het formulier met de ingegeven informatie + een foutmelding naast het desbetreffende veld.

		Indien alle velden correct werden ingevuld, wordt de ingegeven data naar de database weggeschreven. Vergeet hierbij volgende gegevens niet (de gebruiker geeft deze immers niet manueel in):

		* naam van de auteur van de recensie (m.a.w. de volledige naam van de ingelogde gebruiker)
		* publicatiedatum van deze recensie (m.a.w. het huidige tijdstip op het moment van toevoeging)

*/
	include('_inc/start.php');
	//-------------- LOGIN USER//


	if(isset($_POST['action']) && $_POST['action'] == 'Login_user'){
		//Variabele wordt terug leeggemaakt (zo worden vorige foutboodschappen niet meer getoond.)
		$error = "";

		//Variabelen die aangemaakt worden om de data uit het formulier te bewaren.
		$loginAuthor = $_POST['login-author'];
		$loginPWD = $_POST['login-pwd'];

		
		// insert niet uitvoeren als niet alle velden zijn ingevuld
		if(empty($loginAuthor) || empty($loginPWD)) die($error = 'Gelieve alle velden in te vullen');
	

		$sql = 'SELECT * FROM reviewers WHERE email = "' . $loginAuthor . '" AND passwordHash = "' . md5($loginPWD) . '"';
		$result = $db->query($sql);
		$loginqry = $result->fetch_object();
	
	
		//Indien er geen overeenkomsten zijn terug gevonden dan wordt voglende error weergegeven.
		if($result->num_rows == 0) {
			//Deze error verschijnt in het Form om in te loggen.
			$error = "Uw wachtwoord en email zijn foutief"; // text op pagina
		}
		//Indien beide overeen komen dan worden de Id en name uit de database gehaald en opgeslagen in sessions
		else{
			$_SESSION['userId'] = $loginqry->reviewerID;
			$_SESSION['userName'] = $loginqry->name;
			echo "session gelukt";
		}



	}
	

	//--------------AANMAKEN NIEUWE REVIEW//
	// bij verzenden van form komen we terug op deze pagina terecht, daarom check of post gebeurd is
	if(isset($_POST['action']) && $_POST['action'] == 'add_movie'){
		//Variabelen die aangemaakt worden om de data uit het formulier te bewaren.
		$addmovieTitle = $_POST['addmovie-title'];
		$addmovieDirector = $_POST['addmovie-director'];
		$addmovieRating = $_POST['addmovie-rating'];
		$addmovieReview = $_POST['addmovie-review'];
		$addmovieIMDB = $_POST['addmovie-IMDB'];
		

		// insert niet uitvoeren als niet alle velden zijn ingevuld
		if(empty($addmovieTitle) || empty($addmovieDirector) || empty($addmovieReview)) die('Gelieve alle velden in te vullen');
	
		$sql = 'INSERT INTO movies (title, director, reviewerID, review, rating, pubdate, updated, imdbURL) VALUES ("' . $db->real_escape_string($addmovieTitle) . '", "'
																				  . $db->real_escape_string($addmovieDirector) . '", '
																				  . (int) isset($_SESSION['userId']) . ', "'
																				  . $db->real_escape_string($addmovieReview) . '", "'
																				  . $db->real_escape_string($addmovieReview) 
																				   . '", NOW() , NOW(), "' . $db->real_escape_string($addmovieIMDB) . '")';
		if(!$db->query($sql)){
			$feedback ='Commentaar opslaan in database mislukt.';
		}
		else{
			$feedback ='Comment has been added';
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
			</header>
		</div>
		<!-- START BANNER WRAPPER-->
		<div id="banner-wrapper">

		</div>
		
		<!--START MAIN CONTENT -->
		<div id="main-wrapper">
		<?php if(!isset($_SESSION['userId'])){ ?>
			<div id="login-wrapper">
				<div id="login-header">
					<h2>Login</h2>
				</div>
				<form id="login-form" action="add-review.php" method="post">
					<div><?php echo $error ?></div>
	      			<input type="hidden" name="action" value="Login_user">
	      			<p>
	      				<input type="text" id="login-author" name="login-author" placeholder="E-mail..." required/>
	      			</p>
	         		<p>
	            		<input type="text" id="login-pwd" name="login-pwd" placeholder="Password..." required/>
	             	</p>
	                <p>
	                    <input name="login-submit" type="submit" id="login-submit" value="Login" />
	                </p>
	            </form>
			</div>
		<?php } else { ?>
			<div id="addreview-wrapper">
				<div id="addreview-header">
					<h2>Add a movie review</h2>
				</div>
				
				<form id="addreview-form" action="add-review.php" method="post">
	      			<div><?php echo $feedback ?></div>
	      			<input type="hidden" name="action" value="add_movie">

	      			<p>
	      				<input type="text" id="addmovie-title" name="addmovie-title" placeholder="Movie title..." required/>
	      			</p>
	         		<p>
	            		<input type="text" id="addmovie-director" name="addmovie-director" placeholder="Movie director..." required/>
	             	</p>
	               	<p>
                        <textarea id="addmovie-review" name="addmovie-review" placeholder="Review..." required></textarea>
                    </p>
	               	<p>
	            		<select id="addmovie-rating" name="addmovie-rating">
						  	<option value="5">Rating: 5</option>
						  	<option value="4">Rating: 4</option>
						  	<option value="3">Rating: 3</option>
						  	<option value="2">Rating: 2</option>
						  	<option value="1">Rating: 1</option>
						  	<option value="0">Rating: 0</option>
						</select>
	             	</p>
	             	<p>
	            		<input type="text" id="addmovie-IMDB" name="addmovie-IMDB" placeholder="Url IMDB..." required/>
	             	</p> 
	             	<p>
	                    <input name="addmovie-submit" type="submit" id="addmovie-submit" value="Submit" />
	                </p>
	            </form>
			</div>
			<?php } ?>
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