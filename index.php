<?php

if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
	ob_start("ob_gzhandler"); 
} else {
	ob_start();
}
header('Content-Type: text/html; charset=UTF-8');

function toUrl($string, $allowDot = false) {
	//$string = preg_replace('/&(.)(acute|cedil|circ|ring|tilde|uml|slash|zlig);/', '$1', htmlentities(utf8_decode(stripslashes($string))));
	$string = preg_replace('/&(.)(acute|cedil|circ|ring|tilde|uml|slash|zlig);/', '$1', htmlentities(stripslashes($string)));
	return strtolower(preg_replace('/__/', '_', preg_replace('/[^0-9a-zA-Z_\-' . (($allowDot==true)?'\.':'') . ']/', '_', html_entity_decode($string))));
}
/*
$_SITE['db']      = 'pikoenl_portfolio';
$_SITE['db_host'] = 'localhost';
$_SITE['db_user'] = 'pikoenl_pikoenl';
$_SITE['db_pass'] = '123tuuf7t';

// verbinden met database
$connection = mysql_connect($_SITE['db_host'], $_SITE['db_user'], $_SITE['db_pass'], true) or die("Error"  .mysql_errno() . " : " . mysql_error());
mysql_select_db($_SITE['db'], $connection) or die("Error " .mysql_errno() . " : " . mysql_error());
*/

$pad = explode('/',trim(preg_replace('/\?.*$/','',$_SERVER['REQUEST_URI']),'/'));
$menu = '<ul id="tabnav">';
//$menuItems = array('Portfolio', 'Over mij', 'Code knipsels', 'Nieuws', 'Contact');
$menuItems = array('Portfolio', 'Over mij', 'Nieuws', 'Contact');
$page = false;
foreach ($menuItems as $key => $menuItem) {
	if(isset($pad[0]) && toUrl($menuItem) == $pad[0]) {
		$page = $key;
	}
}
if(!isset($pad[0]) || $pad[0] == '') {
	$page = 0;
}
foreach ($menuItems as $key => $menuItem) {
	$menu .= '<li' . (($key === $page)?' class="selected"':'') . '><a href="' . ($key?toUrl($menuItem):'/') . '">' . $menuItem . '</a></li>';
}
$menu .= '</ul>';

$cssFiles = array();
$jsFiles = array();
$html = '';
$javascript = '';
$domready = '';

$cssFiles[] = 'http://fonts.googleapis.com/css?family=Leckerli+One';
$cssFiles[] = 'style.css';

$jsFiles[] = 'mootools/mootools-core.js';

if($page === false && isset($pad[0]) && file_exists('pages/' . $pad[0] . '.php')) {
	include_once('pages/' . $pad[0] . '.php');
} else if($page !== false && file_exists('pages/' . toUrl($menuItems[$page]) . '.php')) {
	include_once('pages/' . toUrl($menuItems[$page]) . '.php');
} else {
	$html .= '<h1>404 error</h1><p>De pagina die u probeert te benaderen bestaat niet, mogelijk is deze verwijderd of verplaatst.</p>';
}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="expires" content="0" />
	
	<base href="http://' . $_SERVER['HTTP_HOST'] . '/" />
	
	<title>' . $menuItems[$page] . ' | Pikoe.nl</title>
	<meta name="description" content="" />
	
	<link type="image/x-icon" rel="shortcut icon" href="/favicon.ico" />
	';

$cssFiles = array_unique($cssFiles);
foreach ($cssFiles as $cssFile) {
	echo '
	<link type="text/css" rel="stylesheet" href="' . $cssFile . '" />';
}
$jsFiles = array_unique($jsFiles);
foreach ($jsFiles as $jsFile) {
	echo '
	<script type="text/javascript" src="' . $jsFile . '"></script>';
}

echo '
	<script type="text/javascript">
	/* <![CDATA[ */
		' . $javascript . '
		window.addEvent("domready", function() {
			document.getElements("a").each(function(el){
				if(el.get("rel") && el.get("rel") == "external") {
					el.set("target", "_blank")
				}
			});
			' . $domready . '
		});
	/* ]]> */
	</script>
</head>

<body>
<div id="totaal">
	<div id="header">
		<div class="logo">
			<a href="/" title="Home"><img src="gfx/pikoe.png" alt="Pikoe logo" width="86" height="66" />
			<span class="pikoe">Pikoe</span></a>
		</div>
		<div class="tagline"><a href="/" title="Home">Simpeler, sneller, beter</a></div>
	</div>
	<div id="menu">
		' . $menu . '
	</div>
	<div id="inhoud">
		' . $html . '
	</div>
	<div id="footer">
	  <ul>
		  <li><h3>U kunt bij Pikoe terecht voor</h3></li>
		  <li><img src="gfx/layout.png" width="16" height="16" alt="Ontwerp" /> Webontwerp en -realisatie</li>
		  <li><img src="gfx/application_form_edit.png" width="16" height="16" alt="Website" /> Website compleet met CMS</li>
		  <li><img src="gfx/email_open.png" width="16" height="16" alt="Formulier" /> Interactie met uw bezoekers</li>
		  <li><img src="gfx/magnifier.png" width="16" height="16" alt="Zoeken" /> Zoekmachinevriendelijk maken</li>
	</ul>
	<ul>
		<li><h3>Meest gebruikte technieken</h3></li>
		<li><a href="woordenboek#html"><img src="gfx/ico/html.png" width="16" height="16" alt="HTML" /> HTML</a></li>
		<li><a href="woordenboek#css"><img src="gfx/ico/css.png" width="16" height="16" alt="CSS" /> CSS</a></li>
		<li><a href="woordenboek#javascript"><img src="gfx/ico/javascript.png" width="16" height="16" alt="JavaScript" /> JavaScript</a></li>
		<li><a href="woordenboek#php"><img src="gfx/ico/php.png" width="16" height="16" alt="PHP" /> PHP</a></li>
		<li><a href="woordenboek#mysql"><img src="gfx/ico/mysql.png" width="16" height="16" alt="MySQL" /> MySQL</a></li>
	</ul>
	<ul class="small">
		<li><h3>Op Pikoe.nl</h3></li>
		<li><a href="woordenboek"><img src="gfx/ico/woordenboek.png" width="16" height="16" alt="Woordenboek" /> Woordenboek</a></li>
		<li><a href="sitemap"><img src="gfx/ico/sitemap.png" width="16" height="16" alt="Sitemap" /> Sitemap</a></li>
		<li><a href="contact"><img src="gfx/ico/contact.png" width="16" height="16" alt="Contact" /> Contact</a></li>
	</ul>
	<ul class="small">
		<li><h3>Social media</h3></li>
		<li><a href="http://www.facebook.com/pikoe.nl" rel="external"><img src="gfx/ico/facebook.png" width="16" height="16" alt="Facebook" /> Facebook</a></li>
		<li><a href="http://www.linkedin.com/pub/dennis-veeneman/34/17a/349" rel="external"><img src="gfx/ico/linkedin.png" width="16" height="16" alt="LinkedIn" /> LinkedIn</a></li>
	</ul>
  </div>
</div>
</body>
</html>';

ob_flush();
