<?php
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.skype.com/users/self/profile");
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$headers=array("X-Skypetoken: ".urlencode($_POST["skypetoken"]));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result=curl_exec($ch);
preg_match_all('/"username":"(.*?)"/',$result,$matches);
echo $matches[1][0];
?>