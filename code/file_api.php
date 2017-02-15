<?php
$html .= '<h1>File-api</h1>';

$html .= '<p>Een nieuw onderdeel in HTML5 is de file-api. Deze maakt het mogelijk om de content die gekozen 
is in een file-input veld te kunnen uitlezen en gebruiken. Bijvoorbeeld is dat handig om gebruikers al vast 
te laten zien wat ze voor bestand hebben gekozen om te uploaden.</p>
<p>Wel moet meteen gemeld worden dat dit helaas nog niet door alle browsers wordt ondersteund, in Chrome en 
Firefox kun je het gebruiken, de andere browsers zullen er niets mee doen.</p>
<p>Wat je nodig hebt om met de file-api te kunnen werken zijn dus een (formulier met) file-input veld, 
JavaScript om iets te gaan doen met de inhoud en daarnaast natuurlijk een browser die dit ondersteund.</p>

<h2>Afbeelding weergeven voor uploaden</h2>
<p>Als eerste maak je voor het input-veld een onchange-event aan, ik gebruik MooTools maar dat hoeft natuurlijk 
niet, dit zocht ervoor dat je script wordt aangeroepen op het moment dat er een (nieuw) bestand is gekozen.<br />
Het input veld heeft nu een bestand die je met een FileReader kunt uitlezen en laten zien (mits het natuurlijk 
een afbeelding is).
</p>

<p>Het JavaScript:</p>
<textarea class="code_js" cols="60" rows="10">
' . htmlentities("var reader, img;
window.addEvent('domready', function() {
	var holder = $('holder');
	$('upload').addEvent('change', function() {
		var file = this.files[0];
		reader = new FileReader();
		reader.onload = function (event) {
			img = new Image();
			img.onload = function (event) {
				if(img.width > 598) {
					img.width = 598;
				}
			}
			img.src = event.target.result;
			holder.innerHTML = '';
			holder.appendChild(img);
		};
		reader.readAsDataURL(file);
		return false;
	}
});") . '</textarea>
<p>De HTML:</p>
<textarea class="code_html" cols="60" rows="10">
' . htmlentities('<input type="file" id="upload" />
<div id="holder"></div>') . '</textarea>

<input type="file" id="upload" />
<div id="holder" style="overflow: hidden; height: 300px; border: 1px solid #666;"></div>
';

$jsFiles[] = 'pages/include/file_api_demo/file_api_readfile.js';

$html .= '
<p>Selecteer een afbeelding om te zien wat er gebeurd.</p>

<p>Met deze basis kun je natuurlijk veel meer doen, de files array uit het input veld geeft bijvoorbeel ook informatie 
over de naam van het bestand en het type. Hiermee kun je voor het inladen dus al mee checken of het wel een afbeelding 
is die er gekozen is.</p>

<h2>Meerder afbeeldingen</h2>
<p>Bovenstaand voorbeeld heeft slechts de mogelijkheid om &eacute;&eacute;n afbeelding uit te kiezen. Echter is het ook 
mogelijk om met deze techniek meerdere bestanden te selecteren (in windows met [Shift] of [Ctrl]) en weer te geven.</p>
<p>Om te beginnen moet voor het input-veld aangegeven worden dat er meerdere afbeeldingen kunnen worden gekozen.</p>

<textarea class="code_html" cols="60" rows="10">
' . htmlentities('<input type="file" id="upload" multiple="multiple" />') . '</textarea>

<p>Het JavaScript is nu een stuk uitgebreider. De file-reader en de image-loader krijgen hun eigen wachtrij, en worden 
aangeroepen als er iets nieuws in de rij wordt gezet of als een vorige is afgerond. Ik heb de wachtrijen in het een eigen 
object met de naam &#39;images&#39; gezet. Daarnaast kijk ik nu ook of het bestand dat is gekozen wel van het type image 
is, zo niet dat gaat dat bestand niet verder in het proces.</p>

<textarea class="code_js" cols="60" rows="10">
' . htmlentities("var images = {
	files: new Array(),
	fileCount: 0,
	readers: new Array(),
	readerCount: 0,
	sources: new Array(),
	images: new Array(),
	imageCount: 0,
	divs: new Array()
}

