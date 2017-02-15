<?php

$html .= '<h1>Contact</h1>
  	<div id="contact">
    	<p>Dennis Veeneman<br />
    	Oude Larenseweg 87<br />
    	7214 PG Epse</p>
    </div>';
        

$ongeldig=' style="color:#CC0000;" onkeypress="this.style.color=\'#333333\';"';
$error = '';

$naam = 0;
$email = 0;
$onderwerp = 0;
$bericht = 0;
if($_POST)
{
	if(!$_POST[naam] || $_POST[naam] == '' || strlen( $_POST[naam] ) < 5)
	{
		$error = '<p>Sommige velden zijn niet goed ingevuld.<br />Velden met een \'*\' zijn verplicht</p>';
		$naam = 1;
	}
	if(!preg_match("/^[A-Za-z0-9._\-]+\@[A-Za-z0-9._\-]+\.[A-Za-z]{2,4}$/", $_POST[email]))
	{
		$error = '<p>Sommige velden zijn niet goed ingevuld.<br />Velden met een \'*\' zijn verplicht</p>';
		$email = 1;
	}
	if(!$_POST[onderwerp] || $_POST[onderwerp] == '' || strlen( $_POST[onderwerp] ) < 5)
	{
		$error = '<p>Sommige velden zijn niet goed ingevuld.<br />Velden met een \'*\' zijn verplicht</p>';
		$onderwerp = 1;
	}
	if(!$_POST[bericht] || $_POST[bericht] == '' || strlen( $_POST[bericht] ) < 10)
	{
		$error = '<p>Sommige velden zijn niet goed ingevuld.<br />Velden met een \'*\' zijn verplicht</p>';
		$bericht = 1;
	}
}
if($error == '' && $_POST) {
	$naar  = 'Dennis Veeneman <dennis_veeneman@hotmail.com>, '.htmlentities($_POST[voornaam]).' '.htmlentities($_POST[naam]).' <'.$_POST[email].'>';
	
	$bericht = '<html>
			<head>
				<title>'.$_POST[onderwerp].'</title>
			</head>
			<body class="style<?php echo rand(1, 3); ?>">
				<div>
					<table border="0" width="100%">
						<tr valign="top">
							<td width="150px">Van</td>
							<td>'.htmlentities($_POST[voornaam]).' '.htmlentities($_POST[naam]).'</td>
						</tr>
						<tr valign="top">
							<td width="150px">Adres</td>
							<td>
							'.htmlentities($_POST[adres]).'<br />
							'.htmlentities($_POST[postcode]).'<br />
							'.htmlentities($_POST[plaats]).'
							</td>
						</tr>
						<tr valign="top">
							<td width="150px">E-mail afzender</td>
							<td>'.$_POST[email].'</td>
						</tr>
						<tr valign="top">
							<td width="150px">IP-adres afzender</td>
							<td>'.$_SERVER['REMOTE_ADDR'].'</td>
						</tr>
						<tr valign="top">
							<td width="150px">Onderwerp</td>
							<td>'.htmlentities($_POST[onderwerp]).'</td>
						</tr>
						<tr valign="top">
							<td width="150px">Tijd</td>
							<td>'.date('d-m-Y H:i:s').'</td>
						</tr>
					</table>
					<hr />
					<p>'.nl2br(htmlentities($_POST[bericht])).'</p>
				</div>
			</body>
		</html>';
		
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Pikoe.nl <noreply@pikoe.nl>' . "\r\n";
		$headers .= 'Reply-to: '.$_POST[email] . "\r\n";	
		
		$html .= $error . '<p>';
		if( mail($naar, $_POST[onderwerp].' - bericht van website', $bericht, $headers) )
		{
			$html .= 'Het volgende bericht is verstuurd:';
		}
		else
		{
			$html .= 'Fout bij versturen, stuur eventueel het bericht naar dennis_veeneman@hotmail.com of probeer het nog eens.';
		}
		
		
		
		$html .= '<div style="border-left: 1px solid #FFFFFF; padding-left: 5px; margin-left: 5px;">
					<table border="0" width="100%">
						<tr valign="top">
							<td width="150px">Van</td>
							<td>'.htmlentities($_POST[voornaam]).' '.htmlentities($_POST[naam]).'</td>
						</tr>
						<tr valign="top">
							<td width="150px">Adres</td>
							<td>
							'.htmlentities($_POST[adres]).'<br />
							'.htmlentities($_POST[postcode]).'<br />
							'.htmlentities($_POST[plaats]).'
							</td>
						</tr>
						<tr valign="top">
							<td width="150px">E-mail afzender</td>
							<td>'.$_POST[email].'</td>
						</tr>
						<tr valign="top">
							<td width="150px">IP-adres afzender</td>
							<td>'.$_SERVER['REMOTE_ADDR'].'</td>
						</tr>
						<tr valign="top">
							<td width="150px">Onderwerp</td>
							<td>'.htmlentities($_POST[onderwerp]).'</td>
						</tr>
						<tr valign="top">
							<td width="150px">Tijd</td>
							<td>'.date('d-m-Y H:i:s').'</td>
						</tr>
					</table>
					<p style="border-top: 1px solid #FFFFFF; padding-top: .4em; margin-top: .4em;">'.nl2br(htmlentities($_POST[bericht])).'</p>
				</div>
';
}
else
{
	$html .= '<form action="" method="post" id="contactform">
		<div id="formVelden">
			<label class="formLabel" for="voornaam">Voornaam</label><input class="formInput" type="text" name="voornaam" id="voornaam" value="'.$_POST[voornaam].'" /><br />
			<label class="formLabel" for="naam" title="Achternaam, minimaal 5 tekens">Achternaam *</label><input class="formInput"'.($naam?$ongeldig:'').' type="text" name="naam" id="naam" value="'.$_POST[naam].'" /><br />
			<label class="formLabel" for="adres">Adres</label><input class="formInput" type="text" name="adres" id="adres" value="'.$_POST[adres].'" /><br />
			<label class="formLabel" for="postcode">Postcode</label><input class="formInput" type="text" name="postcode" id="postcode" value="'.$_POST[postcode].'" /><br />
			<label class="formLabel" for="plaats">Plaats</label><input class="formInput" type="text" name="plaats" id="plaats" value="'.$_POST[plaats].'" /><br />
			<label class="formLabel" for="email">E-mail adres *</label><input class="formInput"'.($email?$ongeldig:'').' type="text" name="email" id="email" value="'.$_POST[email].'" /><br />
			<label class="formLabel" for="onderwerp" title="Onderwerp, minimaal 5 tekens">Onderwerp *</label><input class="formInput"'.($onderwerp?$ongeldig:'').' type="text" name="onderwerp" id="onderwerp" value="'.$_POST[onderwerp].'" /><br />
			<label class="formLabel" for="bericht" title="Bericht, minimaal 10 tekens">Bericht *</label>
			<textarea name="bericht" id="bericht" class="formInput formArea"'.($bericht?$ongeldig:'').' rows="5" cols="25">'.$_POST[bericht].'</textarea>
		</div>
		<div class="formSubmit"><label for="verzendbericht" style="cursor:pointer;"><img src="gfx/arrow_right.png" alt="=&gt;" width="16" height="16" /> Verzend bericht</label><input name="verzendbericht" style="border: none; margin: 0; padding: 0; display: block; width: 0; height: 0;" id="verzendbericht" value="1" type="submit" /></div>
	</form>';
}


?>