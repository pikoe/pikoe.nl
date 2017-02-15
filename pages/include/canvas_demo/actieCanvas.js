function handle(canvas, x, y) {
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
});
