<?php
$html .= '<h1>Speciale tekens</h1>';

$html .= '<p>Om speciale tekens goed weer te geven en op te slaan is het vaak nodig om tekens om te zetten van bijvoorbeeld
&#39;&euml;&#39; naar &#39;&ampeuml;&#39; omdat de tekens anders niet goed worden weergegeven of &#39;&lt;&#39; naar 
&#39;&amp;lt;&#39; omdat dit anders probleemen geeft doordat de HTML-code niet meer klopt.</p>

<p>Er zijn een aantal php functies die er mee te maken hebben: htmlentities, html_entity_decode, htmlspecialchars en 
htmlspecialchars_decode. Een overzichtje van welke functies wat doen:</p>';

/*
$html .= '<h2>htmlentities</h2>
<p>De php functie htmlentities($string, $flag, $charset) zorgt dat de tekens die met HTML te maken hebben worden omgezet naar
&#39;htmlentities&#39;, dit zodat deze tekens geen invloed meer hebben op de HTML-structuur waar het tussen wordt gezet.</p>

<h2>html_entity_decode</h2>
<h2>htmlspecialchars</h2>
<h2>htmlspecialchars_decode</h2>

<textarea class="code_php_only" cols="60" rows="10">
' . htmlentities("htmlentities('<\"')",ENT_QUOTES) . '
</textarea>
';
*/

?>