<?php
$html .= '
<div class="right_col">';

if((isset($pad[1]) && $pad[1] == 'archief') || !isset($pad[1])) {
	$html .= '
	<h1>Code knipsels</h1>
	';
	
	$join = '';
	if(isset($pad[2]) && substr($pad[2], 0, 6) == 'thema:') {
		$join = '
		INNER JOIN `artiekel_tags` ON `artiekel_tags`.`artiekel` = `artiekel`.`id`
		INNER JOIN `tag` ON `artiekel_tags`.`tag` = `tag`.`id` AND `tag`.`title` LIKE \'' . preg_replace('/[^a-z0-9]+/', '%', substr($pad[2], 6)) . '\'
		';
		$html .= '
		<p>Gezocht op thema.</p>
		';
	}
	$artiekels = mysql_query("
		SELECT `artiekel`.`title`, `artiekel`.`url`, DATE_FORMAT(`date`, '%d-%m-%Y %H:%i:%s') AS format_date
		FROM `artiekel`
		" . $join . "
		ORDER BY `date` DESC;
	") or die('MySQLerror '.mysql_errno().' : '.mysql_error().'. In '.__FILE__.' on line '.__LINE__);
	while($artiekel = mysql_fetch_assoc($artiekels)) {
		$html .= '
		<a href="code_knipsels/' . $artiekel['url'] . '"><span class="date">' . $artiekel['format_date'] . '</span> ' . $artiekel['title'] . '</a><br />';
	}
} else if(isset($pad[1]) && file_exists('code/' . $pad[1] . '.php')) {
	include('code/' . $pad[1] . '.php');
} else {
	$html .= '
	<h1>Code knipsels</h1>
	<p>Het artiekel dat u probeert te zoeken bestaat niet of is verplaatst.</p>
	';
}
$html .= '
</div>';

$html .= '
<div class="left_col">
	<h2>Nieuwste items</h2>
	<ul>';
$nieuwItems = mysql_query("
	SELECT `title`, `url`, DATE_FORMAT(`date`, '%d-%m-%Y') AS format_date
	FROM `artiekel`
	ORDER BY `date` DESC
	LIMIT 3;
") or die('MySQLerror '.mysql_errno().' : '.mysql_error().'. In '.__FILE__.' on line '.__LINE__);
while($nieuwItem = mysql_fetch_assoc($nieuwItems)) {
	$html .= '
	<li><a href="code_knipsels/' . $nieuwItem['url'] . '"><span class="date">' . $nieuwItem['format_date'] . '</span> ' . $nieuwItem['title'] . '</a></li>';
}
$html .= '</ul>
	<a href="code_knipsels/archief/" class="archief">archief</a>
	<div class="clear"></div>
	<h2>Thema\'s / Tag\'s</h2>
	<ul class="float">';
$themaItems = mysql_query("
	SELECT `tag`.`title`, COUNT(`artiekel_tags`.`artiekel`) AS artikels, COUNT(`artiekel`.`id`) AS active
	FROM `tag`
	INNER JOIN `artiekel_tags` ON `tag`.`id` = `artiekel_tags`.`tag`
	LEFT JOIN `artiekel` ON `artiekel`.`id` = `artiekel_tags`.`artiekel` AND `artiekel`.`url` = '" . mysql_real_escape_string($pad[1]) . "'
	GROUP BY `tag`.`id`
	ORDER BY `artikels` DESC;
") or die('MySQLerror '.mysql_errno().' : '.mysql_error().'. In '.__FILE__.' on line '.__LINE__);
while($themaItem = mysql_fetch_assoc($themaItems)) {
	$html .= '
	<li' . (($themaItem['active']>0)?' class="active"':'') . '><a href="code_knipsels/archief/thema:' . toUrl($themaItem['title']) . '">' . $themaItem['title'] . '<span class="artiekels"> (' . $themaItem['artikels'] . ')</span></a></li>';
}
$html .= '
	</ul>
</div>
<div class="clear"></div>
';

$cssFiles[] = 'codemirror/css/codemirror.css';
$cssFiles[] = 'codemirror/css/default.css';

$jsFiles[] = 'codemirror/js/codemirror.js';
$jsFiles[] = 'codemirror/js/runmode.js';

$jsFiles[] = 'codemirror/js/css.js';
$jsFiles[] = 'codemirror/js/javascript.js';
$jsFiles[] = 'codemirror/js/xml.js';
$jsFiles[] = 'codemirror/js/htmlmixed.js';
$jsFiles[] = 'codemirror/js/clike.js';
$jsFiles[] = 'codemirror/js/php.js';

$javascript .= '';
$domready .= "
document.getElements('.code_html').each(function(el) {
	var editor = CodeMirror.fromTextArea(el, {
		mode: 'application/xml',
		tabMode: 'indent',
		lineNumbers: true
	});
});
document.getElements('.code_php').each(function(el) {
	var editor = CodeMirror.fromTextArea(el, {
		mode: 'application/x-httpd-php',
		tabMode: 'indent',
		lineNumbers: true
	});
});
document.getElements('.code_php_only').each(function(el) {
	var editor = CodeMirror.fromTextArea(el, {
		mode: 'text/x-php',
		tabMode: 'indent',
		lineNumbers: true
	});
});
document.getElements('.code_css').each(function(el) {
	var editor = CodeMirror.fromTextArea(el, {
		mode: 'text/css',
		tabMode: 'indent',
		lineNumbers: true
	});
});
document.getElements('.code_js').each(function(el) {
	var editor = CodeMirror.fromTextArea(el, {
		mode: 'text/javascript',
		tabMode: 'indent',
		lineNumbers: true
	});
});

";
?>