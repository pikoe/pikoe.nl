window.addEvent('domready', function() {
	var ctx = $('voorbeeldCanvas').getContext('2d');
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
	ctx.fill()
});