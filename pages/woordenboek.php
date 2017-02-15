<?php

$html .= '<h1>Woordenboek</h1>';

foreach (range('a', 'z') as $letter) {
    $html .= (($letter != 'a') ? ' | ' : ''); 
    $html .= '<a href="woordenboek#' . $letter . '">' . strtoupper($letter) . '</a>';
}
$html .= '<br />';

foreach (range('a', 'z') as $letter) {
    $html .= '<a href="woordenboek#' . $letter . '" name="' . $letter . '">' . strtoupper($letter) . '</a><br />';
	
	$letterItems = mysql_query("
		SELECT *
		FROM `definitie`
		WHERE `title` LIKE '" . $letter . "%'
		ORDER BY `title`;
	") or die('MySQLerror '.mysql_errno().' : '.mysql_error().'. In '.__FILE__.' on line '.__LINE__);
	while($letterItem = mysql_fetch_assoc($letterItems)) {
		$html .= '
		<a name="' . strtolower($letterItem['title']) . '"></a>
		<h3>' . $letterItem['title'] . '</h3>
		<p>' . nl2br(htmlentities($letterItem['definitie'])) . '</p>';
	}
}


?>