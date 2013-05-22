<?php
require('main.php');

// Dit PHP-script genereert een HTML-pagina die een review weergeeft.
// Bvb. review.php?id=1 toont de review met reviewID = 1 uit de database.
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

* titel van de film
* regisseur van de film
* naam van de auteur van de recensie
* de recensie zelf
* de rating van de film volgens de recensent (van 0 tot 5), weergegeven d.m.v. sterretjes (via CSS)
* publicatiedatum van deze recensie
* link naar de IMDb-pagina voor deze film

Daaronder worden alle commentaren voor deze film/review getoond, met telkens de volgende informatie:

* naam van de auteur van de reactie
* de reactie zelf
* de datum waarop de reactie werd geplaatst

Daaronder bevindt zich een formulier waar bezoekers van de website reacties kunnen nalaten. Hiertoe moeten ze enkel hun naam en de reactie zelf ingeven. Toon een foutmelding indien een van deze velden niet werd ingevuld.
*/
?>
	</body>
</html>
