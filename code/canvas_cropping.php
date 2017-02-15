<?php

$html .= '<h1>Croptool met canvas</h1>';

$html .= '
<p>Met het canvas element kunnen verschillede dingen met beel dedaan worden in de browser, afbeeldingen kunnen worden 
vervormd en versneden en er kunnen lijnen en vormen getekend worden.<br />
Het canvas element is nieuw in HTML5. Dat betekend ook dat het dus op dit moment nog niet door alle browsers wordt 
ondersteund.</p>

<p>Hieronder het stukje code dat de plaast aangeeft waar het element in het HTML-document moet komen. Deze kan nu qua 
positionering hetzelfde worden behandeld als een &#39;div&#39; element.<br />
Zoals je ziet is het element leeg, er staat niets in beschreven over afbeeldingen of vormen. Dat klopt want deze kunnen 
er nu na het laden van de pagina (of in ieder geval dit element) met JavaScript in worden gezet. Dat is ook het grote 
voordeel van het canvaselement, anders zou je ook een gewone afbeelding kunnen gebruiken.</p>

<textarea class="code_html" cols="60" rows="10">
' . htmlentities('<canvas id="voorbeeldCanvas" width="40" height="30"></canvas>') . '</textarea>

<p>Je ziet dat ik in het element de breedte en hoogte heb aangegeven. Normaal zou je juist dit soort informatie in de CSS 
zetten maar waar ik achter kwam is dat het element dan een standaard afmeting krijgt (in FireFox ten minsten) en vervolgens 
wordt opgerekt tot de maten die in het css bestand staan. Je kunt er ook voor kiezen om in je JavaScript aan te geven wat 
de maten moeten worden, maar dat zorgt ervoor dat de browser opnieuw de indeling van de elementen moet bepalen.</p>

<h2>Vormen tekenen</h2>
<p>Nu kan dus door middel van een stukje JavaScript de inhoud van dit element worden bepaald. Hier een voorbeeld van een 
rechthoek met afgeronde hoeken die ik later nog weer gebruik.</p>

<textarea class="code_js" cols="60" rows="10">
' . htmlentities("var ctx = $('voorbeeldCanvas').getContext('2d');
var x = 10, y = 20, r = 5, w = 8;
ctx.fillStyle = 'rgba(0, 0, 0, .8)';
ctx.beginPath();
ctx.moveTo(x-w+r, y-w);
ctx.lineTo(x+w-r, y-w);
ctx.quadraticCurveTo(x+w, y-w, x+w, y-w+r);
ctx.lineTo(x+w, y+w-r);
ctx.quadraticCurveTo(x+w, y+w, x+w-r, y+w);
ctx.lineTo(x-w+r, y+w);
ctx.quadraticCurveTo(x-w, y+w, x-w, y+w-r);
ctx.lineTo(x-w, y-w+r);
ctx.quadraticCurveTo(x-w, y-w, x-w+r, y-w);
ctx.fill();") . '</textarea>

<p>Het resultaat is nu onderstaand blokje.</p>
<canvas id="voorbeeldCanvas" width="40" height="30" class="demo_canvas"></canvas>
';

$jsFiles[] = 'pages/include/canvas_demo/voorbeeldCanvas.js';

$html .= '
<p>Let dus wel op dat dit het stukje code wordt aangeroepen na het element, ik heb 
het geplaast bij het domready-event van MooTools.</p>

<h2>Interactie</h2>
<p>Nu kunnen we een stukje interactie toevoegen. Het is helaas niet zo dat we nu op de getekende vorm een onclick event kunnen 
toepassen zoals bijvoorbeeld bij flash, om iets dergelijks te berijken zul je moeten berekenen of de muis zich bevind op de 
plek waar je de vorm hebt getekend.<br />
Daarnaast kun je ook niet met lagen werken binnen &eacute;&eacute;n canvas element, wel kun je werken met lagen door meerdere 
canvas elementen over elkaar heen te leggen.</p>

