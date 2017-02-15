var images = {
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
}