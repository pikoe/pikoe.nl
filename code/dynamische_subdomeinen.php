<?php
$html .= '<h1>Dynamische subdomeinen</h1>';

$html .= '<p>Ik heb voor deze website gekeken of ik naast gewone subdomeinen aan te maken in cPanal dat ook dinamysch kon krijgen.<br />
Ik heb daarvoor in cPanel aangegeven dat &#39;*.pikoe.nl&#39; naar de map /public_html wordt doorgestuurd. Daat staat het volgende 
.htaccess bestand:</p>

<pre>RewriteEngine On

# www.domein.ext -> domein.ext 301 move permanent
RewriteCond %{HTTP_HOST} ^www\.([^\.]+\.[^\.0-9]+)$
RewriteCond %{REQUEST_URI} !^/robots\.txt$ [NC]
RewriteRule ^(.*)$ http://%1/$1 [R=301,L]

# subdomeinen naar de betreffende map
RewriteCond %{HTTP_HOST} ^([^\.]+)\.([^\.]+\.[^\.0-9]+)$
RewriteCond %{DOCUMENT_ROOT}/%1 -d
RewriteRule ^(.*)$ %1/$1 [QSA,L]

# geen subdomein, dan naar map www
RewriteCond %{HTTP_HOST} !^([^\.]+)\.([^\.]+\.[^\.0-9]+)$
RewriteRule ^(.*)$ www/$1 [QSA,L]

# anders
RewriteCond %{HTTP_HOST} ^.*$
RewriteRule ^(.*)$ index.php [QSA,L]</pre>

<p>Ik stuur in de eerste plaats www.pikoe.nl/... door naar datzelfde adres zonder www ervoor. Dit heeft zorgt dat je website altijd 
vanaf die plek wordt bekeken en er ook altijd naar dezelfde plek zal worden verwezen, en dat is weer goed voor de resultaten in 
zoekmachines, maar dat staat verder los van dit artikel.</p>
<p>In het tweede blokje stuur ik op de server de subdomeinen met de een bepaalde naam naar de map in /public_html. Dit gebeurt alleen 
als het subdomein ook een mapnaam is, -d wil zeggen &#39;is directory&#39;.</p>
<p>De &#39;%1&#39; verwijst naar de match in de conditie, de &#39;$1&#39; verwijst naar het gedeelte van de URL na de extentie, de 
match in de regel.</p>
<p>De &#39;Flag&#39; QSA (query string append) zorcht ervoor dat de post informatie ook mee komt.</p>
<p>Het blokje daarna dient ervoor om de pagina&#39;s zonder subsomein op de server door te verwijzen naar de map www.</p>
<p>Als aan geen van de voorwaarden is voldaan ga ik naar index.php dat in dezelfde map staat als dit .htaccess bestand. Dit zal dus
gebeuren als een subdomein is gekozen dat niet overeenkomt met een bepaalde map.</p>

<p>Omdat nu enkel doorverwezen wordt naar de map zal er in de betreffende mappen moeten worden aangegeven wat het index bestand is. 
Hiervoor zet ik in de mapjes het volgende:</p>

<pre>RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_URI} ^/(/$)?
RewriteRule ^(.*)$ index.php [QSA,L]</pre>

<p>Hierbij kijk ik eerst of er geen bestaand bestand is waarnaar verwezen wordt en daarna stuur ik alles naar index.php, dit kan 
natuurlijk ook een ander bestand zijn (index.html), maar in mijn index.php kijk met php of de url naar een pagina verwijst en zie je 
dus niet altijd de zelfde content via dit bestand.</p>

<h2>Bronnen</h2>

<p><a rel="external" href="http://keyboarddance.wordpress.com/2007/09/28/dynamic-subdomains-using-htaccess/">keyboarddance.wordpress.com/2007/09/28/dynamic-subdomains-using-htaccess/</a> 
Contenteditable demo.</p>
';

?>