<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>social</title>

<script type="text/javascript">

window.onload = function(e) {
<?php
	if(isset($_POST['zoek'])) {
	echo "
			window.open('http://www.facebook.com/search.php?q=" . urlencode($_POST['zoek']) . "&type=users&init=srp');
			window.open('http://twitter.com/#!/who_to_follow/search/" . urlencode($_POST['zoek']) . "');
			window.open('http://www.linkedin.com/search/fpsearch?type=people&keywords=" . urlencode(preg_replace('/\s/','+',$_POST['zoek'])) . "&pplSearchOrigin=GLHD&pageKey=member-home');
			window.open('http://www.hyves.nl/search/hyver/?searchterms=" . urlencode($_POST['zoek']) . "&pageid=A2WG0ILVSEO8SGC0C');
		";
	}
?>
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <label for="zoek">zoek</label>
    <input type="text" name="zoek" id="zoek" />
    <button type="submit" value="1">zoek</button>
</form>
</body>
</html>