<p>Het HTML-element:</p>
<textarea class="code_html" cols="60" rows="10">
' . htmlentities('<canvas id="actieCanvas" width="500" height="400"></canvas>') . '</textarea>

<p>De JavaScript code om een blokje te tekenen op de plek van de muis:</p>
<textarea class="code_js" cols="60" rows="10">
' . htmlentities("function handle(canvas, x, y) {
	var ctx = canvas.getContext('2d');
	var r = 3, w = 4;
	ctx.fillStyle = 'rgba(0, 0, 0, .4)';
	ctx.beginPath();
	ctx.moveTo(x-w+r, y-w);
	ctx.lineTo(x+w-r, y-w);
	ctx.quadraticCurveTo(x+w, y-w, x+w, y-w+r);
	ctx.lineTo(x+w, y+w-r);
	ctx.quadraticCurveTo(x+w, y+w, x+w-r, y+w);
	ctx.lineTo(x-w+r, y+w);
	ctx.quadraticCurveTo(x-w, y+w, x-w, y+w-r);
	ctx.lineTo(x-w, y-w+r);
	ctx.quadraticCurveTo(x-w, y-w, x-w+r, y-w);
	ctx.fill();
}

window.addEvent('domready', function() {
	$('actieCanvas').addEvent('mousemove', function(event) {
		var pos = this.getPosition();
		var x = Math.min(Math.max(event.page.x - pos.x, 0), this.width);
		var y = Math.min(Math.max(event.page.y - pos.y, 0), this.height);
		
		handle(this, x, y);
	});
});") . '</textarea>
<p>Beweeg de muis in het vak hieronder om te zien wat er gebeurd.</p>
<canvas id="actieCanvas" width="508" height="400" class="demo_canvas"></canvas>

<p>Het resultaat is hier dat je elke keer als de muis beweegt (het mouse-move event van MooTools heb ik gebruikt) een blokje 
wordt toegevoegd aan het canvas. Wanneer je nu alleen wilt dat het blokje de muis volgt, en dus de rest van het element weer 
leeg wordt gemaakt kan dat door onderstaande regel toe te voegen in de &#39;handle&#39; functie voor de nieuwe vorm wordt getekend.</p>

<textarea class="code_js" cols="60" rows="10">
' . htmlentities("ctx.clearRect(0, 0, canvas.width, canvas.height);") . '</textarea>
';

$jsFiles[] = 'pages/include/canvas_demo/actieCanvas.js';

$html .= '
<p>De functie clearRect gaan we straks ook gebruiken om een gat mee te maken in het masker dat je over een afbeelding kan leggen. 
Omdat het lastig is om in stappen op te delen hoe ik tot een bruikbare crop-weergave ben gekomen zal ik nu het grootste deel van het 
resultaat laten zien.</p>

<h2>Crop weergave</h2>
<p>Zoals je ziet bereken je bij iedere beweging van de muis in welk gedeelte die zich bevind, dit kan zijn buiten 
de huidige selectie, dan gaan we een nieuwe selectie beginnen, of binnen de selectie, dan gaan we het geselecteerde gebied verplaatsen 
tot maximaal de kaders van het canvas-element, of aan de rand van het kader, dan willen we de selectie een bepaalde kant op uitrekken.<br />
De laaste functionaliteit heb ik op dit moment nog niet volledig uitgewerkt.</p>

<textarea class="code_js" cols="60" rows="10">
' . htmlentities("var cropLayer;
var cropStart = {x: null, y: null};
var cropPos = {x: 10, y: 15, width: 50, height: 30};
var cropLast = cropPos;
cropLast.x1 = cropLast.x;
cropLast.y1 = cropLast.y;
var canvasPos = {x1: null, y1: null, x2: null, y2: null};
var resize = false;
var w = 4; // hoogte en breedte van de rand om de selectie

