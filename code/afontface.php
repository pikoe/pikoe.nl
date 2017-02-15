<?php

$html .= '<h1>@FontFace</h1>';

$html .= '
<p>FontFace is een techniek om bijzondere lettertypes weer te geven in webpagin&#39;s. Hierdoor hoeven niet alle 
kopjes en teksten die in een speciaal font weergegeven moeten worden als afbeeldingen worden weergegeven.</p>
<p>Daarnaast kan FontFace gebruikt worden om zeker te weten dat bezoekers ook het lettertype te zien krijgen 
dat de bedoeling is. Meestal wordt op websites een font-family opgegeven in het stylesheet, is de eerste daarvan 
niet beschikbaar voor de betreffende browser dan wordt gekeken of de volgende misschien kan worden gebruikt,
dat hoeft met @font-face dus niet. Wel moeten voor verschillende browsers verschillende lettertype-formats worden 
gebruikt. InternetExplorer gebruikt bijvoorbeeld (vanaf IE5.5!) eot, woff wordt ondersteund door FireFox, Chrome 
en IE9. Chrome, FireFox, Opera en Safari ondersteunen ttf en Chrome, Opera en Safari ondersteunen ook svg.</p>

<textarea class="code_css" cols="60" rows="10">
' . htmlentities("@font-face {
    font-family: 'Naam van het lettertype';
    src: local('Naam van het lettertype'),
         url('locatie_van_het_lettertype.eot?') format('eot'),
         url('locatie_van_het_lettertype.woff') format('woff'),
         url('locatie_van_het_lettertype.ttf') format('truetype');
    font-style: normal;
    font-weight: normal;
}") . '</textarea>

<p>De naam van het lettertype local kan ook vervangen worden door ☺: een smiley. Dit zorgt er voor dat er geen font 
met dezelfde naam wordt ingeladen die al op de pc beschikbaar is.<br />
Android kan echter de &#39;local()&#39; descriptor niet lezen en stopt de hele @font-face declaratie, er zal dus geen 
webfont geladen worden.<br />
Omdat er een groot aantal gebruikers is dat Android gebruikt en dit ook nog steeds groeid is het aan te raden hier 
rekening mee te houden en de local niet meer te gebruiken.</p>

<textarea class="code_css" cols="60" rows="10">
' . htmlentities("@font-face {
    font-family: 'StMarieThin';
    src: url('StMarie-Thin-webfont.eot');
    src: url('StMarie-Thin-webfont.eot?#iefix') format('embedded-opentype'),
         url('StMarie-Thin-webfont.woff') format('woff'),
         url('StMarie-Thin-webfont.ttf') format('truetype'),
         url('StMarie-Thin-webfont.svg#StMarieThin') format('svg');
    font-weight: normal;
    font-style: normal;
}") . '</textarea>

<p>Nadat bovenstaande code in de stylesheet is opgenomen kan de betreffende font met de opgegeven naam, stijl (cursief 
of niet) en dikte worden gebruikt zoals regulire lettertypen.</p>

<h2>Lettertypen uitzoeken</h2>
<p>Zoals je misschien weet is het niet toegestaan zomaar alle lettertypen die je tegenkomt te gebruikten. Je zult dan 
in sommige gevallen een lisentie nodig hebben.<br />
Maar om het makkelijk te maken zijn er een aantal websites waar je je daarover geen zorgen hoeft te maken en ze helpen 
je ook nog met de implementatie!</p>
<p><a rel="external" href="http://www.google.com/webfonts">Google web fonts</a> is hier een voorbeeld van, je kunt zoeken 
op verschillende eigenschappen en het enige wat je hoeft te doen is een css-link in de head van je HTML bestand toe 
voegen. De api bied vervolgens het juiste format font aan die de betreffende browser ondersteund.</p>

<textarea class="code_html" cols="60" rows="10">
' . htmlentities('<link href="http://fonts.googleapis.com/css?family=Volkhov" rel="stylesheet" type="text/css" />')
 . '</textarea>

<p><a rel="external" href="http://www.fontsquirrel.com/">Fontsquirrel</a> heeft nog meer fonts die je kunt gebruiken. Ze 
bieden hier de mogelijkheid voor het downloaden van een &#39;@font-face Kit&#39;, een zip-mapje met daarin de gecelecteerde 
bestands-typen van het lettertype, een voorbeeld CSS en een demo HTML-bestand.</p>

<p>En natuurlijk zijn er versprijd over het web nog veel meer fonts te vinden die je kunt gebruiken, als je even zoekt vind 
je van alles: <a rel="external" href="http://www.google.nl/search?q=font-face+fonts">font-face fonts op Google</a>.</p>

<h2>Demo</h2>
<p>Tot slot een kleine demo, al is niet erg spannend wat er gebeurd:</p>
<p style="font-family: \'Leckerli One\',cursive;">Leckerli One; via Google web fonts.</p>
<p style="font-family: \'StMarieThin\',cursive;">St Marie; van Font Squirrel.</p>
';
$cssFiles[] = 'pages/include/font-face_demo/stylesheet.css';

$html .= '<h2>Bronnen</h2>
<p><a rel="external" href="http://www.font-face.com/">font-face.com</a> Beknopte uitleg over @FontFace.</p>
<p><a rel="external" href="http://webfonts.info/wiki/index.php?title=@font-face_browser_support">webfonts.info/wiki/index.php?title=@font-face_browser_support</a> 
Ondersteuning van verschillende lettertype-formats.</p>
<p><a rel="external" href="http://paulirish.com/2009/bulletproof-font-face-implementation-syntax">paulirish.com/2009/bulletproof-font-face-implementation-syntax</a> 
uitleg over de keuze van de volgorde van de verschillende formats.</p>
<p><a rel="external" href="http://readableweb.com/best-practice-for-font-face-css-takes-a-turn/">readableweb.com/best-practice-for-font-face-css-takes-a-turn</a> 
Uiltleg &#39;local()&#39;-probleem in Android.</p>
<p><a rel="external" href="http://www.google.com/webfonts#AboutPlace:about">google.com/webfonts#AboutPlace:about</a> 
over Google web fonts.</p>
';

?>