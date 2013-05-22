<?php
require('main.php');

/*
Dit PHP-script genereert een JSON/JSON-P-versie van de data die bij een review hoort.
Bvb. review-json.php?id=123 toont de data voor de review met reviewID = 123 uit de database in JSON-formaat.
Bvb. review-json.php?id=123&callback=myFunction toont de data voor de review met reviewID = 123 uit de database in JSON-P-formaat; de `callback` parameter uit de URL bepaalt de gebruikte functienaam.

Het gaat over volgende gegevens:

* volledige URL van de review in HTML-formaat
* titel van de film
* regisseur van de film
* naam van de auteur van de recensie
* de recensie zelf
* de rating van de film volgens de recensent (van 0 tot 5), weergegeven als nummer
* publicatiedatum van deze recensie als Unix-timestamp (zoek dit op!), in JSON weergegeven als string (!)
* de URL van de IMDb-pagina voor deze film

De gevraagde JSON-structuur ziet er als volgt uit:

    {
    	"url": "http://localhost/movie-reviews/review.php?id=123",
    	"title": "The Hobbit: An Unexpected Journey",
    	"director": "Peter Jackson",
    	"reviewer": "Mathias Bynens",
    	"review": "Lorem ipsum dolor sit amet...",
    	"rating": 5,
    	"pubDate": "1364902417",
    	"imdbURL": "http://www.imdb.com/title/tt0903624/"
    }

Overbodige witruimte in de uitvoer mag weggelaten worden.
*/

?>
