var editor;
window.addEvent('domready', function() {
	var buttons = document.getElementById('testForm').getElementsByTagName('input');
	for (var i=0;i<buttons.length;i++) {
		if (buttons[i].type != 'button') continue;
		buttons[i].onclick = command;
	}
	editor = $('editor');
	
	$('alertSelection').addEvent('click', function() {
		if(window.getSelection) { // all browsers, except IE before version 9
			var selRange = window.getSelection();
			alert(selRange.toString());
		} else {
			if(document.selection) { // Internet Explorer
				var textRange = document.selection.createRange();
				alert(textRange.text);
			}
		}
	});
})
function command() {
	var inEditor = window.getSelection().getRangeAt(0).startContainer.parentNode.getParent('#editor');
	if(inEditor == null) { return false; }
	
	console.log(window.getSelection());
	
	var cmd = this.id;
	var bool = false;
	var value = this.getAttribute('cmdValue') || null;
	if (value == 'promptUser')
		value = prompt(this.getAttribute('promptText'));
	document.execCommand(cmd,bool,value);
}