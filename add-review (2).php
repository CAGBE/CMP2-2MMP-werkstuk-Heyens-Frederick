<?php
require('main.php');

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
?>
