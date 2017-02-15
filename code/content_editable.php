<?php
$html .= '<h1>ContentEditable</h1>';

$html .= '<p>Het principe van content editable bestaat al sinds InternetExplorer 5.5. Heel nieuw is het dus niet. Het is bedoeld om 
ontwikkelaars de mogelijkheid te geven RichTextEditors te kunnen maken. Wel nieuw in HTML5 is dat dit nu op ieder element kan worden 
toegepast. Het werd enkel ondersteund op een heel document bijvoorbeeld via een i-frame.</p>

<p>Wanneer de tag &#39;contenteditable&#39; op een element zit en de waarde true heeft kan het worden gewijzigd. Eenvoudige 
bewerkingen als tikken van tekst en kopie&euml;ren en plakken werken dan al. maar verdere functies kunnen met Javascript worden 
toegevoegd.</p>

<textarea class="code_html" cols="60" rows="10">
' . htmlentities('<div contenteditable="true" id="editable">
	<h2>Dit voorbeeld is helemaal aan te passen</h2>
	<p>Dit paragraph element ook</p>
	<ol>
		<li>en deze opsomming</li>
		<li>ook...</li>
	</ol>
</div>') . '</textarea>

<div style="border: 1px solid #666;">
	<div contenteditable="true">
		<p>Dit voorbeeld is helemaal aan te passen</p>
		<p>Dit paragraph element ook</p>
		<ol>
			<li>en deze opsomming</li>
			<li>ook...</li>
		</ol>
	</div>
</div>
<p>In bovenstaand veldje kan nu de inhoud worden aangepast.</p>

<h2>Acties uitvoeren met de content</h2>

<p>Hieronder een formulier met diverse buttons en een stukje JavaScript dat kijkt welke waanden de betreffende button heeft 
om vervolgens dat comando met eventuele extra informatie uit te voeren.</p>

<textarea class="code_js" cols="60" rows="10">
' . htmlentities("var editor;
window.addEvent('domready', function() {
	var buttons = document.getElementById('testForm').getElementsByTagName('input');
	for (var i=0;i<buttons.length;i++) {
		if (buttons[i].type != 'button') continue;
		buttons[i].onclick = command;
	}
	editor = $('editor');
})
function command() {
	var inEditor = window.getSelection().getRangeAt(0).startContainer.parentNode.getParent('#editor');
	if(inEditor == null) { return false; }
	
	var cmd = this.id;
	var bool = false;
	var value = this.getAttribute('cmdValue') || null;
	if (value == 'promptUser')
		value = prompt(this.getAttribute('promptText'));
	document.execCommand(cmd,bool,value);
}") . '</textarea>

<div style="border: 1px solid #666;">
	<form id="testForm">
		<input type="button" id="undo" value="Undo">
		<input type="button" id="redo" value="Redo">
		<span class="separator">|</span>
		<input type="button" id="bold" value="Bold">
		<input type="button" id="italic" value="Italic">
		<input type="button" id="underline" value="Underline">
		<input type="button" id="strikethrough" value="&lt;s&gt;">
		<input type="button" prompttext="URL of link?" cmdvalue="promptUser" id="createLink" value="&lt;a&gt;">
		<input type="button" id="inserthorizontalrule" value="&lt;hr /&gt;">
		<input type="button" cmdvalue="pages/include/content_editable_demo/smiley_wink.png" id="insertimage" value="&lt;img /&gt;">
		<span class="separator">|</span>
		<input type="button" prompttext="color?" cmdvalue="promptUser" id="backcolor" value="bgcolor">
		<input type="button" prompttext="color?" cmdvalue="promptUser" id="forecolor" value="fgcolor">
		<input type="button" prompttext="color?" cmdvalue="promptUser" id="hilitecolor" value="hilite">
		<span class="separator">|</span>
		<input type="button" id="increasefontsize" value="A+">
		<input type="button" id="decreasefontsize" value="A-">
		<input type="button" prompttext="font name?" cmdvalue="promptUser" id="fontname" value="font-family">
		<input type="button" prompttext="font size?" cmdvalue="promptUser" id="FontSize" value="font-size">
		<input type="button" id="subscript" value="&lt;sub&gt;">
		<input type="button" id="superscript" value="&lt;sup&gt;">
		<span class="separator">|</span>
		<input type="button" id="justifyleft" value="left">
		<input type="button" id="justifyright" value="right">
		<input type="button" id="justifycenter" value="center">
		<input type="button" id="justifyfull" value="justify">
		<span class="separator">|</span>
		<input type="button" id="insertorderedlist" value="&lt;ol&gt;">
		<input type="button" id="insertunorderedlist" value="&lt;ul&gt;">
		<input type="button" id="insertparagraph" value="&lt;p&gt;">
		<input type="button" prompttext="Valid HTML snippet" cmdvalue="promptUser" id="inserthtml" value="html">
		<span class="separator">|</span>
		<input type="button" prompttext="Which block? (Header or paragraph)" cmdvalue="promptUser" id="formatblock" value="formatblock">
		<input type="button" prompttext="Which header?" cmdvalue="promptUser" id="heading" value="heading">
		<input type="button" id="indent" value="indent">
		<input type="button" id="outdent" value="outdent">
		<span class="separator">|</span>
		<input type="button" id="delete" value="del">
		<input type="button" id="unlink" value="unlink">
	</form>
	<div contenteditable="true" id="editor">
		<p>Dit voorbeeld is ook helemaal aan te passen een je kunt de knoppen hierboven gebruiken.</p>
		<p>Dit paragraph element ook</p>
		<ol>
			<li>en deze opsomming</li>
			<li>ook...</li>
		</ol>
	</div>