function overlay(canvas, x, y, width, height) {
	var ctx = canvas.getContext('2d');
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	
	canvasPos = {x1: x, y1: y, x2: x+width, y2: y+height, width: width, height: height};
	
	ctx.fillStyle = 'rgba(0, 0, 0, .4)';
	ctx.beginPath();
	ctx.rect(0, 0, canvas.width, canvas.height);
	ctx.closePath();
	ctx.fill();
	
	ctx.clearRect(x, y, width, height);
	
	// handles vanaf links boven met de klok mee
	handle(canvas, x, y);
	handle(canvas, x+width, y);
	handle(canvas, x+width, y+height);
	handle(canvas, x, y+height);
}
function handle(canvas, x, y) {
	var ctx = canvas.getContext('2d');
	var r = 3;
	ctx.fillStyle = 'rgba(0, 0, 0, .8)';
	ctx.beginPath();
	ctx.moveTo(x-w+r, y-w);
	ctx.lineTo(x+w-r, y-w);
	ctx.quadraticCurveTo(x+w, y-w, x+w, y-w+r);
	ctx.lineTo(x+w, y+w-r);
	ctx.quadraticCurveTo(x+w, y+w, x+w-r, y+w);
	ctx.lineTo(x-w+r, y+w);
	ctx.quadraticCurveTo(x-w, y+w, x-w, y+w-r);
	ctx.lineTo(x-w, y-w+r);
	ctx.quadraticCurveTo(x-w, y-w, x-w+r, y-w);
	ctx.fill();
}

window.addEvent('domready', function() {
	cropLayer = $('cropCanvas');
	
	overlay(cropLayer, cropPos.x, cropPos.y, cropPos.width, cropPos.height);
	
	cropLayer.addEvent('mousedown', function(event) {
		var pos = cropLayer.getPosition();
		var x1 = event.page.x - pos.x;
		var y1 = event.page.y - pos.y;
		if(y1 > 0 && x1 > 0 && y1 < cropLayer.height && x1 < cropLayer.width) {
			cropStart.x = x1;
			cropStart.y = y1;
			if(x1 > canvasPos.x1-w && x1 < canvasPos.x2+w && y1 > canvasPos.y1-w && y1 < canvasPos.y2+w) {
				
				if(x1 < canvasPos.x1+w) {
					if(y1 < canvasPos.y1+w) {
						// links boven
						resize = 'nw';
					} else if(y1 > canvasPos.y2-w) {
						// links onder
						resize = 'sw';
					} else {
						// links
						resize = 'w';
					}
				} else if(x1 > canvasPos.x2-w) {
					if(y1 < canvasPos.y1+w) {
						// rechts boven
						resize = 'ne';
					} else if(y1 > canvasPos.y2-w) {
						// rechts onder
						resize = 'se';
					} else {
						// rechts
						resize = 'e';
					}
				} else if(y1 < canvasPos.y1+w) {
					// boven
					resize = 'n';
				} else if(y1 > canvasPos.y2-w) {
					// onder
					resize = 's';
				} else {
					// centrum
					resize = 'move';
				}
			} else {
				// buiten selectie
				resize = 'new';
			}
		} else {
			resize = false;
		}
	});
	document.addEvent('mouseup', function(event) {
		resize = false;
		cropLast = canvasPos;
		cropStart.x = null;
		cropStart.y = null;
	});
	document.addEvent('mousemove', function(event) {
		var pos = cropLayer.getPosition();
		var x1 = Math.min(Math.max(event.page.x - pos.x, 0), cropLayer.width);
		var y1 = Math.min(Math.max(event.page.y - pos.y, 0), cropLayer.height);
		
		var x2 = cropStart.x;
		var y2 = cropStart.y;
		
		
		if(x1 > canvasPos.x1-w && x1 < canvasPos.x2+w && y1 > canvasPos.y1-w && y1 < canvasPos.y2+w) {
			if(x1 < canvasPos.x1+w) {
				if(y1 < canvasPos.y1+w) {
					// links boven
					cropLayer.setStyle('cursor', 'nw-resize');
				} else if(y1 > canvasPos.y2-w) {
					// links onder
					cropLayer.setStyle('cursor', 'sw-resize');
				} else {
					// links
					cropLayer.setStyle('cursor', 'w-resize');
				}
			} else if(x1 > canvasPos.x2-w) {
				if(y1 < canvasPos.y1+w) {
					// rechts boven
					cropLayer.setStyle('cursor', 'ne-resize');
				} else if(y1 > canvasPos.y2-w) {
					// rechts onder
					cropLayer.setStyle('cursor', 'se-resize');
				} else {
					// rechts
					cropLayer.setStyle('cursor', 'e-resize');
				}
			} else if(y1 < canvasPos.y1+w) {
				// boven
				cropLayer.setStyle('cursor', 'n-resize');
			} else if(y1 > canvasPos.y2-w) {
				// onder
				cropLayer.setStyle('cursor', 's-resize');
			} else {
				// centrum
				cropLayer.setStyle('cursor', 'move');
			}
		} else {
			// buiten selectie
			cropLayer.setStyle('cursor', 'crosshair');
		}
		if(resize !== false) {
			switch (resize) {
			case 'n':
			  
			  break;
			case 'ne':
			  
			  break;
			case 'e':
			  
			  break;
			  
			  break;
			case 'se':
			  
			  break;
			case 's':
			  
			  break;
			case 'sw':
			  
			  break;
			case 'w':
			  
			  break;
			case 'nw':
			  
			  break;
			  
			  break;
			case 'move':
				var dx = x1 - x2;
				var dy = y1 - y2;
				x = Math.min( Math.max(cropLast.x1 + dx,0),cropLayer.width-cropLast.width);
				y = Math.min( Math.max(cropLast.y1 + dy,0),cropLayer.height-cropLast.height);
				width = cropLast.width;
				height = cropLast.height;
				overlay(cropLayer, x, y, width, height);
			  break;
			case 'new':
				var x = Math.min(x1, x2);
				var y = Math.min(y1, y2);
				var width = Math.max(x1, x2) - x;
				var height = Math.max(y1, y2) - y;
				if(event.shift) {
					width = height = Math.max(width, height);
				}
				
				overlay(cropLayer, x, y, width, height);						  
			  break;
			}
		}
	});
});") . '</textarea>

