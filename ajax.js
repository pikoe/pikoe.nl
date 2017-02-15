// JavaScript Document

function xmlhttpPost(URL,query,callback)
{
	var xmlHttpReq = false;
	var self = this;
	if(window.XMLHttpRequest)// Mozilla/Safari
	{
		self.xmlHttpReq = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)// IE
	{
		self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
	}
	self.xmlHttpReq.open('POST', URL, true);
	self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	self.xmlHttpReq.onreadystatechange = function()
	{
		if (self.xmlHttpReq.readyState == 4)// && self.xmlHttpReq.status == 200
		{
			callback(self.xmlHttpReq.responseText);
		}
	}
	self.xmlHttpReq.send();
}