</div>
';

$jsFiles[] = 'pages/include/content_editable_demo/editor_buttons.js';

$html .= '
<p>Wat mij opviel is dat de execCommand functie alleen op het document gebruikt kan worden. Ik kon dus met bovenstaande knoppen ook 
wijzigingen aanbrengen in het eerder genoemde voorbeeld. Ik heb dit nu niet meer mogelijk gemaakt door de eerste twee regels van de 
functie command, hierin wordt gekeken waar de selectie is, en of die een onderdeel is van het element waarin ik wil dat de knoppen 
worden gebruikt.</p>

<h2>Acities voor de selectie</h2>
<p>Naast execCommand zijn er nog enkele andere functies die je ook nodig kan hebben als je specifieke dingen wilt maken.</p>

<p><strong>document.execCommand(commandIdentifier, userInterface, value)</strong></p>
<p>De ze functie gebruik je voor het uitvoeren van bewerkingen op de selectie. De commandIdentifier is bijvoorbeeld &#39;bold&#39; 
of &#39;italic&#39;, <a rel="external" href="https://developer.mozilla.org/en/Midas#Supported_Commands">een complete lijst is hier 
te vinden</a>.</p>

<p><strong>document.queryCommandEnabled(commandIdentifier)</strong></p>
<p>Deze functie geeft true of false terug als de betereffende bewerking respectievelijk wel of niet is toegestaan.</p>

<p><strong>document.queryCommandIndeterm(commandIdentifier)</strong></p>
<p>Deze functie geeft true terug als de betereffende eigenschap nog niet gedefinieerd is.</p>

<p><strong>document.queryCommandState(commandIdentifier)</strong></p>
<p>Deze functie geeft true of false terug als de betereffende bewerking wel of niet is toegepast op de selectie, let op dat de functie 
null teruggeeft wanneer de eigenschap nog niet is gedefinieerd. Zo kun je bijvoorbeeld kijken of de selectie al vet gedrukt is of niet.</p>

<p><strong>document.queryCommandValue(commandIdentifier)</strong></p>
<p>Deze functie geeft false terug als de betereffende eigenschap niet is toegepast op de selectie, anders geeft het de waarde terug. 
Bijvoorbeeld voor &#39;fontname&#39;, je kunt zo de waarde uitlezen.</p>

<p><strong>document.queryCommandSupported(commandIdentifier)</strong></p>
<p>Deze functie geeft true terug als actie wordt ondersteund op de huidige selectie.</p>

<p><strong>document.queryCommandText(commandIdentifier)</strong></p>
<p>Deze functie geeft een tekst terug die beschrijft wat er gebeurd in bij het betreffende commando. Deze werkt niet in Firefox.</p>

<p>Ook kun je de geselecteerde tekst opvragen met de volgende functie.</p>

<textarea class="code_js" cols="60" rows="10">
' . htmlentities('function GetSelectedText() {
	if(window.getSelection) { // all browsers, except IE before version 9
		var selRange = window.getSelection();
		alert(selRange.toString());
	} else {
		if(document.selection) { // Internet Explorer
			var textRange = document.selection.createRange();
			alert(textRange.text);
		}
	}
}') . '</textarea>
<p>Selecteer een gebied in dit document en druk op de button (de code zit in een iframe, dus dat werkt niet bij dit voorbeeld).</p>
<input type="button" id="alertSelection" value="alert selectie">

<p>Met deze functies kun je een redelijk uitgebreide editor maken voor bijvoorbeeld een CMS. Echter denk ik dat het zinvoller is om 
deze technieken zelf te gebruiken wanneer je niet al te veel mogelijkheden wilt bieden. Bijvoorbeeld voor een editor die alleen 
letters vet of schuingedrukt maakt. Voor meer geavanceerde functies kun je wat mij betreft beter een bestaande RichTextEditor 
gebruiken, deze hebben heel uitgebrijde mogelijkheden en zijn ook goed getest op diverse browsers, als je zelf wat gaat maken zal 
het nog een hele tijd duren voordat het dezelfde mogelijkheden en qualiteit bezit als de beschikbare editors. Hieronder vind je daarom 
ook een verwijzing naar een lijst met diverse editors.</p>


<h2>Bronnen</h2>

<p><a rel="external" href="http://html5demos.com/contenteditable">html5demos.com/contenteditable</a> 
Contenteditable demo.</p>
<p><a rel="external" href="http://www.quackit.com/html/codes/contenteditable.cfm">quackit.com/html/codes/contenteditable.cfm</a> 
Contenteditable demo en uitleg.</p>
<p><a rel="external" href="https://developer.mozilla.org/en/Rich-Text_Editing_in_Mozilla">developer.mozilla.org/en/Rich-Text_Editing_in_Mozilla</a> 
Verschillen van contentEditable tussen IE en Mozilla.</p>
<p><a rel="external" href="http://ajaxian.com/archives/richtexteditors-compared">ajaxian.com/archives/richtexteditors-compared</a> 
Voorbeelden van bestaande RichTextEditors.</p>
';

?>