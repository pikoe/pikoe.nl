// JavaScript Document

var div, img, imax;

function init()
{
	div = document.getElementById('portfolio');
	
	var pf = document.getElementsByTagName("A");
	for(var i=0; i<pf.length; i++)
	{
		if(pf[i].rel == 'ajax')
		{
			pf[i].onclick=function()
			{
				xmlhttpPost(this.href,display);
				div.innerHTML = '<img src="ajax-loader.gif" alt="wacht..." width="16" height="16" />';
				return false;
			}
		}
	}
}

function display(html)
{
	div.innerHTML = html;
	
	img = document.getElementById('demo');
	imax = div.getElementsByTagName('div')[0].offsetHeight;
	
	img.style.cursor= 'pointer';
	img.style.height = 640-imax+'px';
	img.style.overflow = 'hidden';
			
	div.onclick = function(e)
	{
		var evt = window.event || e;
		var et = (evt.target) ? evt.target : evt.srcElement;
		var a = false;
		while(et != div && et && (et.parentNode || et.parentElement))
		{
			if(et.nodeName == 'A')
			{
				a = true;
			}
			if(et.parentNode)
			{
				et = et.parentNode;
			}
		}
		if(img.style.overflow == 'hidden' && !a)
		{
			img.style.overflow = 'visible';
			img.style.height = '300px';
		}
		else if(!a)
		{
			img.style.overflow = 'hidden';
			img.style.height = 640-imax+'px';
		}
	}
}

function xmlhttpPost(URL,callback)
{
	var xmlHttpReq = true;
	var self = this;
	if(window.XMLHttpRequest)// Mozilla/Safari
	{
		self.xmlHttpReq = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)// IE
	{
		try
		{
			self.xmlHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				xmlHttpReq = false;
			}
		}
	}
	else
	{
		xmlHttpReq = false;
	}
	if(xmlHttpReq)
	{
		self.xmlHttpReq.open('GET', URL, true);
		self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		self.xmlHttpReq.onreadystatechange = function()
		{
			if(self.xmlHttpReq.readyState == 4 && self.xmlHttpReq.status == 200)
			{
				callback(self.xmlHttpReq.responseText);
			}
			else if(self.xmlHttpReq.readyState == 4)
			{
				callback('Er is een fout opgetreden. De pagina is niet goed ingeladen.<br />Mogelijk komt dit door een oudere browser versie.<br />Klik met de rechtermuisknop op de afbeelding en kies openen in nieuw tabblad, of openen in nieuw venster.</a>');
			}
		}
		self.xmlHttpReq.send();
	}
	else
	{
		callback('Er is een fout opgetreden. Het script kan geen pagina\'s asynchroon inladen.<br /><a href="'+URL+'" target="_blank">Klik op deze link, om de pagina toch te bekijken.</a>');	
	}
}

window.onload = init;
