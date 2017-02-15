var reader, img;
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
	});
});