var cropLayer;

window.addEvent('domready', function() {
	$('fileInput').addEvent('change', function() {
		var inputFiles = this.files;
		for(var i = 0; i < inputFiles.length; i++) {
			var file = inputFiles[i];
			if(!file.type.match(/image.*/)) {
				console.log('geen afbeelding: ' + file.type);
			} else {
				console.log('add ' + file.name);
				images.files[images.fileCount++] = file;
				if(images.readerCount == images.readers.length) {
					images.readers[images.readerCount] = new FileReader();
					readImage();
				}
			}
		}
	});
});

function readImage() {
	if(images.readerCount < images.files.length) {
		var div = document.createElement('div');
		var imgSpan = document.createElement('span');
		var nrSpan = document.createElement('span');
		var nameSpan = document.createElement('span');
		nrSpan.innerHTML = (1+images.readerCount);
		div.appendChild(imgSpan).addClass('img');
		div.appendChild(nrSpan).addClass('nr');
		nameSpan.innerHTML = images.files[images.readerCount].name + ' ';
		div.appendChild(nameSpan).addClass('name');
		$('imageList').appendChild(div).addClass('imageItem');
		images.divs[images.readerCount] = div;
		
		var reader = images.readers[images.readerCount];
		reader.onload = readImageReady;
		reader.readAsDataURL(images.files[images.readerCount]);
	}
}
function readImageReady(imageReaderEvent) {
	images.sources[images.readerCount] = imageReaderEvent.target.result;
	
	// weggooien wat we niet meer gebruiken
	var name = images.files[images.readerCount].name;
	images.files[images.readerCount] = {};
	images.files[images.readerCount].name = name;
	images.readers[images.readerCount] = {};
	
	++images.readerCount;
	if(images.readers.length < images.files.length) {
		images.readers[images.readerCount] = new FileReader();
		readImage();
	}
	if(images.imageCount == images.images.length) {
		images.images[images.imageCount] = new Image();
		loadImage();
	}
}

function loadImage() {
	if(images.imageCount < images.sources.length) {
		console.log('load ' + images.files[images.imageCount].name);
		var image = images.images[images.imageCount];
		image.onload = loadImageReady;
		image.src = images.sources[images.imageCount];
	} else {
		console.log('end source list');
	}
}
function loadImageReady() {
	images.images[images.imageCount].width = 40;
	images.divs[images.imageCount].getElement('.img').appendChild(images.images[images.imageCount]);
	
	// weggooien wat we niet meer gebruiken
	images.sources[images.imageCount] = null;
	
	++images.imageCount;
	if(images.images.length < images.sources.length) {
		images.images[images.imageCount] = new Image();
		loadImage();
	}
}") . '</textarea>
<input type="file" id="fileInput" multiple="multiple" />
<div id="imageList" style="overflow: hidden; height: 300px; border: 1px solid #666;"></div>

';

$jsFiles[] = 'pages/include/file_api_demo/upload_more.js';

$html .= '
<p>Je krijg nu een lijstje met de gekozen afbeeldingen en je kunt ook een tweede keer of vaker bladeren om meer afbeeldignen 
te selecteren.</p>
<p>De ingeladen afbeeldignen kunnen nu bijvoorbeeld worden ingeladen in een canvas element om ze te verschalen of versnijden 
naar een gewenst formaat alvoorens de afbeeldignen te uploaden. Ook kun je het gebruiken om simpelweg alvast te laten zien 
welk bestand je hebt gekozen om te gaan uploaden, dit zal niet werken met meerdere afbeeldingen volgens mij maar daar heb ik 
me niet in verdiept.</p>

<h2>Bronnen</h2>
<p><a rel="external" href="https://developer.mozilla.org/en/DOM/FileReader">developer.mozilla.org/en/DOM/FileReader</a> 
Beschrijving van de verschillende functies van het filereader object.</p>
<p><a rel="external" href="http://hacks.mozilla.org/2009/12/w3c-fileapi-in-firefox-3-6/">hacks.mozilla.org/2009/12/w3c-fileapi-in-firefox-3-6/</a> 
Verdere uitleg fileapi.</p>
';

?>