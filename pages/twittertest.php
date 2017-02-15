<?php

// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://search.twitter.com/search.json?q=klok&rpp=5&include_entities=true&with_twitter_user_id=true&result_type=mixed");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$json = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);  

$html .= '<pre>' . var_export(json_decode($json),true) . '</pre>';


?>
