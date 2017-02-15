<?php

$html .= '<h1>CSS3 Buttons</h1>';

$html .= '<p>Er zijn in CSS3 een aantal nieuwe eigenschappen bij gekomen die we aan een element kunnen toekennen. Deze zijn 
erg bruikbaar wanneer je specale buttons wil maken, je hoeft nu niet meer een speciale achtergrond te maken wat altijd weer 
problemen geeft wanneer je er een te lange tekst in zet. Daarnaast is het natuurlijk erg fijn dat je dit voor alle buttons 
met een bepaalde stijl op &eacute;&eacute;n plek hebt beschreven en ook gemakkelijk aan kunt passen</p>

<h2>De nieuwe eigenschappen</h2>
<p>Zoals gezegt zijn er een aantal nieuwe eigenschappen die samen een heleboel extra mogelijkheden geven. Hier een opsomming.</p>
<p><strong>text-shadow</strong></p>
<p>x-offset y-offset blur color; De tekst kan ook meerdere schaduwen hebben hiervoor herhaal je de waarden gescheiden door een 
komma.</p>
<p><strong>box-shadow</strong></p>
<p>x-offset y-offset blur spread color (inset); Voor de box-shadow geld ook dat meerdere schaduwen op &eacute;&eacute;n element 
kunnen zitten. Ook kan de schaduw aan de binnenkant worden toegepast, hiervoor zet je het woordje &#39;inset&#39; bij de reeks 
waarden.</p>
<p><strong>border-radius</strong></p>
<p>top-left top-right bottom-right bottom-left / (top-left top-right bottom-right bottom-left); De eerste waarden geven de grootte 
van de hoek aan in px, em of %. Zijn de tweede serie waarden ook ingevuld dan geven de eerste de hoogte van de hoek aan en de 
tweede de breedte.</p>
<p><strong>background gradient</strong></p>

<textarea class="code_css" cols="60" rows="10">
' . htmlentities("background: rgb(254,252,234); /* Old browsers */
background: -moz-linear-gradient(top, rgba(254,252,234,1) 0%, rgba(241,218,54,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(254,252,234,1)), color-stop(100%,rgba(241,218,54,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(254,252,234,1) 0%,rgba(241,218,54,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(254,252,234,1) 0%,rgba(241,218,54,1) 100%); /* Opera11.10+ */
background: -ms-linear-gradient(top, rgba(254,252,234,1) 0%,rgba(241,218,54,1) 100%); /* IE10+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefcea', endColorstr='#f1da36',GradientType=0 ); /* IE6-9 */
background: linear-gradient(top, rgba(254,252,234,1) 0%,rgba(241,218,54,1) 100%); /* W3C */") . '</textarea>
<p>Bij de shadow en radius is heeft de waarde in de verschillende browsers dezelfde vorm, je kunt dus de eigenschap herhalen met 
voorvoegsel -moz- of -webkit-. Bij de background gradient is dat iest anders zoals je ziet. Ook kun je in tot InternetExplorer 10 
slechts een start en een eindkleur opgeven, geen extra stops.<br />
Let hier op de volgorde van de waarden, zoals bij alle eigenschappen wordt steeds de vorige opgegeven waarde overschreven. De 
laatste waarde is dan ook de W3C stadaard, wanneer die wordt ondersteund zal die dus ook gebruikt worden, is dat niet het geval 
dan de eerste daarvoor - met het browserspecifieke voorvoegsel - en wordt er niets ondersteund dan wordt een egale kleur gebruikt.</p>

<p><strong>rgba colors</strong></p>
<p>rgba(0-255, 0-255, 0-255, 0-1); Naast rood groen en blauw kunnen kleuren nu ook een alpha waarde krijgen, hiermee kan met een 
decimaal worden aangegeven of de kleur volledig transparant (0) is tot volledig ondoorzichtig (1). Dit kan op alles worden toegepast 
waar kleuren worden gebruikt. Daarnaast zijn ook hsl en hsla nieuwe manieren om een kleur te defini&euml;ren, daarbij is Hue in graden (0-360) 
waarbij geen eenheid wordt geplaatst en zijn Saturation en Lightness in procenten, alpha gaat op de zelfde manier als bij rgba.</p>

<h2>Buttons maken</h2>
<p>Met deze nieuwe eigenschappen kun je samen met de bestaande border- en font-eigenschappen hele mooie buttons maken. Maar er zijn 
op internet ook handige tooltjes te vinden die je daarbij helpen.</p>

<p>
<a rel="external" href="http://css3buttongenerator.com/">css3buttongenerator.com</a>
</p>
<p>
<a rel="external" href="http://css-tricks.com/examples/ButtonMaker/">css-tricks.com/examples/ButtonMaker</a>
</p>
<p>
<a rel="external" href="http://css3buttoncreator.com/">css3buttoncreator.com</a>
</p>


<h2>Bronnen</h2>

<p><a rel="external" href="http://coding.smashingmagazine.com/wp-content/uploads/images/css3-cheat-sheet/css3-cheat-sheet.pdf">coding.smashingmagazine.com/wp-content/uploads/images/css3-cheat-sheet/css3-cheat-sheet.pdf</a> 
Alle eigenschappen in CSS3.</p>
<p><a rel="external" href="http://www.w3schools.com/cssref/css3_pr_box-shadow.asp">w3schools.com/cssref/css3_pr_box-shadow.asp</a> 
Box-shadow beschrijving.</p>
<p><a rel="external" href="http://www.colorzilla.com/gradient-editor/">colorzilla.com/gradient-editor/</a> Handige pagina waar je 
eenvoudig (als in PhotoShop) een kleur verloop kunt maken.</p>
';

?>