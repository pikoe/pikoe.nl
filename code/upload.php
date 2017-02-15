<?php

$html .= '<h1>Uploader</h1>';

$html .= '
<p>Ik heb getracht een uploader te maken waarmee je afbeeldingen kunt selecteren, versnijden en/of verschalen en vervolgens 
uploaden. Door de nieuwe technieken in HTML5 kan dit allemaal in de browser en is er niet een ActiveX of Flash plugin meer 
nodig om dit te kunnen doen.</p>
<p>Het koste me meer tijd om de verschillende onderdelen aan elkaar te maken dan ik had verwacht. Het is daarom nog niet allemaal 
aan elkaar gekoppeld. Ik zal wel de verschillende onderdelen alvast latenz zien waarmee ik dit uiteindelijk wil bereiken:</p>


<p><a href="http://www2.pikoe.nl/code_knipsels/file_api">Het artiekel over de File-api</a></p>
<p><a href="http://www2.pikoe.nl/code_knipsels/canvas_cropping">Het artiekel over het crop-script voor een canvas element.</a></p>

<p>En dan zijn er nog onderdelen die nog niet uitgewerkt zijn in een artiekel:</p>

<p><a rel="external" href="http://demo.pikoe.nl/jsFlow.php">Gekozen bestanden kan worden geselecteerd, en een verkleining wordt naar 
een php script gestuurd dat de data (base64) omzet naar een afbeelding en deze opslaat.</a></p>
<p><a rel="external" href="http://demo.pikoe.nl/images.php">Afbeelding is te verknippen en geeft ook een voorbeeld weer van het 
geselecteerde gebied in een ander canvas-element. (script wacht niet op img load dus misschien is het nodig [F5] te drukken als de 
afbeelding niet wordt weergegeven)</a></p>
<p><a rel="external" href="http://demo.pikoe.nl/upload.php">Opzet waarin ik uiteindelijk de verschillende delen wil samenvoegen.</a></p>
';

?>