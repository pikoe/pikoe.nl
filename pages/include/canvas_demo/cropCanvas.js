var cropLayer;
var cropStart = {x: null, y: null};
var cropPos = {x: 10, y: 15, width: 50, height: 30};
var cropLast = cropPos;
cropLast.x1 = cropLast.x;
cropLast.y1 = cropLast.y;
var canvasPos = {x1: null, y1: null, x2: null, y2: null};
var resize = false;
var w = 4;  // hoogte en breedte van de rand om de selectie

function overlay(canvas, x, y, width, height) {
	var ctx = canvas.getContext('2d');
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	
	canvasPos = {x1: x, y1: y, x2: x+width, y2: y+height, width: width, height: height};
	
	ctx.fillStyle = "rgba(0, 0, 0, .4)";
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
	ctx.fillStyle = "rgba(0, 0, 0, .8)";
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
});