<p>Hieronder wat er gebeurt. Zoals je ziet wordt al wel de cursor veranderd wanneer de muis aan de rand van de selectie komt maar werkt het 
uitrekken daar nog niet. Ook kan shift ingedrukt worden tijdens het maken van een nieuwe selectie, als het startpunt van de selectie de linker 
bovenhoek is dan werkt het goed, wanneer de selectie bijvoorbeeld rechts onder begint werkt het niet zoals het zou moeten, daar is een wat 
uitgebrijder script voor nodig. Maar de principewerking wordt al wel duidelijk.</p>

<canvas id="cropCanvas" width="508" height="400" class="demo_canvas"></canvas>
';

$jsFiles[] = 'pages/include/canvas_demo/cropCanvas.js';

$html .= '
<p>Met bovenstaand voorbeeld als basis kun je nu gemakkelijk dit canvas element over een foto heen leggen (door bijvoorbeeld het 
canvas-element een negative margin-top te geven) en de x, y, width en height in formuliervelden stoppen of de overlay functie uitbreiden met 
een resultaatweergave van de versneden afbeelding in een ander canvas-element.</p>

<h2>Bronnen</h2>
<p><a rel="external" href="http://diveintohtml5.org/canvas.html">diveintohtml5.org/canvas.html</a> 
Uitleg over de verschillende mogelijkheden met het canvas element.</p>
<p><a rel="external" href="http://www.html5canvastutorials.com/tutorials/html5-canvas-image-crop/">html5canvastutorials.com/tutorials/html5-canvas-image-crop/</a> 
Uitleg over het croppen van een afbeelding met canvas, op deze zelfde site kun je ook vinden hoe je vormen kunt tekenen.</p>
<p><a rel="external" href="http://billmill.org/static/canvastutorial/index.html">billmill.org/static/canvastutorial</a> 
Tutorial waar een breakout clone (met een balletje blokjes wegspelen) wordt gemaakt met behulp van het canvas element.</p>


';

?>